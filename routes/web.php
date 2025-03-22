<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Middleware\CheckSessionUser;
use App\Http\Middleware\NavbarSalon;
use App\Http\Middleware\NavbarWellness;
use App\Http\Middleware\UpdateMembershipStatus;
use App\Http\Middleware\UpdateRemainingSession;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware([UpdateRemainingSession::class, UpdateMembershipStatus::class])->group(function () {
    Route::get('/', function () {
        return redirect()->route("gate");
    });

    Route::middleware(UserMiddleware::class)->group(function () {
        Route::get("/gate", [FrontendController::class, "gate"])->name("gate");

        Route::middleware([NavbarWellness::class])->group(function () {
            include_once __DIR__ . "/wellness.php";
        });
        Route::middleware([NavbarSalon::class])->group(function () {
            include_once __DIR__ . "/salon.php";
        });

        Route::middleware(["auth", "verified", CheckSessionUser::class])->group(function () {
            Route::prefix("profile")->group(function () {
                Route::get("/", [FrontendController::class, "profile"])->name("profile");
                Route::put("/", [FrontendController::class, "edit_profile"])->name("profile.update");
                Route::put("/change-password", [FrontendController::class, "change_password"])->name("profile.change-password");
            });
            Route::prefix("transaction")->group(function () {
                Route::get("/", [FrontendController::class, "transaction"])->name("transaction");
                Route::get("/{id}", [FrontendController::class, "transaction_detail"])->name("transaction.detail");
            });
            Route::prefix("rent-transaction")->group(function () {
                Route::get("/", [FrontendController::class, "rent_transaction"])->name("rent-transaction");
                Route::get("/{id}", [FrontendController::class, "rent_transaction_detail"])->name("rent-transaction.detail");
            });
            Route::prefix("booking-transaction")->group(function () {
                Route::get("/", [FrontendController::class, "booking_transaction"])->name("booking-salon");
            });
        });
    });

    include_once __DIR__ . "/admin.php";
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");

    Route::middleware(["guest"])->group(callback: function () {
        include_once __DIR__ . "/auth.php";
    });

    include_once __DIR__ . "/verify-email.php";
});

include_once __DIR__ . "/invoice-tes.php";
