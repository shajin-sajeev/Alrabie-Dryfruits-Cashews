<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\GoogleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::prefix('admin')->group(function () {
    // Auth Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.store');
        Route::get('/register', [AuthController::class, 'register'])->name('admin.register');
        Route::post('/register', [AuthController::class, 'storeRegister'])->name('admin.register.store');

        // Google Auth
        Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('admin.auth.google');
        Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('admin.auth.google.callback');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('admin.logout');

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');

    // Category Routes
    Route::middleware('auth')->resource('categories', CategoryController::class, ['as' => 'admin']);

    // Product Routes
    Route::middleware('auth')->resource('products', ProductController::class, ['as' => 'admin']);
});
