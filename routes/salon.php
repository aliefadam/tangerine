<?php

use App\Http\Controllers\BookingSalonController;
use App\Http\Controllers\FrontendController;
use App\Http\Middleware\CheckSessionUser;
use App\Models\BookingSalon;
use Illuminate\Support\Facades\Route;

Route::prefix("salon")->group(function () {
    Route::get('/', [FrontendController::class, "salon_home"])->name("home.salon");
    Route::get('/about', [FrontendController::class, "salon_about"])->name("about.salon");
    Route::get('/beautician', [FrontendController::class, "beautician"])->name("beautician.salon");

    Route::prefix("services")->group(function () {
        Route::get('/', [FrontendController::class, "services"])->name("services.salon");
        Route::get('/{slug}', [FrontendController::class, "service_detail"])->name("service.detail.salon");
    });

    Route::get('/product', [FrontendController::class, "product"])->name("product.salon");
    Route::get('/checkout', [FrontendController::class, "checkout"])->name("checkout.salon");

    Route::middleware(["auth", "verified", CheckSessionUser::class])->group(function () {
        Route::post("/service/booking", [BookingSalonController::class, "storeBooking"])->name("service.booking");

        // Route::get("/payment/waiting/{invoice}", [FrontendController::class, "payment_waiting"])->name("payment.waiting");
        // Route::post("/upload/proof", [TransactionController::class, "upload_proof"])->name("payment.upload.proof");
    });
});
