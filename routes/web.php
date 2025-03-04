<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Middleware\UpdateMembershipStatus;
use App\Http\Middleware\UpdateRemainingSession;
use Illuminate\Support\Facades\Route;

Route::get("/tes-email", function () {
    return view('mail.send-invoice-mail-to-user', [
        "data" => [
            "invoice" => "123123123ASDASD",
            "transaction_date" => format_date(now()),
            "label" => "Pilates Classes Director - Company Class - Drop In",
            "total" => 100000,
        ]
    ]);
});
Route::get("/tes-email-proof", function () {
    return view('mail.send-proof-payment', [
        "data" => [
            "invoice" => "123123123ASDASD",
            "transaction_date" => format_date(now()),
            "label" => "Pilates Classes Director - Company Class - Drop In",
            "total" => 100000,
            "proof_of_payment" => "PROOF_IMAGE_202502280318172.jpg",
        ]
    ]);
});
Route::get("/tes-email-confirm", function () {
    return view('mail.send-payment-confirm', [
        "data" => [
            "invoice" => "123123123ASDASD",
            "transaction_date" => format_date(now()),
            "label" => "Pilates Classes Director - Company Class - Drop In",
            "total" => 100000,
            "proof_of_payment" => "PROOF_IMAGE_202502280318172.jpg",
        ]
    ]);
});

Route::middleware([UpdateRemainingSession::class, UpdateMembershipStatus::class])->group(function () {
    Route::get('/', [FrontendController::class, "home"])->name("home");
    Route::get('/about', [FrontendController::class, "about"])->name("about");
    Route::get('/trainer', [FrontendController::class, "trainer"])->name("trainer");
    Route::prefix("classes")->group(function () {
        Route::get('/', [FrontendController::class, "classes"])->name("classes");
        Route::get('/{slug}', [FrontendController::class, "class_detail"])->name("class.detail");
    });
    Route::get('/schedule', [FrontendController::class, "schedule"])->name("schedule");

    Route::middleware(["auth"])->group(function () {
        Route::middleware(["verified"])->group(function () {
            include_once __DIR__ . "/user.php";
        });

        include_once __DIR__ . "/admin.php";
        Route::get("/logout", [AuthController::class, "logout"])->name("logout");
    });

    Route::middleware(["guest"])->group(callback: function () {
        include_once __DIR__ . "/auth.php";
    });

    include_once __DIR__ . "/verify-email.php";
});
