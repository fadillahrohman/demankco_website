<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/catalog', function () {
    return view('catalog');
})->name('catalog');

Route::get('/login', [LoginController::class, 'tampilLogin'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [RegisterController::class, 'tampilRegister'])->name('register');

Route::post('/register/submit', [RegisterController::class, 'submitRegistrasi'])->name('registrasi-submit');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
