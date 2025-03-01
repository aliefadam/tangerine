<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Trainer;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.welcome', [
            "title" => "Home",
            "courses" => Course::all(),
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
            "title" => "schedule",
        ]);
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        return view("frontend.profile", [
            "title" => "Profile",
            "user" => $user,
            "schedules" => Schedule::where("member_id", $user->member->id)->get(),
            "upcoming_schedules" => Schedule::where("member_id", $user->member->id)
                ->whereDate("date", ">=", now()->format("Y-m-d"))->get(),
            "previous_schedules" => Schedule::where("member_id", $user->member->id)
                ->whereDate("date", "<=", now()->format("Y-m-d"))->get(),
        ]);
    }
}
