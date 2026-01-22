<?php

return [
    'default' => env('APP_ENV', 'production'),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'locale' => env('APP_LOCALE', 'en'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),
    'cipher' => env('APP_CIPHER', 'AES-256-CBC'),
    'key' => env('APP_KEY'),
];
