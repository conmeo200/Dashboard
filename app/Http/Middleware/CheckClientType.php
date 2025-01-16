<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckClientType
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
        if (!$request->hasHeader('X-Client-Type')) {
            return response()->json(['error' => 'Client type not specified'], 400);
        }

        $clientType = $request->header('X-Client-Type');
        if (!in_array($clientType, ['web', 'app'])) {
            return response()->json(['error' => 'Invalid client type'], 400);
        }

        return $next($request);
    }
}
