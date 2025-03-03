<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\TimeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeTableController extends Controller
{
    public function index()
    {
        return view("backend.time-table.index", [
            "title" => "Time Table",
            "time_tables" => TimeTable::all(),
            "courses" => Course::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            TimeTable::create([
                "index" => $request->index,
                "course_id" => $request->course_id,
                "day" => $request->day,
                "start_time" => $request->start_time,
                "end_time" => $request->end_time,
            ]);
            DB::commit();
            notificationFlash("success", "Successfully Added Time Table");
            return response()->json(["message" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["message" => false]);
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
        DB::beginTransaction();
        try {
            $timeTable = TimeTable::find($id);
            $timeTable->update([
                "course_id" => $request->course_id_edit,
                "day" => $request->day_edit,
                "start_time" => $request->start_time_edit,
                "end_time" => $request->end_time_edit,
            ]);
            DB::commit();
            notificationFlash("success", "Successfully Updated Time Table");
            return response()->json(["message" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["message" => false]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $timeTable = TimeTable::find($id);
            $timeTable->delete();
            DB::commit();
            notificationFlash("success", "Successfully Deleted Time Table");
            return response()->json(["message" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["message" => false]);
        }
    }
}
