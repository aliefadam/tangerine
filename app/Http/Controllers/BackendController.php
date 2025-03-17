<?php

namespace App\Http\Controllers;

use App\Models\BookingSalon;
use App\Models\Course;
use App\Models\Member;
use App\Models\Product;
use App\Models\RentTransaction;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function dashboard()
    {
        $income = Transaction::sum("total") + RentTransaction::sum("total") + BookingSalon::join('services', 'booking_salons.service_id', '=', 'services.id')
            ->sum('services.price');
        $dashboard = [
            "transaction_count" => Transaction::count(),
            "transaction_rent_count" => RentTransaction::count(),
            "booking_salon_count" => BookingSalon::count(),
            "income" => $income,
            "member_count" => Member::count(),
            "class_count" => Course::count(),
            "service_count" => Service::count(),
            "product_count" => Product::count(),
            "transaction_per_month" => getTransactionOneYear(),
            "transaction_rent_per_month" => getTransactionRentOneYear(),
            "transaction_salon_per_month" => getTransactionSalonOneYear(),
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
