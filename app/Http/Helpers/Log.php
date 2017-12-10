<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/11/20
 * Time: 17:04
 */

namespace App\Http\Helpers;


use App\Http\Controllers\Api\LoginController;
use App\Models\PartyBranch\PartyBranch;
use App\Models\StudentInfo;

class Log{

    /**
     * @param $token
     * @return array
     */
    public static function userInfo($token){
        $sso = LoginController::construct();
        $userinfo = $sso->getUserInfo($token);
        $data = [];
        if ($userinfo->status) {
            $result = $userinfo->result;
            $usernumb = $result->user_number;
            $data['user_number'] = $usernumb;
            $data['real_name'] = $result->user_info->username;
            $data['college_code'] = $result->college_code;
            $data['college'] =  $result->college;
            $data['major'] = $result->major;
            $data['twt_name'] = $result->twt_name;
            $data['party_branch_id'] = $result->user_info->party_branch_id;

            //这里表示的是老师...但是有的老师确实是支部的干部,,这里还是得确认...
            $isProbationary = PartyBranch::isProbationary($usernumb);
            if ($isProbationary){
                $data['is_probationary'] = 1;
                $data['party_branch_id'] = $isProbationary['id'];
            }else{
                $data['is_probationary'] = 0;
                //这里要注意了:如果这里的人是老师的话,他不是支部委员,也不在info表中,那么这个人将没有
                //支部信息....也就是没有支部id....和那些没有支部的人登陆是一样的,,无法看到支部成员的//的内容.但是如果他有个人发展流程图,和上传资料还是可以看到的.....
                $query = StudentInfo::isExist($usernumb);
                if ($query['partyBranchId']){
                    $data['party_branch_id'] = $query['partyBranchId'];
                }else{
                    $data['party_branch_id'] = 0;
                }
            }

            //当老师和同学进入的时候,看到的是不同的页面.....
            if (strlen($usernumb) == 6){
                $data['is_teacher'] = 1;
            }elseif(strlen($usernumb) == 10){
                $data['is_teacher'] = 0;
            }
            $data['token'] = $token;
        }
        return $data;
}

}