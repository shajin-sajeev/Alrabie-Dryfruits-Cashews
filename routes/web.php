<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/category/{slug}', 'category')->name('category');
    Route::get('/product/{slug}', 'product')->name('product');
    Route::get('/search', 'search')->name('search');
});
