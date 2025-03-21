<?php

namespace App\Http\Controllers;

use App\Mail\SendInvoice;
use App\Mail\SendPaymentConfirm;
use App\Mail\SendProofPayment;
use App\Models\CourseDetail;
use App\Models\Member;
use App\Models\MemberPlan;
use App\Models\Schedule;
use App\Models\Trainer;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        return view("backend.transaction.index", [
            "title" => "Transaction",
            "transactions" => Transaction::latest()->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $dataCheckout = session("checkout_{$user_id}");
        $course_id = getCourse($dataCheckout["course_label_taken"])->id;
        $course_detail = getCourseDetail($dataCheckout["course_label_taken"], $course_id);

        if ($request->capacity > $course_detail->person_max) {
            notificationFlash("error", "Capacity is over");
            return response()->json(["redirect_url" => "", "message" => "Capacity is over"]);
        }

        // $isNotAvailableTrainer = Transaction::where("trainer_id", $request->trainer_id)->where("date", $request->date)->where("time", $request->time)->exists();
        // if ($isNotAvailableTrainer) {
        //     $trainerName = Trainer::find($request->trainer_id)->name;
        //     $formatedDate = Carbon::parse($request->date)->format("l, d M Y");
        //     notificationFlash("error", "Trainer {$trainerName} is not available on {$formatedDate} - {$request->time}");
        //     return response()->json(["redirect_url" => "", "message" => "Trainer is not available"]);
        // }

        DB::beginTransaction();
        try {
            $newTransaction = Transaction::create([
                "invoice" => "INV_TANGERINE_" . date("Ymdhis") . $user_id . "_" . strtoupper(Str::random(10)),
                "user_id" => $dataCheckout["user_id"],
                "room_id" => $request->room_id,
                "trainer_id" => $request->trainer_id,
                "plan" => $dataCheckout["course_label_taken"],
                "date" => $request->date,
                "time" => $request->time,
                "capacity" => $request->capacity,
                "payment_status" => "waiting",
                "notes" => $request->notes,
                "total" => $dataCheckout["total"],
                "expirated_date" => now()->addHours(2),
            ]);
            DB::commit();

            // Kebutuhan Email
            $data = [
                "invoice" => $newTransaction->invoice,
                "transaction_date" => $newTransaction->created_at,
                "label" => $dataCheckout["course_label_taken"],
                "total" => $dataCheckout["total"],
            ];
            Mail::to(Auth::user()->email)->queue(new SendInvoice($data));
            Mail::to("website@tangerine.my.id")->queue(new SendInvoice($data));

            return response()->json(["redirect_url" => route("payment.waiting", $newTransaction->invoice)]);
        } catch (\Exception $e) {
            DB::rollback();
            notificationFlash("error", $e->getMessage());
            return response()->json(["redirect_url" => "", "message" => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        return response()->json([
            "html" => view("components.modal-detail-transaction", [
                "transaction" => $transaction,
            ])->render(),
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $status = $request->status;
            $transaction = Transaction::find($id);
            $transaction->update([
                "payment_status" => $status
            ]);

            if ($status == "confirmed") {
                confirmTransaction($transaction);
            } else {
                cancelTransaction($transaction);
            }
            DB::commit();
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["success" => false]);
        }
    }

    public function destroy($id)
    {
        //
    }


    public function upload_proof(Request $request)
    {
        $user_id = Auth::user()->id;
        $transaction = Transaction::find($request->transaction_id);
        if ($request->hasFile("proof_of_payment")) {
            $file = $request->file("proof_of_payment");
            $fileName = "PROOF_IMAGE_" . date("Ymdhis") . $user_id . "." . $file->extension();
            $file->move(public_path("uploads/proofs"), $fileName);

            $transaction->update([
                "proof_of_payment" => $fileName,
                "payment_status" => "paid"
            ]);

            // Kebutuhan Email
            $data = [
                "invoice" => $transaction->invoice,
                "transaction_date" => $transaction->created_at,
                "label" => $transaction->plan,
                "total" => $transaction->total,
                "proof_of_payment" => $fileName,
            ];
            Mail::to("website@tangerine.my.id")->queue(new SendProofPayment($data));

            notificationFlash("success", "Successfully Upload Proof");
            return response()->json(["success" => true]);
        }

        notificationFlash("error", "No file uploaded");
        return response()->json(["success" => false]);
    }
}
