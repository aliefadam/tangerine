<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    public function index()
    {
        return view("backend.schedule.index", [
            "title" => "Schedule",
            "schedules" => Schedule::all(),
        ]);
    }

    public function create()
    {
        return view("backend.schedule.create", [
            "title" => "Add Schedule",
        ]);
    }

    public function store(Request $request)
    {
        //
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
        //
    }

    public function destroy($id)
    {
        //
    }
}
