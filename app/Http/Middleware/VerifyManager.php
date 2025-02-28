<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyManager
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
        $user = Auth::guard('api')->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: User not logged in.',
                'code'    => 401
            ], 401);
        }

        $roleName = $user->getRoleNames()->first();

        if (empty($roleName) || !in_array($roleName, config('permission.roles'))) {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden: You do not have permission.',
                'code'    => 403
            ], 403);
        }

        return $next($request);
    }
}
