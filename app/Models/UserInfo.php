<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserInfo extends Authenticatable
{
    //
    protected $table = "b_userinfo";

    // 所有元素均可以被批量赋值
    protected $guarded = [];

    public $timestamps = false;

    public function majorInfo(){
        return $this->belongsTo('App\Models\Major', 'major', 'majorid');
    }

    public function college(){
        if($this->college_id < 100)
            return $this->belongsTo('App\Models\College', 'college_id', 'code');
        return $this->belongsTo('App\Models\College', 'college_id', 'code');
    }

    public function info(){
        return $this->belongsTo('App\Models\StudentInfo', 'user_number', 'sno');
    }

    public function setRememberToken($value)
    {
        // do nothing
    }

    public function getRememberToken()
    {
        // do nothing
    }

    /**
     * 添加学生支部信息
     * @param $sno
     * @param $branch_id
     * @return bool
     */
    public static function updatePartyBranch($sno, $branch_id){
        $res = self::where('user_number', $sno)
            ->update(['partybranchid' => $branch_id]);
        return $res ? true : false;
    }

    /**
     * 将学生从所在党支部删除
     * @param $sno
     * @param $branch_id
     * @return bool
     */
    public static function deletePartyBranch($sno, $branch_id){
        $res = self::where('user_number', $sno)
            ->update(['partybranchid' => 0]);
        return $res ? true : false;
    }

    /**
     * 由学院和年级获取学生信息
     * @param $college_id
     * @param $grade
     * @return array
     */
    public static function getByCollegeIdAndGrade($college_id, $grade){
        $res = self::where('college_id', $college_id)
            ->where('grade', $grade)
            ->get()->all();
        return array_map(function ($userInfo){
            return Resources::UserInfo($userInfo);
        }, $res);
    }




    public function updateSSOToken($token){
        $this->sso_token = $token;
        $this->save();
    }

    public function getSSOToken(){
        return $this->sso_token;
    }

    public function setSSOToken($token){
        $this->sso_token = $token;
        $this->save();
    }

    public function userNumber(){
        return $this->user_number;
    }
}
