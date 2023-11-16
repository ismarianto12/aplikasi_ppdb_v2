<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use JWTAuth;

class PpdbAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $user = \JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['message' => 'Unathourize access' . $e->getMessage()], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['message' => 'Unathourize access' . $e->getMessage()], 401);
            } else {
                return response()->json(['message' => 'Unathourize access ' . $e->getMessage()], 401);
            }
        }
        return $next($request);
    }
}
