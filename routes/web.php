<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MockupController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

//////// Tes mockup
Route::get('/fabric', function () {
    return view('fabric');
})->name('fabric');

// Mockup
Route::get('/mockup/t-shirt', function () {
    return view('mockup.t-shirt');
})->name('mockT-shirt');
Route::get('/mockup/crewneck', function () {
    return view('mockup.crewneck');
})->name('mockCrewneck');
Route::get('/mockup/hoodie', function () {
    return view('mockup.hoodie');
})->name('mockHoodie');

Route::get('/order', function () {
    return view('order');
})->name('orderCoy');



// USERS AUTH
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');


// USER REGISTER
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register/submit', [RegisterController::class, 'submitRegister'])->name('register-submit');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// USER VERIFY EMAIL
Route::get('/verify-otp/{email}', [RegisterController::class, 'showVerifyOtp'])->name('verify.otp');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('verify.process');
Route::post('/resend-otp', [RegisterController::class, 'resendOtp'])->name('resend.otp');

// USER Route Catalog
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalogs.list');

// Mockup
Route::post('/mockup/save', [MockupController::class, 'saveMockup'])->name('mockup.save')->middleware('auth');
Route::get('/mockup/load', [MockupController::class, 'loadMockup'])->name('mockup.load')->middleware('auth');


