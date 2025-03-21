<?php

use App\Mail\SendPaymentConfirm;
use App\Models\BookingSalon;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Member;
use App\Models\MemberPlan;
use App\Models\Menu;
use App\Models\RentTransaction;
use App\Models\RentTransactionDetail;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\TimeTable;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

if (!function_exists("setNotification")) {
    function setNotification($icon, $title, $text)
    {
        return [
            "icon" => $icon,
            "title" => $title,
            "text" => $text,
        ];
    }
}

if (!function_exists("getMenuSidebar")) {
    function getMenuSidebar()
    {
        if (Auth::check()) {
            return Menu::where("role", Auth::user()->role)->get();
        }
        return;
    }
}

if (!function_exists("active_sidebar")) {
    function active_sidebar($url)
    {
        return request()->is($url) || request()->is($url . '/*') ? 'text-white bg-stone-600' : 'text-gray-700 hover:bg-gray-100';
    }
}

if (!function_exists("redirect_user")) {
    function redirect_user(
        $icon,
        $text,
        $route = "",
    ) {
        return $route != ""
            ? redirect()->route($route)->with("notification", [
                "icon" => $icon,
                "title" => $icon == "success" ? "Success" : "Error",
                "text" => $text,
            ])
            : redirect()->back()->with("notification", [
                "icon" => $icon,
                "title" => $icon == "success" ? "Success" : "Error",
                "text" => $text,
            ]);
    }
}

if (!function_exists("notificationFlash")) {
    function notificationFlash($icon, $text)
    {
        session()->flash("notification", [
            "icon" => $icon,
            "title" => $icon == "success" ? "Success" : "Error",
            "text" => $text,
        ]);
    }
}

if (!function_exists("format_rupiah")) {
    function format_rupiah($number)
    {
        $formattedNumber = number_format($number, 0, ',', '.');
        return 'Rp ' . $formattedNumber;
    }
}

if (!function_exists("format_date")) {
    function format_date($date)
    {
        return date('l, d F Y - H:i:s', strtotime($date));
    }
}

if (!function_exists("getPlanLabel")) {
    function getPlanLabel($course_id, $course_detail_id)
    {
        $course = Course::find($course_id);
        $course_detail = CourseDetail::find($course_detail_id);
        return $course->name . " - " . $course_detail->name;
    }
}

if (!function_exists("generateDate")) {
    function generateDate()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        $years = [$currentYear, $currentYear + 1];

        $calendarData = [];

        foreach ($years as $year) {
            $startMonth = ($year == $currentYear) ? $currentMonth : 1;

            for ($month = $startMonth; $month <= 12; $month++) {
                $carbonDate = Carbon::createFromDate($year, $month, 1);
                $monthName = $carbonDate->translatedFormat('F');
                $daysInMonth = $carbonDate->daysInMonth;
                $firstDayOfWeek = $carbonDate->dayOfWeek;

                $calendarData[$year][$monthName] = [
                    'days' => range(1, $daysInMonth),
                    'startDay' => $firstDayOfWeek
                ];
            }
        }

        return [
            "years" => $years,
            "calendarData" => $calendarData,
        ];
    }
}


if (!function_exists("generateDateSalon")) {
    function generateDateSalon()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        $years = [$currentYear, $currentYear + 1];

        $calendarData = [];
        $allDates = []; // Tambahkan array untuk menyimpan daftar tanggal

        foreach ($years as $year) {
            $startMonth = ($year == $currentYear) ? $currentMonth : 1;

            for ($month = $startMonth; $month <= 12; $month++) {
                $carbonDate = Carbon::createFromDate($year, $month, 1);
                $monthName = $carbonDate->translatedFormat('F');
                $daysInMonth = $carbonDate->daysInMonth;
                $firstDayOfWeek = $carbonDate->dayOfWeek;

                $calendarData[$year][$monthName] = [
                    'days' => range(1, $daysInMonth),
                    'startDay' => $firstDayOfWeek
                ];

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $dateString = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
                    $allDates[] = $dateString;
                }
            }
        }

        return [
            "years" => $years,
            "calendarData" => $calendarData,
            "allDates" => $allDates,
        ];
    }
}


if (!function_exists("getCourse")) {
    function getCourse($plan)
    {
        $course_name = trim(explode(" - ", $plan)[0]);
        return Course::firstWhere("name", $course_name);
    }
}

if (!function_exists("getCourseDetail")) {
    function getCourseDetail($plan, $course_id)
    {
        $course_name = trim(explode(" - ", $plan)[1]);
        return CourseDetail::where("name", $course_name)->where("course_id", $course_id)->first();
    }
}

