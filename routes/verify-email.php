<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify/{id}/{hash}', [AuthController::class, "verify"])->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/email/verify', [AuthController::class, "verificationNotice"])->middleware('auth')->name('verification.notice');
Route::post('/email/verification-notification', [AuthController::class, "sendVerificationEmail"])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
