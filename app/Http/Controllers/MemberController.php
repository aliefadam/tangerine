<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
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
            $trainer_id = $request->trainer;
            $plan = $request->plan;
            $plan = explode("#", $request->plan)[0] . " - " . explode("#", $request->plan)[1] . " - "  . explode("#", $request->plan)[2];
            $total = explode("#", $request->plan)[3];
            $subscription_date = now();
            $subscription_expiration_date = now()->addMonths(4);
            $status = "waiting";

            Member::create([
                'user_id' => $user_id,
                'trainer_id' => $trainer_id,
                'plan' => $plan,
                'total' => $total,
                'subscription_date' => $subscription_date,
                'subscription_expiration_date' => $subscription_expiration_date,
                'status' => $status,
            ]);
            DB::commit();
            notificationFlash("success", "Sukses");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["success" => false]);
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
