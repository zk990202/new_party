<?php
/**
 * Created by PhpStorm.
 * User: Liebes
 * Date: 2018/3/30
 * Time: 10:21
 */

namespace App\Http\Service;

use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
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

    public function login($token){
        $userInfo = $this->getUserInfoFromSSO($token);
        // token 无效
        if(!$userInfo)
            return false;
        //$userInfo = $userService->getUserInfoFromLocal()
        $user = $this->updateUserInfo($userInfo);
        $user->updateSSOToken($token);
        Auth::login($user);
        return true;
    }

    public function logout(){
        if(Auth::check()){
            $user = Auth::user();
            $token = $user->getSSOToken();
            $this->sso->logout($token);
            $user->setSSOToken(null);
            Auth::logout();
        }
        return true;
    }

    public function getUserInfoFromSSO($token){
        $user = $this->sso->fetchUserInfo($token);
        if($user->status == 1){
            return $user->result;
        }
        else
            return false;
    }

    /**
     * 从本地库中查询UserInfo，如果距离上次登陆时间较长，则从基础库查询并更新
     * @param $userNumber
     */
    public function getUserInfoFromLocal($userNumber){

    }

    /**
     * @param $userInfo
     * @return UserInfo
     */

    public function updateUserInfo($userInfo){

        $userDetail = [
            'user_number'     => $userInfo->user_number,
            //'party_branch_id' => $userInfo->user_info->party_branch_id,
            'college_id'      => $userInfo->college_code,
            'province'        => $userInfo->user_info->province,
            'last_school'     => $userInfo->user_info->last_school,
            'major'           => $userInfo->user_info->major,
            'class_id'        => $userInfo->user_info->class_id,
            'stu_in_time'     => $userInfo->user_info->stu_in_time,
            'grade'           => $userInfo->user_info->grade,
            'political_face'  => $userInfo->user_info->political_face,
            'major_name'      => $userInfo->major,
            'username'        => $userInfo->user_info->username,
            'gender'          => $userInfo->user_info->gender,
            'last_login'      => date('Y-m-d H:i:s', time()),
        ];


        $user = UserInfo::updateOrCreate(
            ['user_number' => $userInfo->user_number],
            $userDetail
        );

        return $user;
    }

    public function getCurrentUser(){
        if(!auth()->check())
            return null;
        $user = auth()->user();
        $data = [
            'userNumber'  => $user->user_number,
            'username'    => $user->username,
            'major'       => $user->major_name,
            'collegeId'   => $user->college_id,
            'college'     => $user->college->collegename,
            'partyBranch' => $user->info->partyBranch->partybranch_name
        ];
        return $data;
    }

    protected function existLocal(){

    }

}