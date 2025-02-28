<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberPlan;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();
        try {
            $user_id = Auth::user()->id;
            $dataCheckout = session("checkout_{$user_id}");
            $newTransaction = Transaction::create([
                "invoice" => "INV_TANGERINE_" . date("Ymdhis") . $user_id . "_" . strtoupper(Str::random(10)),
                "user_id" => $dataCheckout["user_id"],
                "room_id" => $request->room_id,
                "trainer_id" => $request->trainer_id,
                "plan" => $dataCheckout["course_label_taken"],
                "day" => $request->day,
                "time" => $request->time,
                "payment_status" => "waiting",
                "total" => $dataCheckout["total"],
                "expirated_date" => now()->addDay(),
            ]);
            DB::commit();
            return response()->json(["redirect_url" => route("payment.waiting", $newTransaction->invoice)]);
        } catch (\Exception $e) {
            DB::rollback();
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
            $user_id = Auth::user()->id;
            $transaction = Transaction::find($id);
            $transaction->update([
                "payment_status" => "confirmed"
            ]);
            $newMember = Member::create([
                "user_id" => $transaction->user_id,
            ]);

            $type = trim(explode(" - ", $transaction->plan)[2]);
            $subscribed_date = Carbon::parse(now());
            if ($type == "10 Session") {
                $expired_date = $subscribed_date->copy()->addMonths(4);
            } else if ($type == "20 Session") {
                $expired_date = $subscribed_date->copy()->addMonths(6);
            } else {
                $expired_date = $subscribed_date->copy()->addDay();
            }

            MemberPlan::create([
                "member_id" => $newMember->id,
                "trainer_id" => $transaction->trainer_id,
                "room_id" => $transaction->room_id,
                "plan" => $transaction->plan,
                "day" => $transaction->day,
                "time" => $transaction->time,
                "subscribed_date" => $subscribed_date,
                "expired_date" => $expired_date,
                "status" => "active",
            ]);
            DB::commit();
            notificationFlash("success", "Successfully Confirm Payment");
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

            notificationFlash("success", "Successfully Upload Proof");
            return response()->json(["success" => true]);
        }

        notificationFlash("error", "No file uploaded");
        return response()->json(["success" => false]);
    }
}
