<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        //
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
                "invoice" => "INV_TANGERINE_" . date("Ymdhis") . $user_id . "_" . Str::random(10),
                "user_id" => $user_id,
                "room_id" => $request->room_id,
                "trainer_id" => $request->trainer_id,
                "plan" => $dataCheckout["course_label_taken"],
                "day" => $request->day,
                "time" => $request->time,
                "payment_status" => "waiting",
                "total" => $dataCheckout["total"],
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
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
