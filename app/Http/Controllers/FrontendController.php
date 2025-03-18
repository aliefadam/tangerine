<?php

namespace App\Http\Controllers;

use App\Models\Beautician;
use App\Models\BookingSalon;
use App\Models\Course;
use App\Models\Product;
use App\Models\RentTransaction;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\ScheduleService;
use App\Models\Service;
use App\Models\TimeTable;
use App\Models\Trainer;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FrontendController extends Controller
{
    public function gate()
    {
        return view('frontend.gate', [
            "title" => "Gate"
        ]);
    }

    public function home()
    {
        return view('frontend.welcome', [
            "title" => "Home",
            "courses" => Course::all(),
            "time_tables" => TimeTable::all(),
        ]);
    }

    public function salon_home()
    {
        return view('frontend.salon-welcome', [
            "title" => "Home",
            "courses" => Course::all(),
            "time_tables" => TimeTable::all(),
        ]);
    }

    public function about()
    {
        return view('frontend.about', [
            "title" => "About Us",
        ]);
    }

    public function salon_about()
    {
        return view('frontend.salon-about', [
            "title" => "About Us",
        ]);
    }

    public function beautician()
    {
        return view('frontend.beautician', [
            "title" => "Beautician",
            "beauticians" => Beautician::all(),
        ]);
    }

    public function trainer()
    {
        return view('frontend.trainer', [
            "title" => "Trainer",
            "trainers" => Trainer::all(),
        ]);
    }

    public function services()
    {
        return view('frontend.services', [
            "title" => "Services",
            "services" => Service::all(),
        ]);
    }

    public function service_detail($slug)
    {
        $service = Service::firstWhere("slug", $slug);
        $years = generateDateSalon()["years"];
        $calendarData = generateDateSalon()["calendarData"];
        $allDates = generateDateSalon()["allDates"]; // Ambil daftar tanggal yang benar

        // Ambil semua sesi yang tersedia
        $allSchedules = ScheduleService::pluck('id')->toArray(); // [1, 2, 3]

        // Ambil daftar booking yang sudah ada
        $bookedSessions = BookingSalon::select('booking_date', 'schedule_id')
            ->groupBy('booking_date', 'schedule_id')
            ->havingRaw('COUNT(id) >= 3') // Sesi yang sudah penuh
            ->get()
            ->groupBy('booking_date')
            ->map(function ($items) {
                return $items->pluck('schedule_id')->toArray();
            });

        // Format data availableSessions
        $availableSessions = [];
        foreach ($allDates as $date) {
            // Jika tidak ada booking pada tanggal tersebut, semua sesi tersedia
            if (!isset($bookedSessions[$date])) {
                $availableSessions[$date] = $allSchedules;
            } else {
                // Ambil sesi yang belum penuh
                $availableSessions[$date] = array_diff($allSchedules, $bookedSessions[$date]);
            }
        }

        return view('frontend.service-detail', [
            "title" => "Services",
            "service" => $service,
            "Beauticians" => Service::all(),
            "years" => $years,
            "calendarData" => $calendarData,
            "availableSessions" => $availableSessions,
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
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            if ($user->email_verified_at == null) {
                return redirect()->route("verification.notice");
            }
        }
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
        $schedules = Schedule::all();
        $years = generateDate()["years"];
        $calendarData = generateDate()["calendarData"];
        $course_name = trim(explode(" - ", $data["course_label_taken"])[0]);

        $course_id = getCourse($data["course_label_taken"])->id;
        $course_detail_person_max = getCourseDetail($data["course_label_taken"], $course_id)->person_max;

        if ($course_name == "Yoga Classes") {
            $rooms = Room::all();
        } else {
            $rooms = Room::where("used_for", "!=", "Yoga Only")->get();
        }

        $course_name_split = explode(" ", $course_name)[0];
        $trainers = Trainer::where("for_class", $course_name_split)->get();

        return view("frontend.checkout", [
            "title" => "Checkout",
            "data" => $data,
            "rooms" => $rooms,
            "trainers" => $trainers,
            "schedules" => $schedules,
            "years" => $years,
            "calendarData" => $calendarData,
            "course_name" => $course_name,
            "course_detail_person_max" => $course_detail_person_max,
        ]);
    }

    public function payment_waiting($invoice)
    {
        return view("frontend.payment-waiting", [
            "title" => "Payment Waiting",
            "transaction" => Transaction::firstWhere("invoice", $invoice)
        ]);
    }

    public function payment_waiting_rent($invoice)
    {
        return view("frontend.payment-waiting-rent", [
            "title" => "Payment Waiting",
            "transaction" => RentTransaction::firstWhere("invoice", $invoice)
        ]);
    }

    public function schedule()
    {
        return view('frontend.schedule', [
            "title" => "Schedule",
            "time_tables" => TimeTable::all(),
        ]);
    }

    public function room_rental()
    {
        $schedules = Schedule::all();
        $years = generateDate()["years"];
        $calendarData = generateDate()["calendarData"];
        return view('frontend.room-rental', [
            "title" => "Room Rental",
            "schedulesAll" => $schedules,
            "years" => $years,
            "calendarData" => $calendarData,
            "rooms" => Room::where("can_be_rent", true)->get(),
        ]);
    }

    public function get_price_rent_room($count_hour, $room_id)
    {
        $room = Room::find($room_id);
        return response()->json([
            "price" => format_rupiah($room->rent_price),
            "total" => format_rupiah($room->rent_price * $count_hour),
        ]);
    }

    public function transaction()
    {
        return view("frontend.transaction", [
            "title" => "Transaction",
            "transactions" => Transaction::where("user_id", Auth::user()->id)->latest()->get(),
        ]);
    }

    public function transaction_detail($id)
    {
        $transaction = Transaction::find($id);
        return response()->json([
            "html" => view("components.modal-detail-transaction", [
                "transaction" => $transaction,
            ])->render(),
        ]);
    }

    public function booking_transaction()
    {
        $transactions = BookingSalon::select(
            'booking_salons.id',
            'booking_salons.customer_name',
            'services.name as service_name',
            'services.price as service_price',
            'booking_salons.booking_date',
            'schedule_services.session as session',
            'booking_salons.queue_number',
            'booking_salons.created_at',
            'booking_salons.status',
            // 'booking_salons.payment_proof',
            'booking_salons.phone_number',
        )
            ->where("user_id", Auth::user()->id)
            ->join('services', 'booking_salons.service_id', '=', 'services.id')
            ->join('schedule_services', 'booking_salons.schedule_id', '=', 'schedule_services.id')
            ->orderBy('booking_salons.created_at', 'desc')
            ->get();

        return view("frontend.booking-transaction", [
            "title" => "Transaction",
            "transactions" => $transactions,
        ]);
    }

    public function rent_transaction()
    {
        return view("frontend.rent-transaction", [
            "title" => "Rent Transaction",
            "transactions" => RentTransaction::where("user_id", Auth::user()->id)->latest()->get(),
        ]);
    }

    public function rent_transaction_detail($id)
    {
        $transaction = RentTransaction::find($id);
        return response()->json([
            "html" => view("components.modal-detail-rent-transaction", [
                "transaction" => $transaction,
            ])->render(),
        ]);
    }

    public function get_detail_order(Request $request)
    {
        $room = Room::find($request->roomID);
        if ($request->participant <= 10) {
            if ($request->type == "with_bath") {
                $roomPrice = $room->rent_price_under_10["with_bath"];
            } else {
                $roomPrice = $room->rent_price_under_10["without_bath"];
            }
        } else {
            if ($request->type == "with_bath") {
                $roomPrice = $room->rent_price_over_10["with_bath"];
            } else {
                $roomPrice = $room->rent_price_over_10["without_bath"];
            }
        }
        $data = [
            "room_id" => $room->id,
            "room_name" => $room->name,
            "type" => $request->type,
            "participant" => $request->participant,
            "used_for" => $request->used_for,
            "hour" => $request->hour,
            "date" => $request->date,
            "time" => $request->time,
            "schedule_label" => Carbon::parse($request->date)->format("l, d F Y") . " • " . $request->time[0] . " - " . $request->time[count($request->time) - 1],
            "room_price" => $roomPrice,
            "sub_total" => $request->hour . " Hour x " . format_rupiah($roomPrice),
            "total_label" => format_rupiah($roomPrice * $request->hour),
            "total" => $roomPrice * $request->hour
        ];

        $userID = Auth::user()->id;
        session()->put("rent_transaction_{$userID}", $data);
        return response()->json($data);
    }

    public function profile()
    {
        $schedules = Schedule::all();
        $years = generateDate()["years"];
        $calendarData = generateDate()["calendarData"];

        $user = User::find(Auth::user()->id);
        return view("frontend.profile", [
            "title" => "Profile",
            "user" => $user,
            "schedulesAll" => $schedules,
            "years" => $years,
            "calendarData" => $calendarData,
            "schedules" => Schedule::where("member_id", $user->member ? $user->member->id : null)->get(),
            "upcoming_schedules" => $user->member ? Schedule::where("member_id", $user->member->id)
                ->whereDate("date", ">=", now()->format("Y-m-d"))->latest()->get() : collect(),
            "previous_schedules" => $user->member ? Schedule::where("member_id", $user->member->id)
                ->whereDate("date", "<=", now()->format("Y-m-d"))->latest()->get() : collect(),
        ]);
    }

    public function product()
    {
        return view('frontend.product', [
            "title" => "product",
            "products" => Product::all(),
        ]);
    }

    public function edit_profile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $updatedData = [
            "name" => $request->name,
            "phone" => $request->phone,
            "gender" => $request->gender,
        ];
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = "USER_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/users"), $fileName);
            if (File::exists(public_path("uploads/users/{$user->image}"))) {
                if ($user->image) {
                    unlink(public_path("uploads/users/{$user->image}"));
                }
            }
            $updatedData["image"] = $fileName;
        }
        $user->update($updatedData);
        return redirect_user("success", "Successfully Edit Profile", "profile");
    }

    public function change_password(Request $request)
    {
        $request->validate([
            "password_old" => "required|current_password",
            "password" => "required|confirmed",
        ]);

        $user = User::find(Auth::user()->id);
        $user->update([
            "password" => bcrypt($request->password)
        ]);

        Auth::logout();
        return redirect_user("success", "Successfully Change Password, Please Login Again", "login");
    }
}
