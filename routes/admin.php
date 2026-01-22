<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::prefix('admin')->group(function () {
    // Auth Routes
    Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.store');
    Route::get('/register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('admin.register.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:admin')->name('admin.dashboard');

    // Category Routes
    Route::resource('categories', CategoryController::class, ['as' => 'admin']);

    // Product Routes
    Route::resource('products', ProductController::class, ['as' => 'admin']);
});
