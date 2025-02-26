<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
