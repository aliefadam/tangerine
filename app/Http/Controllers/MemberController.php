<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Member;
use App\Models\MemberPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index()
    {
        return view("backend.member.index", [
            "title" => "Member",
            "members" => Member::latest()->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request) {}

    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id;
        $course_id = $request->course_id;
        $course_detail_id = explode("#", $request->plan)[0];
        $course_detail_name = CourseDetail::find($course_detail_id)->name;
        $course_detail_type = explode("#", $request->plan)[1];
        $course_label_taken = Course::find($course_id)->name . " - " . $course_detail_name . " - " .  Str::replace("Price", "", Str::headline(str_replace('_', ' ', $course_detail_type)));
        $total = CourseDetail::find($course_detail_id)[$course_detail_type];
        session()->put("checkout_{$user_id}", [
            'user_id' => Auth::user()->id,
            'trainer_id' => $request->trainer,
            "course_id" => $course_id,
            "course_detail_id" => $course_detail_id,
            "course_detail_name" => $course_detail_name,
            "course_detail_type" => $course_detail_type,
            "course_label_taken" => $course_label_taken,
            "total" => $total,
        ]);

        return response()->json([
            "redirect_url" => route("member.checkout"),
        ]);
    }

    public function show($id)
    {
        $member = Member::find($id);
        return response()->json($member->memberPlans);
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
