<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// API routes - stateless, no session
Route::post('/register', [AuthController::class, 'registerSubmit']);
Route::post('/login', [AuthController::class, 'loginSubmit']);
Route::post('/forgot-password', [AuthController::class, 'forgotPasswordSubmit'])->name('api.forgot-password');
Route::post('/otp-verify', [AuthController::class, 'otpVerifySubmit'])->name('api.otp.verify');
Route::post('/reset-password', [AuthController::class, 'resetPasswordSubmit'])->name('api.password.update');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [HomeController::class, 'dashboard']);
});
