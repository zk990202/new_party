<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\LoginController;
use App\Http\Service\UserService;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authentication
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
        if (!Auth::check()) {
            $userService = new UserService();
            if($request->has('token')){

            }
            return redirect($userService->getLoginUrl($request->fullUrl()));
        }
        return $next($request);
    }
}
