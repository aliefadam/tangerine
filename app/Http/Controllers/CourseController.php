<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        return view("backend.course.index", [
            "title" => "Class",
            "courses" => Course::all(),
        ]);
    }

    public function create()
    {
        return view("backend.course.create", [
            "title" => "Add Class",
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->file("image");
            $fileName = "COURSE_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/courses"), $fileName);
            Course::create([
                "name" => $request->name,
                "slug" => Str::slug($request->name),
                "description" => $request->description,
                "image" => $fileName,
            ]);
            DB::commit();
            return redirect_user("success", "Successfully Added Class", "admin.course.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $course = Course::find($id);
        return view("backend.course.edit", [
            "title" => "Edit Class {$course->name}",
            "course" => $course,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $course = Course::find($id);
        try {
            $updatedData = [
                "name" => $request->name,
                "slug" => Str::slug($request->name),
                "description" => $request->description,
            ];
            if ($request->hasFile("image")) {
                $file = $request->file("image");
                $fileName = "COURSE_IMAGE_" . date("Ymdhis") . "." . $file->extension();
                $file->move(public_path("uploads/courses"), $fileName);
                if (File::exists(public_path("uploads/courses/{$course->image}"))) {
                    unlink(public_path("uploads/courses/{$course->image}"));
                }
                $updatedData["image"] = $fileName;
            }
            $course->update($updatedData);
            DB::commit();
            return redirect_user("success", "Successfully Added Class", "admin.course.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->courseDetails()->delete();
        $course->delete();

        notificationFlash("success", "Successfully Delete Class");
        return response()->json([
            "success" => true,
        ]);
    }
}