if (!function_exists("isAvailableSchedule")) {
    function isAvailableSchedule($date, $hour, $capacity, $roomID)
    {
        $max_capacity = Room::find($roomID)->capacity;

        if ($capacity > $max_capacity) {
            return true;
        }

        $schedule = Schedule::whereDate("date", $date->format('Y-m-d'))
            ->whereTime("time", str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00:00');

        $isAvailable = $schedule->exists();
        if (!$isAvailable) {
            return false;
        } else {
            $capacityNow = $schedule->sum("capacity");
            $newCapacity = $capacity + $capacityNow;
            if ($newCapacity > 9) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists("isNotAvailableTrainer")) {
    function isNotAvailableTrainer($trainer_id, $date, $hour)
    {
        $schedule = Transaction::whereDate("date", $date->format('Y-m-d'))
            ->whereTime("time", str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00:00')
            ->where('trainer_id', $trainer_id)

            // Tambahan Validasi
            ->whereIn('payment_status', ['waiting', 'paid'])
            ->exists();

        return $schedule;
    }
}

if (!function_exists("isRentedRoom")) {
    function isRentedRoom($date, $hour)
    {
        $isRented = false;

        $rentDetail = RentTransactionDetail::whereDate("date", $date->format('Y-m-d'))
            ->whereTime("time", str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00:00')
            ->first();

        if ($rentDetail) {
            $isRented = $rentDetail->whereHas("rentTransaction", function ($query) {
                $query->whereIn('status', ['waiting', 'paid']);
            })->exists();
        }

        // $rentDetail = RentTransactionDetail::whereDate("date", $date->format('Y-m-d'))
        //     ->whereTime("time", str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00:00')
        //     ->exists();
        // return $rentDetail;

        return $isRented;
    }
}

if (!function_exists("getSchedules")) {
    function getSchedules($date, $hour)
    {
        return Schedule::whereDate("date", $date->format('Y-m-d'))
            ->whereTime("time", str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00:00')
            ->get();
    }
}

if (!function_exists("getTransactionOneYear")) {
    function getTransactionOneYear()
    {
        $months = range(1, 12);
        $transactions = Transaction::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(id) as total_transactions'),
            DB::raw('SUM(total) as total_revenue')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->keyBy('month');

        $monthlyTransactions = collect($months)->map(function ($month) use ($transactions) {
            return [
                'month' => $month,
                'total_transactions' => $transactions[$month]->total_transactions ?? 0,
                'total_revenue' => $transactions[$month]->total_revenue ?? 0.0,
            ];
        });

        return $monthlyTransactions;
    }
}

if (!function_exists("getTransactionRentOneYear")) {
    function getTransactionRentOneYear()
    {
        $months = range(1, 12);
        $transactions = RentTransaction::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(id) as total_transactions'),
            DB::raw('SUM(total) as total_revenue')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->keyBy('month');

        $monthlyTransactions = collect($months)->map(function ($month) use ($transactions) {
            return [
                'month' => $month,
                'total_transactions' => $transactions[$month]->total_transactions ?? 0,
                'total_revenue' => $transactions[$month]->total_revenue ?? 0.0,
            ];
        });

        return $monthlyTransactions;
    }
}

if (!function_exists("getTransactionSalonOneYear")) {
    function getTransactionSalonOneYear()
    {
        $months = range(1, 12);
        $transactions = BookingSalon::select(
            DB::raw('MONTH(booking_salons.created_at) as month'),
            DB::raw('COUNT(booking_salons.id) as total_transactions'),
            DB::raw('SUM(services.price) as total_revenue')
        )
            ->join('services', 'booking_salons.service_id', '=', 'services.id')
            ->whereYear('booking_salons.created_at', now()->year)
            ->groupBy(DB::raw('MONTH(booking_salons.created_at)'))
            ->orderBy(DB::raw('MONTH(booking_salons.created_at)'))
            ->get()
            ->keyBy('month');

        $monthlyTransactions = collect($months)->map(function ($month) use ($transactions) {
            return [
                'month' => $month,
                'total_transactions' => $transactions[$month]->total_transactions ?? 0,
                'total_revenue' => $transactions[$month]->total_revenue ?? 0.0,
            ];
        });

        return $monthlyTransactions;
    }
}


if (!function_exists("getTransactionPerCategory")) {
    function getTransactionPerCategory()
    {
        $transactions = Transaction::all();
        $courses = [];
        foreach (Course::all() as $course) {
            $count = 0;
            foreach ($transactions as $transaction) {
                if (getCourse($transaction->plan)->id == $course->id) {
                    $count++;
                }
            }
            $courses[] = [
                "name" => $course->name,
                "count" => $count,
            ];
        }
        return $courses;
    }
}

if (!function_exists("getTimeTable")) {
    function getTimeTable($index, $day = null)
    {
        if ($day == null) {
            return TimeTable::where("index", $index)->get();
        }
        return TimeTable::where("index", $index)->where("day", $day)->first();
    }
}

if (!function_exists('shouldDeductSession')) {
    function shouldDeductSession($memberPlan)
    {
        if (!$memberPlan) {
            return false;
        }

        $today = Carbon::today();
        return $memberPlan->last_deducted_at !== $today->toDateString();
    }
}

if (!function_exists('canCancelClass')) {
    function canCancelClass($schedule)
    {
        if (!$schedule) {
            return false;
        }

        $classDateTime = $schedule->date->setTimeFrom($schedule->time);
        $now = Carbon::now();

        return $now->diffInHours($classDateTime, false) >= 12;
        // return $now->diffInHours($classDateTime, false) >= 24;
    }
}

if (!function_exists("verifiedUser")) {
    function verifiedUser()
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            if ($user->email_verified_at == null) {
                return true;
            }
        }
    }
}

if (!function_exists("getRangeRoomPrice")) {
    function getRangeRoomPrice($id)
    {
        $room = Room::find($id);
        $prices = [
            $room->rent_price_under_10["with_bath"],
            $room->rent_price_under_10["without_bath"],
            $room->rent_price_over_10["with_bath"],
            $room->rent_price_over_10["without_bath"]
        ];

        $lowerPrice = format_rupiah(min($prices));
        $upperPrice = format_rupiah(max($prices));

        return "{$lowerPrice} - {$upperPrice}";
    }
}

if (!function_exists("getClassFooter")) {
    function getClassFooter()
    {
        return Course::limit(5)->get();
    }
}

if (!function_exists("getServiceFooter")) {
    function getServiceFooter()
    {
        return Service::limit(5)->get();
    }
}

if (!function_exists("confirmTransaction")) {
    function confirmTransaction($transaction)
    {
        $member = null;
        if (Member::where("user_id", $transaction->user_id)->exists()) {
            $member = Member::where("user_id", $transaction->user_id)->first();
        } else {
            $member = Member::create([
                "user_id" => $transaction->user_id,
            ]);
        }

        $type = trim(explode(" - ", $transaction->plan)[2]);
        $subscribed_date = Carbon::parse(now());
        $remaining_session = 0;
        if ($type == "10 Session") {
            $expired_date = $subscribed_date->copy()->addMonths(4);
            $extend_expired_date_month = 4;
            $remaining_session = 10;
        } else if ($type == "20 Session") {
            $expired_date = $subscribed_date->copy()->addMonths(6);
            $extend_expired_date_month = 6;
            $remaining_session = 20;
        } else {
            $expired_date = $subscribed_date->copy()->addDay();
            $extend_expired_date_month = 1;
            $remaining_session = 1;
        }

        // Tambah Session Member Plan
        if (MemberPlan::where("member_id", $member->id)->where("plan", $transaction->plan)->exists()) {
            $memberPlan = MemberPlan::where("member_id", $member->id)->where("plan", $transaction->plan)->first();
            $memberPlan->update([
                "expired_date" => $memberPlan->expired_date->addMonths($extend_expired_date_month),
                "remaining_session" => $remaining_session + $memberPlan->remaining_session,
            ]);
        } else {
            $memberPlan = MemberPlan::create([
                "member_id" => $member->id,
                "trainer_id" => $transaction->trainer_id,
                "room_id" => $transaction->room_id,
                "plan" => $transaction->plan,
                // "day" => $transaction->day,
                // "time" => $transaction->time,
                "subscribed_date" => $subscribed_date,
                "expired_date" => $expired_date,
                "remaining_session" => $remaining_session,
                "status" => "active",
            ]);
        }

        $plan = $transaction->plan;
        $course_name = trim(explode(" - ", $plan)[0]);
        $course_detail_name = trim(explode(" - ", $plan)[1]);
        $course_detail = CourseDetail::where('name', $course_detail_name)->whereHas("course", function ($query) use ($course_name) {
            $query->where('name', $course_name);
        })->first();

        if ($transaction->date) {
            Schedule::create([
                'member_id' => $transaction->user->member->id,
                "member_plan_id" => $memberPlan->id,
                'room_id' => $transaction->room_id,
                'course_detail_id' => $course_detail->id,
                'course_id' => $course_detail->course_id,
                'trainer_id' => $transaction->trainer_id,
                'date' => $transaction->date,
                'time' => $transaction->time,
                'capacity' => $transaction->capacity,
            ]);
        }

        // Kebutuhan Email
        $data = [
            "invoice" => $transaction->invoice,
            "transaction_date" => $transaction->created_at,
            "label" => $transaction->plan,
            "total" => $transaction->total,
            "proof_of_payment" => $transaction->proof_of_payment,
            "status" => $transaction->payment_status,
        ];
        Mail::to($transaction->user->email)->queue(new SendPaymentConfirm($data, "confirmed"));
        notificationFlash("success", "Successfully Confirm Payment");
    }
}

if (!function_exists("cancelTransaction")) {
    function cancelTransaction($transaction)
    {
        // Kebutuhan Email
        $data = [
            "invoice" => $transaction->invoice,
            "transaction_date" => $transaction->created_at,
            "label" => $transaction->plan,
            "total" => $transaction->total,
            "proof_of_payment" => $transaction->proof_of_payment,
            "status" => $transaction->payment_status,
        ];
        Mail::to($transaction->user->email)->queue(new SendPaymentConfirm($data, "cancelled"));
        notificationFlash("success", "Successfully Cancel Transaction");
    }
}
