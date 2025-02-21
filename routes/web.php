<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth", "verified"])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name("home");

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, "verify"])->middleware(['signed'])->name('verification.verify');
    Route::get('/email/verify', [AuthController::class, "verificationNotice"])->middleware('auth')->name('verification.notice');
    Route::post('/email/verification-notification', [AuthController::class, "sendVerificationEmail"])->middleware(['throttle:6,1'])->name('verification.send');
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware(["guest"])->group(callback: function () {
    Route::get('/login', [AuthController::class, "login"])->name("login");
    Route::post('/login', [AuthController::class, "login_post"])->name("login.post");
    Route::get("/login/google", [AuthController::class, "redirectToGoogle"])->name("login.google");
    Route::get("/login/google/callback", [AuthController::class, "handleGoogleCallback"])->name("login.google.callback");
    Route::get('/register', [AuthController::class, "register"])->name("register");
    Route::post('/register', [AuthController::class, "register_post"])->name("register.post");
    Route::get('/register/verify', [AuthController::class, "register_verify"])->name('register.verify');
    Route::get("/forgot-password", [AuthController::class, "forgot_password"])->name("forgot-password");
    Route::post("/forgot-password", [AuthController::class, "forgot_password_post"])->name("forgot-password");
    Route::get("/forgot-password-done", [AuthController::class, "forgot_password_done"])->name("forgot-password-done");
    Route::get("/reset-password/{token}", [AuthController::class, "reset_password"])->name("password.reset");
    Route::post("/reset-password", [AuthController::class, "reset_password_post"])->name("password.update");
});
