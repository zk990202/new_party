<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    //
    protected $table = "twt_student_info";
    protected $primaryKey = 'info_id';
    protected $fillable = ['is_passed', 'pass20_time', 'is_clear20', 'locked_test_id', 'applicant_islocked', 'applicant_failedtimes',
        'captain_ofgroup', 'apply_grouptime', 'active_roletime', 'group_exectime', 'develop_targettime', 'all_traintime', 'data_completetime',
        'report_time', 'dev_show_starttime', 'vote_passtime', 'talk_passtime', 'prob_passedtime', 'activity_passetime', 'real_show_starttime',
        'turn_real_meetingtime', 'approve_passedtime', 'partymember_time', 'thought_reportcount', 'personal_reportcount', 'main_status',
        'is_init'];

    public function college(){
        return $this->belongsTo('App\Models\College', 'academy_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'sno', 'usernumb');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\UserInfo', 'sno', 'usernumb');
    }

    public function testList(){
        return $this->belongsTo('App\Models\Applicant\TestList', 'locked_test_id', 'test_id');
    }

    /**
     * 获取所有被锁人员
     * @return mixed
     */
    public static function getLocked(){
        $res_all = self::where('applicant_islocked', 1)
            ->leftJoin('twt_applicant_testlist', 'twt_student_info.locked_test_id', '=', 'twt_applicant_testlist.test_id')
            ->orderBy('test_id', 'DESC')
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res_all);
    }

    /**
     * 获取所有20课被清
     * @return array
     */
    public static function getClear(){
        $res_all = self::where('is_clear20', 1)
            ->get()->all();
        return array_map(function($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res_all);
    }

    /**
     * 补考报名时判断是否通过20课
     * @param $sno
     * @return bool
     */
    public static function makeupIsPass20($sno){
        $isPass20 = self::where('sno', $sno)
            ->where('is_pass20', 1)
            ->get()->all();
        if ($isPass20)
            return true;
        else
            return false;
    }
//    /**
//     * 恢复20课的清除
//     * @param $sno
//     * @return mixed
//     */
//    public static function unclear($sno){
//        $res = self::where('sno', $sno)
//            ->update(['is_clear20' => 0])
//            ->update(['is_pass20' => 1]);
//        return $res;
//    }

}
