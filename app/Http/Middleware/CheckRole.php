<?php

namespace App\Http\Middleware;

use App\Http\Service\AlertService;
use App\Http\Service\UserService;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     * 判断用户角色，有教师、学生、支部书记，$role为或的关系，只有满足其中一个角色即可
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param array $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        $userService = new UserService();
        $alertService = new AlertService();
        // 需要在Authentication中间件之后处理请求，保证已经登陆
        //dd($role);

        // 允许老师访问，且当前用户是老师
        if(in_array('teacher', $role) && $userService->isTeacher()){
            return $next($request);
        }
        // 允许学生访问，且当前用户是学生
        if(in_array('student', $role) && $userService->isStudent()){
            return $next($request);
        }
        // 允许党支部干部访问，且当前用户是干部
        if(in_array('cadre', $role) && $userService->isCadre()){
            return $next($request);
        }

        $msgInfo = [
            'teacher' => '【老师】',
            'student' => '【学生】',
            'cadre'   => '【党支部书记】'
        ];
        $temp = [];
        foreach($role as $v){
            $temp[] = $msgInfo[$v];
        }
        $msg = '对不起，您不具有访问改页面的权限，该页面只有' . join("，", $temp) . "才能访问";
        return $alertService->alertAndBack('提示', $msg);
    }
}
