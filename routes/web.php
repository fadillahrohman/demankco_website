<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/catalog', function () {
    return view('catalog');
})->name('catalog');
//////// Tes mockup
Route::get('/fabric', function () {
    return view('fabric');
})->name('fabric');
Route::get('/mockup', function () {
    return view('mockup');
})->name('mockup');

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/register/submit', [RegisterController::class, 'submitRegister'])->name('register-submit');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// In routes/web.php
Route::get('/verify-otp/{email}', [RegisterController::class, 'showVerifyOtp'])->name('verify.otp');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('verify.process');
Route::post('/resend-otp', [RegisterController::class, 'resendOtp'])->name('resend.otp');