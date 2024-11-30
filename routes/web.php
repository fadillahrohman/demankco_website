<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MockupController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

// Tes mockup
Route::get('/fabric', function () {
    return view('fabric');
})->name('fabric');

// Mockup
Route::get('/mockup/t-shirt', [MockupController::class, 'mockupTshirt'])->name('mockT-shirt');
Route::get('/mockup/crewneck', [MockupController::class, 'mockupCrewneck'])->name('mockCrewneck');
Route::get('/mockup/hoodie', [MockupController::class, 'mockupHoodie'])->name('mockHoodie');

// Route::middleware('auth:user')->controller(OrderController::class)->group(function () {
//     Route::get('/order/t-shirt', 'orderTshirt')->name('orderTshirt'); 
//     Route::get('/order/crewneck','orderCrewneck')->name('orderCrewneck'); 
//     Route::get('/order/hoodie','orderHoodie')->name('orderHoodie'); 
// });

Route::get('/order/t-shirt', [OrderController::class, 'orderTshirt'])->name('orderTshirt'); 
Route::get('/order/crewneck', [OrderController::class, 'orderCrewneck'])->name('orderCrewneck'); 
Route::get('/order/hoodie', [OrderController::class, 'orderHoodie'])->name('orderHoodie'); 

Route::post('/order/t-shirt', [OrderController::class, 'check_ongkir']);
Route::post('/order/crewneck', [OrderController::class, 'check_ongkir']);
Route::post('/order/hoodie', [OrderController::class, 'check_ongkir']);
Route::get('/cities/{province_id}', [OrderController::class, 'getCities']);

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

// Mockup save state test
Route::post('/mockup/save', [MockupController::class, 'saveMockup'])->name('mockup.save')->middleware('auth');
Route::get('/mockup/load', [MockupController::class, 'loadMockup'])->name('mockup.load')->middleware('auth');


