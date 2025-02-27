<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Room;
use App\Models\Trainer;
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

        return view("frontend.checkout", [
            "title" => "Checkout",
            "data" => $data,
            "rooms" => Room::all(),
            "trainers" => Trainer::all(),
        ]);
    }

    public function payment_waiting($invoice)
    {
        return $invoice;
    }

    public function schedule()
    {
        return view('frontend.schedule', [
            "title" => "schedule",
        ]);
    }
}
