<?php

namespace App\Http\Middleware;

use Closure;

class OperationLog
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
        $user_id = auth()->user()->userNumber();
        $input = $request->all();
        $log = new \App\Models\OperationLog(); # 提前创建表、model
        $log->user_id = $user_id;
        $log->path = $request->path();
        $log->method = $request->method();
        $log->ip = $request->ip();
        $log->input = json_encode($input, JSON_UNESCAPED_UNICODE);
        $log->save();   # 记录日志
        return $next($request);
    }
}
