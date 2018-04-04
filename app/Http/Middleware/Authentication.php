<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\LoginController;
use App\Http\Service\UserService;
use App\Models\UserInfo;
use Closure;
use Illuminate\Support\Facades\App;
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
            if(App::environment() === 'local'){
                $user = UserInfo::where('user_number', '3014218099')->first();
                Auth::login($user);
                return $next($request);
            }

            if(! $request->has('token')){

                return redirect($userService->getLoginUrl($request->fullUrl()));
            }
            $token = $request->input('token');
            if(! $userService->login($token)){
                return redirect($userService->getLoginUrl($request->fullUrl()));
            }
            // login successful
        }
        return $next($request);
    }
}
