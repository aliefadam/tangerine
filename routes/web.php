<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, "home"])->name("home");
Route::get('/about', [FrontendController::class, "about"])->name("about");
Route::get('/trainer', [FrontendController::class, "trainer"])->name("trainer");
Route::prefix("classes")->group(function () {
    Route::get('/', [FrontendController::class, "classes"])->name("classes");
    Route::get('/{slug}', [FrontendController::class, "class_detail"])->name("class.detail");
});
Route::get('/schedule', [FrontendController::class, "schedule"])->name("schedule");

Route::middleware(["auth"])->group(function () {
    Route::middleware(["verified"])->group(function () {});

    Route::prefix("profile")->group(function () {
        Route::get("/", [FrontendController::class, "profile"])->name("profile");
    });

    Route::post("/membership", [MemberController::class, "checkout"])->name("member");
    Route::get("/membership/checkout", [FrontendController::class, "checkout"])->name("member.checkout");
    Route::post("/membership/checkout", [TransactionController::class, "store"])->name("member.checkout.post");
    Route::get("/payment/waiting/{invoice}", [FrontendController::class, "payment_waiting"])->name("payment.waiting");
    Route::post("/upload/proof", [TransactionController::class, "upload_proof"])->name("payment.upload.proof");

    Route::get("/get-schedule-month", [ScheduleController::class, "get_schedule_month"])->name("schedule.get");
    Route::get("/get-schedule-day/{date}", [ScheduleController::class, "get_schedule_day"])->name("schedule.get");

    include_once __DIR__ . "/admin.php";
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware(["guest"])->group(callback: function () {
    include_once __DIR__ . "/auth.php";
});

include_once __DIR__ . "/verify-email.php";
