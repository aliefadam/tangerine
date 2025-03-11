<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Middleware\UpdateMembershipStatus;
use App\Http\Middleware\UpdateRemainingSession;
use Illuminate\Support\Facades\Route;

Route::middleware([UpdateRemainingSession::class, UpdateMembershipStatus::class])->group(function () {
    Route::get('/', [FrontendController::class, "home"])->name("home");
    Route::get('/about', [FrontendController::class, "about"])->name("about");
    Route::get('/trainer', [FrontendController::class, "trainer"])->name("trainer");
    Route::prefix("classes")->group(function () {
        Route::get('/', [FrontendController::class, "classes"])->name("classes");
        Route::get('/{slug}', [FrontendController::class, "class_detail"])->name("class.detail");
    });
    Route::get('/schedule', [FrontendController::class, "schedule"])->name("schedule");
    Route::get('/room-rental', [FrontendController::class, "room_rental"])->name("room-rental");

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

include_once __DIR__ . "/invoice-tes.php";
