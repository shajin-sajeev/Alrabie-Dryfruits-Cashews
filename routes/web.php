<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('/debug-config', function () {
    return [
        'default_db' => config('database.default'),
        'db_connection_env' => env('DB_CONNECTION'),
        'vercel_env' => env('VERCEL'),
        'database_url' => env('DATABASE_URL') ? 'Set' : 'Not Set',
        'postgres_url' => env('POSTGRES_URL') ? 'Set' : 'Not Set',
    ];
});

Route::get('/test-route', function () {
    return 'Routing is working!';
});

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/category/{slug}', 'category')->name('category');
    Route::get('/product/{slug}', 'product')->name('product');
    Route::get('/search', 'search')->name('search');
});

// Temporary Database Management Routes - DELETE THESE AFTER SUCCESSFUL SETUP
use Illuminate\Support\Facades\Artisan;

Route::get('/db-migrate', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return "Migrations completed successfully!<br><pre>" . Artisan::output() . "</pre>";
    } catch (\Exception $e) {
        return "Error running migrations: " . $e->getMessage();
    }
});

Route::get('/db-seed', function () {
    try {
        Artisan::call('db:seed', ['--force' => true]);
        return "Seeding completed successfully!<br><pre>" . Artisan::output() . "</pre>";
    } catch (\Exception $e) {
        return "Error running seeders: " . $e->getMessage();
    }
});

Route::get('/db-fresh-seed', function () {
    try {
        Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        return "Database refreshed and seeded successfully!<br><pre>" . Artisan::output() . "</pre>";
    } catch (\Exception $e) {
        return "Error refreshing database: " . $e->getMessage();
    }
});

Route::get('/clear-cache', function () {
    try {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        return "All caches cleared successfully!";
    } catch (\Exception $e) {
        return "Error clearing cache: " . $e->getMessage();
    }
});
