<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.welcome', [
            "title" => "Home",
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
        ]);
    }

    public function classes()
    {
        return view('frontend.classes', [
            "title" => "classes",
        ]);
    }

    public function schedule()
    {
        return view('frontend.schedule', [
            "title" => "schedule",
        ]);
    }
}
