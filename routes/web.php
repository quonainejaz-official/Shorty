<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShortLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'registerPage'])->name('Register-page');
Route::post('/register/submit', [AuthController::class, 'registerSubmit'])->name('register-submit');

Route::get('/login', [AuthController::class, 'loginPage'])->name('Login-page');
Route::post('/login/submit', [AuthController::class, 'loginSubmit'])->name('login-submit');

Route::get('/forgot-password', [AuthController::class, 'forgotPasswordPage'])->name('forgot-password');
Route::post('/forgot-password/submit', [AuthController::class, 'forgotPasswordSubmit'])->name('forgot-password-submit');

Route::get('/otp/enter', [AuthController::class, 'otpEnterPage'])->name('otp.enter');
Route::post('/otp/verify', [AuthController::class, 'otpVerifySubmit'])->name('otp.verify');

Route::get('/reset-password', [AuthController::class, 'resetPasswordPage'])->name('password.reset');
Route::post('/reset-password/submit', [AuthController::class, 'resetPasswordSubmit'])->name('password.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'Dashboard'])->name('dashboard');
Route::get('/dashboard', [HomeController::class, 'Dashboard'])->name('dashboard');

Route::post('/shorten', [ShortLinkController::class, 'store'])->name('shorten.store')->middleware('auth');

Route::get('/{shortCode}', [ShortLinkController::class, 'redirect'])->name('shorten.redirect');
