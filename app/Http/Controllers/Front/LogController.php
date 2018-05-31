<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/5/31
 * Time: 15:58
 */

namespace App\Http\Controllers\Front;


use App\Http\Controllers\FrontBaseController;

class LogController extends FrontBaseController
{
    public function login(){
        $url = 'http://www.twt.edu.cn/party/';
        return redirect($this->userService->getLoginUrl($url));
    }

    public function logout(){
        return redirect($this->userService->logout());
    }
}