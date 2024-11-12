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

Route::get('/login', [LoginController::class, 'tampilLogin'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [RegisterController::class, 'tampilRegister'])->name('register');

Route::post('/register/submit', [RegisterController::class, 'submitRegistrasi'])->name('registrasi-submit');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


Route::get('/verify-email', function () {
    return view('auth.verify-email'); 
})->name('verify-email');

// EMAIL VERIFICATION
Route::get('/email/verify', [EmailVerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// PROTECTED ROUTE FOR VERIFIED USERS
Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth', 'verified']);
