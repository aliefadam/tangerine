<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\TimeTable;
use App\Models\Trainer;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FrontendController extends Controller
{
    public function gate()
    {
        return view('frontend.gate', [
            "title" => "Gate"
        ]);
    }

    public function home()
    {
        return view('frontend.welcome', [
            "title" => "Home",
            "courses" => Course::all(),
            "time_tables" => TimeTable::all(),
        ]);
    }

    public function about()
    {
        return view('frontend.about', [
            "title" => "About Us",
        ]);
    }

    public function trainer()
    {
        return view('frontend.trainer', [
            "title" => "Trainer",
            "trainers" => Trainer::all(),
        ]);
    }

    public function classes()
    {
        return view('frontend.classes', [
            "title" => "classes",
            "courses" => Course::all(),
        ]);
    }

    public function class_detail($slug)
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            if ($user->email_verified_at == null) {
                return redirect()->route("verification.notice");
            }
        }
        $course = Course::firstWhere("slug", $slug);
        return view('frontend.class-detail', [
            "title" => "classes",
            "course" => $course,
            "trainers" => Trainer::all(),
        ]);
    }

    public function checkout()
    {
        $user_id = Auth::user()->id;
        $data = session("checkout_{$user_id}");
        $schedules = Schedule::all();
        $years = generateDate()["years"];
        $calendarData = generateDate()["calendarData"];
        $course_name = trim(explode(" - ", $data["course_label_taken"])[0]);
        if ($course_name == "Yoga Classes") {
            $rooms = Room::all();
        } else {
            $rooms = Room::where("used_for", "!=", "Yoga Only")->get();
        }

        return view("frontend.checkout", [
            "title" => "Checkout",
            "data" => $data,
            "rooms" => $rooms,
            "trainers" => Trainer::all(),
            "schedules" => $schedules,
            "years" => $years,
            "calendarData" => $calendarData,
            "course_name" => $course_name,
        ]);
    }

    public function payment_waiting($invoice)
    {
        return view("frontend.payment-waiting", [
            "title" => "Payment Waiting",
            "transaction" => Transaction::firstWhere("invoice", $invoice)
        ]);
    }

    public function schedule()
    {
        return view('frontend.schedule', [
            "title" => "Schedule",
            "time_tables" => TimeTable::all(),
        ]);
    }

    public function transaction()
    {
        return view("frontend.transaction", [
            "title" => "Transaction",
            "transactions" => Transaction::where("user_id", Auth::user()->id)->latest()->get(),
        ]);
    }

    public function transaction_detail($id)
    {
        $transaction = Transaction::find($id);
        return response()->json([
            "html" => view("components.modal-detail-transaction", [
                "transaction" => $transaction,
            ])->render(),
        ]);
    }

    public function profile()
    {
        $user_id = Auth::user()->id;
        $schedules = Schedule::all();
        $years = generateDate()["years"];
        $calendarData = generateDate()["calendarData"];

        $user = User::find(Auth::user()->id);
        return view("frontend.profile", [
            "title" => "Profile",
            "user" => $user,
            "schedulesAll" => $schedules,
            "years" => $years,
            "calendarData" => $calendarData,
            "schedules" => Schedule::where("member_id", $user->member ? $user->member->id : null)->get(),
            "upcoming_schedules" => $user->member ? Schedule::where("member_id", $user->member->id)
                ->whereDate("date", ">=", now()->format("Y-m-d"))->latest()->get() : collect(),
            "previous_schedules" => $user->member ? Schedule::where("member_id", $user->member->id)
                ->whereDate("date", "<=", now()->format("Y-m-d"))->latest()->get() : collect(),
        ]);
    }

    public function edit_profile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $updatedData = [
            "name" => $request->name,
            "phone" => $request->phone,
            "gender" => $request->gender,
        ];
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = "USER_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/users"), $fileName);
            if (File::exists(public_path("uploads/users/{$user->image}"))) {
                if ($user->image) {
                    unlink(public_path("uploads/users/{$user->image}"));
                }
            }
            $updatedData["image"] = $fileName;
        }
        $user->update($updatedData);
        return redirect_user("success", "Successfully Edit Profile", "profile");
    }

    public function change_password(Request $request)
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
