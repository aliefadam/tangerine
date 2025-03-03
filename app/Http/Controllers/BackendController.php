<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function dashboard()
    {
        $dashboard = [
            "transaction_count" => Transaction::count(),
            "income" => Transaction::sum("total"),
            "member_count" => Member::count(),
            "class_count" => Course::count(),
            "transaction_per_month" => getTransactionOneYear(),
            "transaction_per_category" => getTransactionPerCategory(),
        ];


        return view("backend.dashboard", [
            "title" => "Dashboard",
            "dashboard" => $dashboard,
        ]);
    }

    public function change_password()
    {
        return view("backend.change-password", [
            "title" => "Change Password",
        ]);
    }

    public function change_password_post(Request $request)
    {
        $request->validate([
            "password_old" => "required|current_password",
            "password" => "required|confirmed",
        ]);

        $user = User::find(Auth::user()->id);
        $user->update([
            "password" => bcrypt($request->password)
        ]);

        Auth::logout();
        return redirect_user("success", "Successfully Change Password, Please Login Again", "login");
    }
}
