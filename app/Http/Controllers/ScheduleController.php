<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Member;
use App\Models\MemberPlan;
use App\Models\RentTransaction;
use App\Models\RentTransactionDetail;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\ScheduleCapacity;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{

    public function index()
    {
        // $currentYear = date('Y');
        // $currentMonth = date('n');
        // $years = [$currentYear, $currentYear + 1, $currentYear + 2];

        // $calendarData = [];

        // foreach ($years as $year) {
        //     $startMonth = ($year == $currentYear) ? $currentMonth : 1;

        //     for ($month = $startMonth; $month <= 12; $month++) {
        //         $carbonDate = Carbon::createFromDate($year, $month, 1);
        //         $monthName = $carbonDate->translatedFormat('F');
        //         $daysInMonth = $carbonDate->daysInMonth;
        //         $firstDayOfWeek = $carbonDate->dayOfWeek;

        //         $calendarData[$year][$monthName] = [
        //             'days' => range(1, $daysInMonth),
        //             'startDay' => $firstDayOfWeek
        //         ];
        //     }
        // }

        return view("backend.schedule.index", [
            "title" => "Schedule",
            "schedules" => Schedule::all(),
            "years" => generateDate()["years"],
            "calendarData" => generateDate()["calendarData"],
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
        DB::beginTransaction();
        try {
            $plan = $request->plan;
            $course_name = trim(explode(" - ", $plan)[0]);
            $course_detail_name = trim(explode(" - ", $plan)[1]);
            $course_detail = CourseDetail::where('name', $course_detail_name)->whereHas("course", function ($query) use ($course_name) {
                $query->where('name', $course_name);
            })->first();

            $newSchedule = [
                'member_id' => $request->member_id,
                "member_plan_id" => $request->member_class_plan,
                'room_id' => $request->room_id,
                'course_detail_id' => $course_detail->id,
                'course_id' => $course_detail->course_id,
                'trainer_id' => $request->trainer_id,
                'date' => $request->date,
                'time' => $request->time,
            ];
            Schedule::create($newSchedule);
            DB::commit();
            notificationFlash("success", "Successfully Add Schedule");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["success" => false]);
        }
    }

    public function store_from_member(Request $request)
    {
        DB::beginTransaction();
        try {
            $memberPlan = MemberPlan::find($request->memberPlanID);
            $plan = $memberPlan->plan;
            $course_name = trim(explode(" - ", $plan)[0]);
            $course_detail_name = trim(explode(" - ", $plan)[1]);
            $course_detail = CourseDetail::where('name', $course_detail_name)->whereHas("course", function ($query) use ($course_name) {
                $query->where('name', $course_name);
            })->first();

            $newSchedule = Schedule::create([
                'member_id' => $memberPlan->member_id,
                'member_plan_id' => $memberPlan->id,
                'room_id' => $memberPlan->room_id,
                'course_detail_id' => $course_detail->id,
                'course_id' => $course_detail->course_id,
                'trainer_id' => $memberPlan->trainer_id,
                "capacity" => $request->capacity,
                'date' => $request->date,
                'time' => $request->time,
            ]);

            // $isIssetScheduleCapacity = ScheduleCapacity::where("schedule_id", $newSchedule->id)->exists();

            // if ($isIssetScheduleCapacity) {
            //     $scheduleCapacity = ScheduleCapacity::firstWherehere("schedule_id", $newSchedule->id);
            //     $scheduleCapacity->update([
            //         "capacity" => $request->capacity + $scheduleCapacity->capacity,
            //     ]);
            // } else {
            //     ScheduleCapacity::create([
            //         "schedule_id" => $newSchedule->id,
            //         "capacity" => $request->capacity,
            //     ]);
            // }

            DB::commit();
            notificationFlash("success", "Successfully Add Schedule");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["success" => false]);
        }
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
        $schedules = Schedule::where('date', $date)->get();
        $rentTransactions = RentTransactionDetail::where('date', $date)->get();

        return view("backend.schedule.show", [
            "title" => "Schedule Detail at {$dateFormatted}",
            "selectedDate" => $selectedDate,
            "hours" => $hours,
            "rooms" => Room::all(),
            "trainers" => Trainer::all(),
            "members" => Member::all(),
            "schedules" => $schedules,
            "rentTransactions" => $rentTransactions
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
        DB::beginTransaction();
        try {
            $schedule = Schedule::find($id);
            $schedule->delete();

            DB::commit();
            notificationFlash("success", "Successfully Delete Schedule");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["success" => false]);
        }
    }

    public function get_schedule_month()
    {
        $schedules = Schedule::all();
        $years = generateDate()["years"];
        $calendarData = generateDate()["calendarData"];

        return response()->json([
            "detailMonthHTML" => view("components.modal-detail-months", [
                "schedules" => $schedules,
                "years" => $years,
                "calendarData" => $calendarData
            ])->render(),
        ]);
    }

    public function get_schedule_day($date, Request $request)
    {
        try {
            $selectedDate = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Exception $e) {
            abort(404, 'Tanggal tidak valid');
        }

        $hours = range(6, 20);
        $dateFormatted = $selectedDate->isoFormat('dddd, D MMMM Y');
        $schedules = Schedule::where('date', $date)->get();

        return response()->json([
            "detailDaysHTML" => view("components.modal-detail-days", [
                "hours" => $hours,
                "selectedDate" => $selectedDate,
                "schedules" => $schedules,
                "dateFormatted" => $dateFormatted,
                "capacity" => $request->capacity,
                "roomID" => $request->roomID,
                "trainerID" => $request->trainerID,
            ])->render(),
        ]);
    }

    public function get_schedule_day_rent_room($date, Request $request)
    {
        try {
            $selectedDate = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Exception $e) {
            abort(404, 'Tanggal tidak valid');
        }

        $hours = range(6, 20);
        $dateFormatted = $selectedDate->isoFormat('dddd, D MMMM Y');
        $schedules = Schedule::where('date', $date)->get();

        return response()->json([
            "detailDaysHTML" => view("components.modal-detail-days-rent-room", [
                "hours" => $hours,
                "selectedDate" => $selectedDate,
                "schedules" => $schedules,
                "dateFormatted" => $dateFormatted,
                "capacity" => 10, // ditulis hardcode karena dengan asumsi dipakai sendiri
                "roomID" => $request->roomID,
            ])->render(),
        ]);
    }
}
