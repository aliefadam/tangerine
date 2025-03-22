<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RentTransactionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\CheckSessionUser;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix("wellness")->group(function () {
    Route::get('/', [FrontendController::class, "home"])->name("home");
    Route::get('/about', [FrontendController::class, "about"])->name("about");
    Route::get('/trainer', [FrontendController::class, "trainer"])->name("trainer");
    Route::prefix("classes")->group(function () {
        Route::get('/', [FrontendController::class, "classes"])->name("classes");
        Route::get('/{slug}', [FrontendController::class, "class_detail"])->name("class.detail");
    });
    Route::get('/schedule', [FrontendController::class, "schedule"])->name("schedule");
    Route::get('/room-rental', [FrontendController::class, "room_rental"])->name("room-rental");

    Route::middleware(["auth", "verified", CheckSessionUser::class])->group(function () {
        Route::middleware(UserMiddleware::class)->group(function () {
            Route::prefix("schedule")->group(function () {
                Route::post("/", [ScheduleController::class, "store_from_member"])->name("schedule.store");
                Route::delete("/{id}", [ScheduleController::class, "destroy"])->name("schedule.destroy");
            });
            Route::post("/membership", [MemberController::class, "checkout"])->name("member");
            Route::get("/membership/checkout", [FrontendController::class, "checkout"])->name("member.checkout");
            Route::post("/membership/checkout", [TransactionController::class, "store"])->name("member.checkout.post");
            Route::get("/payment/waiting/{invoice}", [FrontendController::class, "payment_waiting"])->name("payment.waiting");
            Route::get("/payment/waiting/rent/{invoice}", [FrontendController::class, "payment_waiting_rent"])->name("payment.waiting.rent");
            Route::post("/upload/proof", [TransactionController::class, "upload_proof"])->name("payment.upload.proof");

            Route::get("/get-schedule-month", [ScheduleController::class, "get_schedule_month"])->name("schedule.get");
            Route::get("/get-schedule-day/{date}", [ScheduleController::class, "get_schedule_day"])->name("schedule.get");
            Route::get("/get-schedule-day-rent-room/{date}", [ScheduleController::class, "get_schedule_day_rent_room"])->name("schedule.get.rent-room");

            Route::get("/get-price-rent-room/{hour_count}/{room_id}", [FrontendController::class, "get_price_rent_room"])->name("get-price-rent-room");

            Route::get("/get-detail-order", [FrontendController::class, "get_detail_order"])->name("get-detail-order");
            Route::post("/rent-transaction", [RentTransactionController::class, "store"])->name("rent-transaction.store");
            Route::post("/upload/proof/rent", [RentTransactionController::class, "upload_proof"])->name("payment.rent.upload.proof");
        });
    });
});
