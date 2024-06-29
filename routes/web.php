<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CateringController;

// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk memproses login pengguna
Route::post('/login', [AuthController::class, 'login']);

// Route untuk menampilkan form registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// Route untuk memproses registrasi pengguna
Route::post('/register', [AuthController::class, 'register']);

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk dashboard customer (hanya bisa diakses oleh user yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

    // Route untuk melakukan pemesanan catering oleh customer
    Route::get('/customer/catering/order/{menu}', [OrderController::class, 'showOrderForm'])->name('orders.form');
    Route::post('/customer/catering/order', [OrderController::class, 'store'])->name('orders.store');

    // Route untuk menampilkan daftar catering
    Route::get('/customer/catering', [CateringController::class, 'index'])->name('catering.index');

    // Route untuk melihat daftar pesanan customer
    Route::get('/customer/orders', [OrderController::class, 'customerOrders'])->name('customer.orders');
});

// Route untuk dashboard merchant (hanya bisa diakses oleh user yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/merchant/dashboard', [MerchantController::class, 'dashboard'])->name('merchant.dashboard');
    Route::get('/merchant/profile', [MerchantController::class, 'profile'])->name('merchant.profile');
    Route::post('/merchant/profile', [MerchantController::class, 'updateProfile'])->name('merchant.profile.update');

    // Route untuk manajemen menu oleh merchant
    Route::get('/merchant/menu', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/merchant/menu/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/merchant/menu/store', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/merchant/menu/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/merchant/menu/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/merchant/menu/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

    // Route untuk manajemen pesanan oleh merchant
    Route::get('/merchant/orders', [OrderController::class, 'merchantOrders'])->name('merchant.orders');
    Route::get('/merchant/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/merchant/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

// Route untuk melihat daftar pesanan customer dan merchant
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
