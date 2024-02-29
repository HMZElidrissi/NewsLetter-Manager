<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->bearerToken();
            if (!$token) {
                return response()->json(['error' => 'Token not provided.'], 401);
            }

            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $request->auth = $decoded;
        } catch (Exception $e) {
            return response()->json(['error' => 'Token is invalid.'], 400);
        }

        return $next($request);
    }
}
