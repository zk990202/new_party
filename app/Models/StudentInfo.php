<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


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

    const CREATED_AT = 'pass_time';
    const UPDATED_AT = 'updated_at';

    public function college(){
        return $this->belongsTo('App\Models\College', 'academy_id', 'code');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'sno', 'usernumb');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\UserInfo', 'sno', 'user_number');
    }

    public function testList(){
        return $this->belongsTo('App\Models\Applicant\TestList', 'locked_test_id', 'test_id');
    }

    public function partyBranch(){
        return $this->belongsTo('App\Models\PartyBranch\PartyBranch', 'partybranch_id', 'partybranch_id');
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
     * 判断是否通过20课
     * @param $sno
     * @return bool
     */
    public static function isPass20($sno){
        $isPass20 = self::where('sno', $sno)
            ->where('is_pass20', 1)
            ->get()->all();
        if ($isPass20)
            return true;
        else
            return false;
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

    /**
     * 获取学生信息
     * @param $sno
     * @return array
     */
    public static function getStudentInfo($sno){
        $studentInfo = self::where('sno', $sno)
            ->first();
        return Resources::StudentInfo($studentInfo);
    }

    /**
     * 查询支部全部人员
     * @param $branch_id
     * @return array
     */
    public static function allMembers($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 查询支部正式党员数
     * @param $branch_id
     * @return array
     */
    public static function real($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->where('main_status', 15)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 查询支部预备党员数
     * @param $branch_id
     * @return array
     */
    public static function ready($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->whereBetween('main_status', [10, 15])
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 查询支部发展对象
     * @param $branch_id
     * @return array
     */
    public static function develop($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->whereBetween('main_status', [3, 9])
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 查询正在发展且公示的人员
     * @param $branch_id
     * @return array
     */
    public static function developSee($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->where('main_status', 7)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 查询支部团推优+积极分子
     * @param $branch_id
     * @return array
     */
    public static function excellentAndAcademy($branch_id){
        $res = self::where('partybranch', $branch_id)
            ->where('main_status', 23)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 查询支部积极分子
     * @param $branch_id
     * @return array
     */
    public static function academy($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->where('main_status', 1)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 查询支部团推优
     * @param $branch_id
     * @return array
     */
    public static function excellent($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->where('main_status', 2)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 查询支部申请人+非申请人
     * @param $branch_id
     * @return array
     */
    public static function apply($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->where('main_status', 0)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 不是支部成员的所有学生
     * @param $academy_id
     * @param $school_year
     * @return array
     */
    public static function noneMemberAll($academy_id, $school_year){
        $res = self::where('partybranch_id', '<', 1)
            ->where('academy_id', $academy_id)
            ->where('main_status', 0)
            ->where('sno', 'like', "__$school_year%______")
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 不是支部成员的所有学生(未选年级)
     * @param $academy_id
     * @return array
     */
    public static function noneMemberAllNotYear($academy_id){
        $res = self::where('partybranch_id', '<', 1)
            ->where('academy_id', $academy_id)
            ->where('main_status', 0)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 不是支部成员的本科生及高职生
     * @param $academy_id
     * @param $school_year
     * @return array
     */
    public static function noneMembersUndergraduate($academy_id, $school_year){
        $res = self::where('partybranch_id', '<', 1)
            ->where('academy_id', $academy_id)
            ->where('main_status', 0)
//            ->where('sno', 'like', "3_$school_year%")
            ->where(function ($query) use($school_year){
                $query->where('sno', 'like', "3_$school_year%")
                    ->orWhere('sno', 'like', "4_$school_year%");
            })
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 不是支部成员的本科生及高职生(未选年级)
     * @param $academy_id
     * @return array
     */
    public static function noneMembersUndergraduateNotYear($academy_id){
        $res = self::where('partybranch_id', '<', 1)
            ->where('academy_id', $academy_id)
            ->where('main_status', 0)
//            ->where('sno', 'like', "3_$school_year%")
            ->where(function ($query){
                $query->where('sno', 'like', "30%")
                    ->orWhere('sno', 'like', "40%");
            })
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 不是支部成员的硕士生
     * @param $academy_id
     * @param $school_year
     * @return array
     */
    public static function noneMembersMaster($academy_id, $school_year){
        $res = self::where('partybranch_id', '<', 1)
            ->where('academy_id', $academy_id)
            ->where('main_status', 0)
            ->where('sno', 'like', "2_$school_year%")
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 不是支部成员的硕士生(未选年级)
     * @param $academy_id
     * @return array
     */
    public static function noneMembersMasterNotYear($academy_id){
        $res = self::where('partybranch_id', '<', 1)
            ->where('academy_id', $academy_id)
            ->where('main_status', 0)
            ->where('sno', 'like', "20%")
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 不是支部成员的博士生
     * @param $academy_id
     * @param $school_year
     * @return array
     */
    public static function noneMembersDoctor($academy_id, $school_year){
        $res = self::where('partybranch_id', '<', 1)
            ->where('academy_id', $academy_id)
            ->where('main_status', 0)
            ->where('sno', 'like', "1_$school_year%")
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 不是支部成员的博士生(未选年级)
     * @param $academy_id
     * @return array
     */
    public static function noneMembersDoctorNotYear($academy_id){
        $res = self::where('partybranch_id', '<', 1)
            ->where('academy_id', $academy_id)
            ->where('main_status', 0)
            ->where('sno', 'like', "10%")
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 添加学生所在支部
     * @param $sno
     * @param $branch_id
     * @return bool
     */
    public static function updatePartyBranch($sno, $branch_id){
        $res = self::where('sno', $sno)
            ->update(['partybranch_id' => $branch_id]);
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 将学生从所在党支部删除
     * @param $sno
     * @param $branch_id
     * @return bool
     */
    public static function deletePartyBranch($sno, $branch_id){
        $res = self::where('sno', $sno)
            ->update(['partybranch_id' => 0]);
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 根据branch_id获取学生信息
     * @param $branch_id
     * @return array
     */
    public static function getByBranchId($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 判断用户是否存在于student_info表中
     * @param $usernumb
     * @return array
     */
    public static function isExist($usernumb){
        $res = self::where('sno', $usernumb)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res)[0];
    }

    /**
     * 由学号和初始状态获取学生信息
     * @param $sno
     * @return array
     */
    public static function getBySnoAndIsInit($sno){
        $res = self::where('sno', $sno)
//            ->where('is_init', 0)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 学生信息管理--设置20课状态为通过
     * @param $sno
     * @return bool
     */
    public static function updateIsPass20ToTrueInStudentInfoInit($sno){
        $res = self::where('sno', $sno)
            ->update(['is_pass20' => 1]);
        return $res ? true :false;
    }

    /**
     * 学生信息管理--更改季度思想汇报提交的个数
     * @param $sno
     * @param $count
     * @return bool
     */
    public static function updateThoughtReportInStudentInfoInit($sno, $count){
        $res = self::where('sno', $sno)
            ->update(['thought_reportcount' => $count]);
        return $res ? true : false;
    }

    /**
     * 学生信息管理--更改季度个人小结提交的个数
     * @param $sno
     * @param $count
     * @return bool
     */
    public static function updatePersonalReportInStudentInfoInit($sno, $count){
        $res = self::where('sno', $sno)
            ->update(['personal_reportcount' => $count]);
        return $res ? true : false;
    }

    /**
     * 学生信息管理--系统添加学生至学习小组
     * @param $sno
     * @return bool
     */
    public static function updateApplicantGroupInStudentInfoInit($sno){
        $res = self::where('sno', $sno)
            ->update(['captain_ofgroup' => 1]);
        return $res ? true : false;
    }

    /**
     * 学生信息管理--系统更改学生main_status
     * @param $sno
     * @param $main_status
     * @return bool
     */
    public static function updateMainStatusInStudentInfoInit($sno, $main_status){
        $res = self::where('sno', $sno)
            ->update([
                'main_status' => $main_status,
                'is_init' => 1
            ]);
        return $res ? true : false;
    }




    // 下面就是前台的了！！！

    /**
     * 更新20课通过状态
     * @param $sno
     * @return mixed
     */
    public static function updatePassTwenty($sno, $status = 1){
        $res = self::where('sno', $sno)
            ->update([
                'is_pass20' => $status,
            ]);
        return $res;
    }

    /**
     * 根据学号获取用户信息
     * @param $sno
     * @return array
     */
    public static function getBySno($sno){
        $res = self::where('sno', $sno)
            ->get()->all();
        return array_map(function ($studentInfo){
            return Resources::StudentInfo($studentInfo);
        }, $res);
    }

    /**
     * 申请人培训是否被锁
     * @param $userNumber
     * @return bool
     */
    public static function applicantIsLocked($userNumber){
        $user = self::where('sno', $userNumber)->first();
        return boolval($user && $user->applicant_islocked);
    }

    /**
     * 季度思想汇报数量
     * @param $sno
     * @return int
     */
    public static function getReportNumber($sno){
        $user = self::where('sno', $sno)->first();
        return $user ? $user->thought_reportcount : 0;
    }

    /**
     * 调整季度思想汇报数量
     * @param $sno
     * @param $num
     * @return mixed
     */
    public static function updateReportTo($sno, $num){
        return self::where('sno', $sno)->update([
            'thought_reportcount' => $num
        ]);
    }

    public static function getMainStatus($sno){
        $user = self::where('sno', $sno)->first();
        return $user ? intval($user->main_status) : 0;
    }

    public static function updateMainStatusTo($sno, $status){
        $user = self::where('sno', $sno)->update([
            'main_status' => $status
        ]);
        return;
    }

    /**
     * 获取个人小结数量
     * @param $sno
     * @return int
     */
    public static function getPersonalSummaryNumber($sno){
        $user = self::where('sno', $sno)->first();
        return $user ? $user->personal_reportcount : 0;
    }

    /**
     * 调整季度思想汇报数量
     * @param $sno
     * @param $num
     * @return mixed
     */
    public static function updatePersonalSummaryTo($sno, $num){
        return self::where('sno', $sno)->update([
            'personal_reportcount' => $num
        ]);
    }

    public static function isClear20($userNumber){
        $user = self::where('sno', $userNumber)->first();

        return boolval($user && $user->is_clear20);
    }

    public static function getCollegeId($userNumber){
        $user = self::where('sno', $userNumber)->first();
        return $user ? $user->academy_id : false;
    }


    public static function getPartyBranchMembersByIdWithPage($partyBranchId, $limit = 15){
        $res = self::where('partybranch_id', $partyBranchId)
            ->paginate($limit);
        foreach($res as $i => &$v){
            $res[$i] = Resources::StudentInfo($v);
        }
        return $res;
    }

    public static function getPartyBranchGroupMembersByIdAndGroupWithPage($partyBranchId, $group, $limit = 15){
        $res = self::where('partybranch_id', $partyBranchId)
            ->where('captain_ofgroup', $group)
            ->paginate($limit);
        foreach($res as $i => &$v){
            $res[$i] = Resources::StudentInfo($v);
        }
        return $res;
    }



}
