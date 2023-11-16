<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UsersAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        Auth::shouldUse('users'); // Ganti guard ke "users" untuk otentikasi "users"

        return $next($request);
    }
}
