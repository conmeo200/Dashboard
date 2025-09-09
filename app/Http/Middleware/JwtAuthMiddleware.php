<?php

namespace App\Http\Middleware;

use App\Helpers\JwtHelper;
use Closure;
use Exception;
use Illuminate\Http\Request;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer '))
            return response()->json(['message' => 'Unauthorized'], 401);        

        $token = substr($authHeader, 7);

        try {
            $decoded = JwtHelper::decodeToken($token);
            
            $request->merge(['auth_user' => (array) $decoded]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Invalid Token'], 401);
        }


        return $next($request);
    }
}
