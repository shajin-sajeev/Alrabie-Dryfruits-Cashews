<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AdminAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // For admin routes, redirect to admin.login or throw exception to show error page
        if ($request->is('admin/*')) {
            return route('admin.login');
        }

        return route('home');
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     */
    protected function authenticate($request, array $guards)
    {
        // For admin routes, check the admin guard
        if ($request->is('admin/*')) {
            $this->guards = ['admin'];
        }

        parent::authenticate($request, $guards);
    }
}
