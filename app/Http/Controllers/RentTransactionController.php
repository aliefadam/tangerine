<?php

namespace App\Http\Controllers;

use App\Mail\SendInvoiceRentRoom;
use App\Mail\SendPaymentConfirmRentRoom;
use App\Mail\SendProofPaymentRentRoom;
use App\Models\RentTransaction;
use App\Models\RentTransactionDetail;
use App\Models\Room;
use App\Models\Transaction;
use Carbon\Carbon;
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
                "expirated_date" => now()->addHours(2),
            ]);
            foreach ($dataTransaction["time"] as $time) {
                RentTransactionDetail::create([
                    "rent_transaction_id" => $newTransaction->id,
                    "room_id" => $dataTransaction["room_id"],
                    "date" => $dataTransaction["date"],
                    "time" => $time,
                ]);
            }

            $data = [
                "invoice" => $newTransaction->invoice,
                "transaction_date" => $newTransaction->created_at,
                "label" => "Rental Room : " . Room::find($dataTransaction["room_id"])->name . " - " . ($newTransaction->room_type == "with_bath" ? "With Bath" : "Without Bath"),
                "schedule" => Carbon::parse($dataTransaction["date"])->format("l, d F Y") . " • " . $dataTransaction["time"][0] . " - " . $dataTransaction["time"][count($dataTransaction["time"]) - 1],
                "total" => $newTransaction->total,
            ];

            Mail::to(Auth::user()->email)->queue(new SendInvoiceRentRoom($data));
            Mail::to("website@tangerine.my.id")->queue(new SendInvoiceRentRoom($data));

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
            $status = $request->status;
            $transaction = RentTransaction::find($id);
            $transaction->update([
                "status" => $status
            ]);
            DB::commit();

            $data = [
                "invoice" => $transaction->invoice,
                "transaction_date" => $transaction->created_at,
                "label" => "Rental Room : " . Room::find($transaction->rentTransactionDetails[0]->room_id)->name . " - " . ($transaction->room_type == "with_bath" ? "With Bath" : "Without Bath"),
                "schedule" => Carbon::parse($transaction->rentTransactionDetails[0]->date)->format("l, d F Y") . " • " . $transaction->rentTransactionDetails()->first()->time . " - " . $transaction->rentTransactionDetails()->latest()->first()->time,
                "total" => $transaction->total,
                "proof_of_payment" => $transaction->proof_of_payment,
                "status" => $status,
            ];
            Mail::to($transaction->user->email)->queue(new SendPaymentConfirmRentRoom($data, $status));

            notificationFlash("success", "Successfully {$status} Transaction");
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

            $data = [
                "invoice" => $transaction->invoice,
                "transaction_date" => $transaction->created_at,
                "label" => "Rental Room : " . Room::find($transaction->rentTransactionDetails[0]->room_id)->name . " - " . ($transaction->room_type == "with_bath" ? "With Bath" : "Without Bath"),
                "schedule" => Carbon::parse($transaction->rentTransactionDetails[0]->date)->format("l, d F Y") . " • " . $transaction->rentTransactionDetails()->first()->time . " - " . $transaction->rentTransactionDetails()->latest()->first()->time,
                "total" => $transaction->total,
                "proof_of_payment" => $fileName,
            ];
            Mail::to("website@tangerine.my.id")->queue(new SendProofPaymentRentRoom($data));

            notificationFlash("success", "Successfully Upload Proof");
            return response()->json(["success" => true]);
        }

        notificationFlash("error", "No file uploaded");
        return response()->json(["success" => false]);
    }
}
