<?php

// Fix for Vercel's read-only filesystem
if (isset($_SERVER['VERCEL_URL'])) {
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
            mkdir($path, 0755, true);
        }
    }
}

// Forward the request to the Laravel index.php
require __DIR__ . '/../public/index.php';
