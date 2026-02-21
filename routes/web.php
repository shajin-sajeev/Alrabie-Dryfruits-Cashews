<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Artisan;

Route::get('/debug-config', function () {
    return [
        'default_db'     => config('database.default'),
        'db_connection_env' => env('DB_CONNECTION'),
        'vercel_env'     => env('VERCEL'),
        'database_url'   => env('DATABASE_URL') ? 'Set' : 'Not Set',
        'filesystem_disk' => config('filesystems.default'),
        'storage_root'   => config('filesystems.disks.public.root'),
    ];
});



Route::get('/storage/{path}', function (string $path) {
    if (!env('VERCEL')) {
        abort(404);
    }

    $fullPath = '/tmp/storage/public/' . $path;

    if (!file_exists($fullPath)) {
        abort(404, 'File not found.');
    }

    $mimeType = mime_content_type($fullPath) ?: 'application/octet-stream';

    return response()->file($fullPath, [
        'Content-Type'  => $mimeType,
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->where('path', '.*')->name('storage.serve');


Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/category/{slug}', 'category')->name('category');
    Route::get('/product/{slug}', 'product')->name('product');
    Route::get('/search', 'search')->name('search');
});


Route::get('/db-migrate', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return "Migrations completed successfully!<br><pre>" . Artisan::output() . "</pre>";
    } catch (\Throwable $e) {
        return "Error running migrations: " . $e->getMessage() . "<br>Trace:<br><pre>" . $e->getTraceAsString() . "</pre>";
    }
});

