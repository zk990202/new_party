<?php
/**
 * Created by PhpStorm.
 * User: Liebes
 * Date: 2018/3/30
 * Time: 10:21
 */

namespace App\Http\Service;

use TwT\SSO\Api;

class UserService{
    protected $sso;
    public function __construct()
    {
        $this->sso = new Api($appid = config('sso.app_id'), $appkey = config('sso.app_key'));
    }

    public function getLoginUrl($redirect){
        return $this->sso->getLoginUrl($redirect);
    }

    public function login(){

    }

    public function logout(){

    }

    public function getUserInfo($token){
        $user = $this->sso->fetchUserInfo($token);
        if($user->status == 1){

        }
    }

    protected function updateUserInfo(){

    }

    protected function existLocal(){

    }
}