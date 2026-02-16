<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\GoogleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;

Route::prefix('admin')->group(function () {
    // Auth Routes - Only for unauthenticated admins
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.store');
        Route::get('/register', [AuthController::class, 'register'])->name('admin.register');
        Route::post('/register', [AuthController::class, 'storeRegister'])->name('admin.register.store');

        // Google Auth
        Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('admin.auth.google');
        Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('admin.auth.google.callback');
        Route::get('/auth/google/under-development', function () {
            return view('admin.under-development');
        })->name('admin.auth.google.dev');
    });

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('auth:admin')
        ->name('admin.logout');

    // Protected Admin Routes - Requires authentication
    Route::middleware(['auth:admin'])->group(function () {
        // Dashboard Routes
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Category Routes
        Route::resource('categories', CategoryController::class, ['as' => 'admin']);

        // Product Routes
        Route::resource('products', ProductController::class, ['as' => 'admin']);

        // Profile Routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    });
});
