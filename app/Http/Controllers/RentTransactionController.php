<?php

namespace App\Http\Controllers;

use App\Models\RentTransaction;
use App\Models\RentTransactionDetail;
use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RentTransactionController extends Controller
{
    public function index()
    {
        return view("backend.rent-transaction.index", [
            "title" => "Rent Transaction",
            "transactions" => RentTransaction::latest()->get(),
        ]);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $userID = Auth::user()->id;
        $dataTransaction = session("rent_transaction_{$userID}");
        try {
            $price = $dataTransaction["room_price"];
            $total = $price * $dataTransaction["hour"];

            $newTransaction = RentTransaction::create([
                "user_id" => $userID,
                "invoice" => "INV_TANGERINE_" . date("Ymdhis") . $userID . "_" . strtoupper(Str::random(10)),
                "participant" => $dataTransaction["participant"],
                "room_type" => $dataTransaction["type"],
                "used_for" => $dataTransaction["used_for"],
                "price" => $price,
                "hour" => $dataTransaction["hour"],
                "total" => $total,
                "status" => "waiting",
            ]);
            foreach ($dataTransaction["time"] as $time) {
                RentTransactionDetail::create([
                    "rent_transaction_id" => $newTransaction->id,
                    "room_id" => $dataTransaction["room_id"],
                    "date" => $dataTransaction["date"],
                    "time" => $time,
                ]);
            }
            DB::commit();
            return response()->json(["redirect_url" => route("payment.waiting.rent", $newTransaction->invoice)]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["redirect_url" => ""]);
        }
    }

    public function show($id)
    {
        $transaction = RentTransaction::find($id);
        return response()->json([
            "html" => view("components.modal-detail-rent-transaction", [
                "transaction" => $transaction,
            ])->render(),
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user_id = Auth::user()->id;
            $transaction = RentTransaction::find($id);
            $transaction->update([
                "status" => "confirmed"
            ]);
            DB::commit();

            // Kebutuhan Email
            $data = [
                "invoice" => $transaction->invoice,
                "transaction_date" => $transaction->created_at,
                "label" => $transaction->plan,
                "total" => $transaction->total,
                "proof_of_payment" => $transaction->proof_of_payment,
            ];
            // Mail::to($transaction->user->email)->queue(new SendProofPayment($data));

            notificationFlash("success", "Successfully Confirm Payment");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["success" => false]);
        }
    }

    public function upload_proof(Request $request)
    {
        $user_id = Auth::user()->id;
        $transaction = RentTransaction::find($request->transaction_id);
        if ($request->hasFile("proof_of_payment")) {
            $file = $request->file("proof_of_payment");
            $fileName = "PROOF_IMAGE_" . date("Ymdhis") . $user_id . "." . $file->extension();
            $file->move(public_path("uploads/proofs"), $fileName);

            $transaction->update([
                "proof_of_payment" => $fileName,
                "status" => "paid"
            ]);

            // Kebutuhan Email
            $data = [
                "invoice" => $transaction->invoice,
                "transaction_date" => $transaction->created_at,
                "label" => $transaction->plan,
                "total" => $transaction->total,
                "proof_of_payment" => $fileName,
            ];
            // Mail::to("website@tangerine.my.id")->queue(new SendProofPayment($data));

            notificationFlash("success", "Successfully Upload Proof");
            return response()->json(["success" => true]);
        }

        notificationFlash("error", "No file uploaded");
        return response()->json(["success" => false]);
    }
}
