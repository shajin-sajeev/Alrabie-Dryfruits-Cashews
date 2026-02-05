<?php

// Fix for Vercel's read-only filesystem
$storagePath = '/tmp/storage';
$cachePath = '/tmp/cache';

foreach (
    [
        $storagePath . '/framework/views',
        $storagePath . '/framework/cache',
        $storagePath . '/framework/sessions',
        $storagePath . '/logs',
        $cachePath,
    ] as $path
) {
    if (!is_dir($path)) {
        if (!mkdir($path, 0777, true) && !is_dir($path)) {
            error_log("Failed to create directory: $path");
        }
    }
}

// Forward the request to the Laravel index.php
require __DIR__ . '/../public/index.php';
