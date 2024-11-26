<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MockupController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/catalog', function () {
    return view('catalog');
})->name('catalog');

//////// Tes mockup
Route::get('/fabric', function () {
    return view('fabric');
})->name('fabric');

Route::get('/mockup/crewneck', function () {
    return view('mockup.crewneck');
})->name('mockup-crewneck');

Route::get('/mockup', [MockupController::class, 'mockup'])->name('mockup')->middleware('auth');

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/register/submit', [RegisterController::class, 'submitRegister'])->name('register-submit');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/verify-otp/{email}', [RegisterController::class, 'showVerifyOtp'])->name('verify.otp');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('verify.process');
Route::post('/resend-otp', [RegisterController::class, 'resendOtp'])->name('resend.otp');

// Mockup
Route::post('/mockup/save', [MockupController::class, 'saveMockup'])->name('mockup.save')->middleware('auth');
Route::get('/mockup/load', [MockupController::class, 'loadMockup'])->name('mockup.load')->middleware('auth');