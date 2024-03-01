<?php

namespace App\Http\Controllers\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->cookie('jwt') ?? $request->bearerToken();

            if (!$token) {
                return $this->handleUnauthenticated($request, 'Token not provided.');
            }

            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $request->auth = $decoded;
        } catch (Exception $e) {
            return $this->handleUnauthenticated($request, 'Token is invalid.');
        }

        return $next($request);
    }

    /**
     * Handle unauthenticated users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function handleUnauthenticated($request, $message)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => $message], 401);
        }

        return redirect()->guest(route('login'))->with('error', $message);
    }
}
