<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Schedule;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScheduleController extends Controller
{

    public function index()
    {
        $currentYear = date('Y');
        $years = [$currentYear, $currentYear + 1, $currentYear + 2];

        $months = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $calendarData = [];

        foreach ($years as $year) {
            foreach ($months as $index => $month) {
                $monthNumber = $index + 1;
                $daysInMonth = Carbon::createFromDate($year, $monthNumber, 1)->daysInMonth;
                $firstDayOfWeek = Carbon::createFromDate($year, $monthNumber, 1)->dayOfWeek;

                $calendarData[$year][$month] = [
                    'days' => range(1, $daysInMonth),
                    'startDay' => $firstDayOfWeek
                ];
            }
        }

        return view("backend.schedule.index", [
            "title" => "Schedule",
            "schedules" => Schedule::all(),
            "years" => $years,
            "months" => $months,
            "calendarData" => $calendarData,
        ]);
    }

    public function create()
    {
        return view("backend.schedule.create", [
            "title" => "Add Schedule",
            "courses" => Course::all(),
        ]);
    }

    public function store(Request $request)
    {
        Schedule::create([
            "date" => $request->date,
            "time" => $request->time,
            "course_id" => $request->course_id,
        ]);

        return redirect_user("success", "Successfully Added Schedule", "admin.schedule.index");
    }

    public function show($date)
    {
        try {
            $selectedDate = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Exception $e) {
            abort(404, 'Tanggal tidak valid');
        }

        $hours = range(6, 20);
        $dateFormatted = $selectedDate->isoFormat('dddd, D MMMM Y');

        return view("backend.schedule.show", [
            "title" => "Schedule Detail at {$dateFormatted}",
            "selectedDate" => $selectedDate,
            "hours" => $hours,
            "trainers" => Trainer::all(),
        ]);
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
