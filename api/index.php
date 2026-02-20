<?php
error_reporting(E_ALL & ~E_DEPRECATED);

// Fix for Vercel's read-only filesystem — /var/task is read-only, only /tmp is writable.
$storagePath = '/tmp/storage';
$cachePath   = '/tmp/cache';

$dirsToCreate = [
    // Laravel framework internals
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
    // Public disk root (mapped via FILESYSTEM_DISK config)
    $storagePath . '/public',
    $storagePath . '/public/images/products',
    $storagePath . '/public/images/categories',
    $storagePath . '/public/images/profile_pictures',
    // Cache directory
    $cachePath,
];

foreach ($dirsToCreate as $path) {
    if (!is_dir($path)) {
        if (!mkdir($path, 0777, true) && !is_dir($path)) {
            error_log("Failed to create directory: $path");
        }
    }
}

// Forward the request to the Laravel index.php
require __DIR__ . '/../public/index.php';
