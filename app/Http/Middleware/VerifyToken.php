<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\LoginController;
use Closure;
use Illuminate\Http\Request;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('token')) {
            $token = $request->input('token');
//            session(['data' => $token]);
            LoginController::storage($token);
//            $status = LoginController::storage($token);
//            return response()->json([
//                'status' => $status
//            ]);
        }
        return $next($request);
    }
}
