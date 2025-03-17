<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RentTransactionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\UserMiddleware;
use App\Models\RentTransaction;
use Illuminate\Support\Facades\Route;

Route::middleware(UserMiddleware::class)->group(function () {

    Route::prefix("profile")->group(function () {
        Route::get("/", [FrontendController::class, "profile"])->name("profile");
        Route::put("/", [FrontendController::class, "edit_profile"])->name("profile.update");
        Route::put("/change-password", [FrontendController::class, "change_password"])->name("profile.change-password");
    });

    Route::prefix("schedule")->group(function () {
        Route::post("/", [ScheduleController::class, "store_from_member"])->name("schedule.store");
        Route::delete("/{id}", [ScheduleController::class, "destroy"])->name("schedule.destroy");
    });

    Route::prefix("transaction")->group(function () {
        Route::get("/", [FrontendController::class, "transaction"])->name("transaction");
        Route::get("/{id}", [FrontendController::class, "transaction_detail"])->name("transaction.detail");
    });

    Route::prefix("rent-transaction")->group(function () {
        Route::get("/", [FrontendController::class, "rent_transaction"])->name("rent-transaction");
        Route::get("/{id}", [FrontendController::class, "rent_transaction_detail"])->name("rent-transaction.detail");
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
