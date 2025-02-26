<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use Illuminate\Http\Request;

class CourseDetailController extends Controller
{
    public function index()
    {
        return view("backend.course-detail.index", [
            "title" => "Course Detail",
            "course_details" => CourseDetail::all(),
        ]);
    }

    public function create()
    {
        return view("backend.course-detail.create", [
            "title" => "Add Course Detail",
            "courses" => Course::all(),
        ]);
    }

    public function store(Request $request)
    {
        CourseDetail::create([
            "name" => $request->name,
            "course_id" => $request->course_id,
            "drop_in_price" => $request->drop_in_price,
            "10_session_price" => $request->input("10_session_price"),
            "20_session_price" => $request->input("20_session_price"),
            "person_max" => $request->person_max,
        ]);
        return redirect_user("success", "Successfully Added Detail Class", "admin.course-detail.index");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $courseDetail = CourseDetail::find($id);
        return view("backend.course-detail.edit", [
            "title" => "Edit Detail Class",
            "courses" => Course::all(),
            "course_detail" => $courseDetail,
        ]);
    }

    public function update(Request $request, $id)
    {
        $courseDetail = CourseDetail::find($id);
        $courseDetail->update([
            "name" => $request->name,
            "course_id" => $request->course_id,
            "drop_in_price" => $request->drop_in_price,
            "10_session_price" => $request->input("10_session_price"),
            "20_session_price" => $request->input("20_session_price"),
            "person_max" => $request->person_max,
        ]);
        return redirect_user("success", "Successfully Edit Detail Class", "admin.course-detail.index");
    }

    public function destroy($id)
    {
        //
    }
}
