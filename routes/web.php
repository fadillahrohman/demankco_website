<?php
use App\Models\Order;
use App\Http\Controllers\Admin\AdminCatalogController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminLogoutController;
use App\Http\Controllers\Admin\AdminListOrderController;
use App\Http\Controllers\Admin\AdminLaporanController;

use App\Http\Controllers\CatalogController;
// use App\Http\Controllers\CheckOngkirController;
use App\Http\Controllers\Customer\ListOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MockupController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuterController;


Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

// tes putter
Route::get('/puter/testing', [PuterController::class, 'testing']);

// ADMIN AUTH
Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('login');
Route::get('/admin/logout', [AdminLogoutController::class, 'logout'])->name('logout');
Route::post('/admin/authenticate', [AdminLoginController::class, 'adminAuthenticate'])->name('admin.authenticate');


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/list-orders', [AdminListOrderController::class, 'index'])->name('admin.list-orders');
    Route::get('/admin/detail-orders/{order}', [AdminListOrderController::class, 'show'])->name('admin.detail-orders');
    Route::post('/admin/list-order/{order}/update-status', [AdminListOrderController::class, 'updateStatus'])->name('admin.list-order-update');
});

// ADMIN LAPORAN PDF
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/admin/laporan-pdf', [AdminLaporanController::class, 'cetak_pdf'])->name('admin.laporan-pdf');
});

// ADMIN CATALOG
Route::middleware('auth:admin')->controller(AdminCatalogController::class)->group(function () {
    Route::get('/admin/catalog', 'index')->name('admin.catalogs.list');
    Route::get('/admin/catalog/create', 'create')->name('admin.catalogs.create');
    Route::post('/admin/catalog', 'store')->name('admin.catalogs.store');
    Route::get('/admin//catalog/{catalog}/edit', 'edit')->name('admin.catalogs.edit');
    Route::put('/admin/catalog/{catalog}', 'update')->name('admin.catalogs.update');
    Route::delete('/admin/catalog/{catalog}', 'destroy')->name('admin.catalogs.destroy');
});

  // USER MOCKUP
Route::get('/mockup/t-shirt', [MockupController::class, 'mockupTshirt'])->name('mockT-shirt');
Route::get('/mockup/crewneck', [MockupController::class, 'mockupCrewneck'])->name('mockCrewneck');
Route::get('/mockup/hoodie', [MockupController::class, 'mockupHoodie'])->name('mockHoodie');

// USER MIDDLEWARE
Route::middleware('auth')->group(function () {
    // USER ORDER
    Route::get('/order/t-shirt', [OrderController::class, 'orderTshirt'])->name('orderTshirt');
    Route::get('/order/crewneck', [OrderController::class, 'orderCrewneck'])->name('orderCrewneck');
    Route::get('/order/hoodie', [OrderController::class, 'orderHoodie'])->name('orderHoodie');
    Route::get('/order/detail/{id}', [OrderController::class, 'orderDetail'])->name('orderDetail');

    // USER ORDER & CHECK SHIPPING
    Route::post('/order/t-shirt', [OrderController::class, 'check_ongkir']);
    Route::post('/order/crewneck', [OrderController::class, 'check_ongkir']);
    Route::post('/order/hoodie', [OrderController::class, 'check_ongkir']);
    Route::get('/cities/{province_id}', [OrderController::class, 'getCities']);
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');;
});


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

// USER FORGOT PASSWORD BLENGER
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('forgotpassword');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');


// USER ROUTE CATALOG
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalogs.list');

Route::get('/list/orders', [ListOrderController::class, 'index'])->name('customer.orders.index');
Route::get('/detail/orders/{order}', [ListOrderController::class, 'show'])->name('customer.orders.show');
Route::get('/orders/success', function() {
    return view('orders.success'); // Mengarahkan langsung ke view success - sementara han
})->name('orders.success');
Route::post('/payment/midtrans-callback', [PaymentController::class, 'midtransCallback'])
    ->withoutMiddleware(['web', 'csrf']);   