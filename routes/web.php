<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MemberController;
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
    Route::post("/membership", [MemberController::class, "store"])->name("member.store");

    include_once __DIR__ . "/admin.php";
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware(["guest"])->group(callback: function () {
    include_once __DIR__ . "/auth.php";
});

include_once __DIR__ . "/verify-email.php";
