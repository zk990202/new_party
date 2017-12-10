<?php

namespace App\Models\Applicant;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EntryForm
 * 入党申请人报名情况、成绩统计
 * @package App\Models\Applicant
 */
class EntryForm extends Model
{
    //
    protected $table = "twt_applicant_entryform";
    protected $primaryKey = 'entry_id';

    const CREATED_AT = 'entry_time';

    protected $fillable = ['test_id', 'sno', 'entry_time', 'entry_practicegrade', 'entry_articlegrade', 'entry_islastadded',
        'is_systemadd', 'entry_ispassed', 'entry_status', 'cert_isgrant', 'isexit', 'campus'];

    public function testList(){
        return $this->belongsTo("App\Models\Applicant\TestList", 'test_id', 'test_id');
    }

    public function studentInfo(){
        return $this->belongsTo('App\Models\StudentInfo', 'sno','sno');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\UserInfo','sno','usernumb');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'sno', 'usernumb');
    }

    /**
     * 成绩列表
     * @param $testId
     * @param $college
     * @return array
     */
    public static function getGrade($testId, $college){
        $res_all = self::where('test_id', $testId)
            ->leftJoin('twt_student_info', 'twt_applicant_entryform.sno', '=', 'twt_student_info.sno')
            ->where('academy_id', $college)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res_all);
    }

    /**
     * 某一考试中考生的最大id
     * @param $testId
     * @return mixed
     */
    public static function getMaxEntryId($testId){
        $max = self::where('test_id', $testId)
            ->max('entry_id');
        return $max;
    }

    /**
     * 某一考试中考生的最大id
     * @param $testId
     * @return mixed
     */
    public static function getMinEntryId($testId){
        $min = self::where('test_id', $testId)
            ->min('entry_id');
        return $min;
    }

    /**
     * 获取考试合格但未发放证书的学生列表
     * @param $testId
     * @param $college
     * @return array
     */
    public static function getCert($testId, $college){
        $res = self::where('test_id', $testId)
            ->where('cert_isgrant', 0)
            ->whereIn('entry_ispassed', [1, 2])
            ->where('entry_status', 1)
            ->where('isexit', 0)
            ->leftJoin('twt_student_info', 'twt_applicant_entryform.sno', '=', 'twt_student_info.sno')
            ->where('academy_id', $college)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res);
    }

    /**
     * 根据学号获取entry_id
     * @param $sno
     * @return mixed
     */
    public static function getEntryId($sno){
        $res = self::where('sno', $sno)
            ->select('entry_id')
            ->get()->toArray();
        return $res[0];
    }

    public static function getGradeBySnoAndTestId($sno, $testId){
        $res = self::where('sno', $sno)
            ->where('test_id', $testId)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res);
    }

    public static function updateCert($sno, $i){
        $res = self::where('sno', $sno[$i])
            ->update(['cert_isgrant' => 1]);
        return $res;
    }

    //作弊+违纪模块里的
    public static function getInCheat($testId){
        $res = self::where('test_id', $testId)
            ->whereIn('entry_status', [2, 3])
            ->orderBy('entry_status', 'ASC')
            ->get()->all();
        return array_map(function($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res);
    }

    /**
     * 获取所有报名信息
     * @return array
     */
    public static function getAllSign(){
        $res_all = self::where('isexit', 0)
            ->leftJoin('twt_applicant_testlist', 'twt_applicant_entryform.test_id', '=', 'twt_applicant_testlist.test_id')
            ->whereBetween('test_status', [2, 4])
            ->where('test_isdeleted', 0)
            ->orderBy('twt_applicant_entryform.test_id', 'DESC')
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res_all);
    }

    /**
     * 获取退考人员名单
     * @return array
     */
    public static function getSignExit(){
        $res = self::where('isexit', 1)
            ->leftJoin('twt_applicant_testlist', 'twt_applicant_entryform.test_id', '=', 'twt_applicant_testlist.test_id')
            ->whereBetween('test_status', [2, 4])
            ->where('test_isdeleted', 0)
            ->orderBy('twt_applicant_entryform.test_id', 'DESC')
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res);
    }

    /**
     * 补考报名时判断是否已经通过考试
     * @param $sno
     * @return bool
     */
    public static function makeupIsPass($sno){
        $isPass = self::where('sno', $sno)
            ->where('entry_ispassed', '>', 0)
            ->where('isexit', 0)
            ->get()->all();
        if($isPass)
            return true;
        else
            return false;
    }

    /**
     * 补考报名时判断是否已经参加本次考试
     * @param $sno
     * @param $testId
     * @return bool
     */
    public static function makeupIsEntry($sno, $testId){
        $isEntry = self::where('sno', $sno)
            ->where('test_id', $testId)
            ->get()->all();
        if($isEntry)
            return true;
        else
            return false;
    }

    /**
     * 补考报名更新数据库信息
     * @param $id
     * @param $sno
     * @param $testId
     * @return bool
     */
    public static function makeup($id ,$sno, $testId){
//        $entry = self::findOrFail($id);
//        $entry->sno = $sno;
//        $entry->test_id = $testId;
//        $entry->entry_islastadded = 1;
//        $entry->entry_time = date('Y-m-d H:i:s');
        $entry = self::where('sno', $sno)
            ->where('test_id', $testId)
            ->update([
                'entry_islastadded' => 1,
                'entry_time' => date('Y-m-d H:i:s')
            ]);
        if ($entry)
            return true;
        else
            return false;
    }

    /**
     * 成绩录入界面获取学生信息
     * @param $testId
     * @return array
     */
    public static function gradeInput($testId){
        $entries = self::where('test_id', $testId)
            ->orderBy('sno', 'ASC')
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $entries);
    }

    /**
     * 成绩录入更新数据
     * @param $i
     * @param $id
     * @param $practiceGrade
     * @param $articleGrade
     * @param $status
     * @return array|bool
     */
    public static function gradeInputUpdate($i, $id, $practiceGrade, $articleGrade, $status){
        $isPass[$i] = 0;
        if($practiceGrade[$i] >= 60 && $articleGrade[$i] >= 60){
            $isPass[$i] = 1;
        }
        else if ($practiceGrade[$i] >= 80 && $articleGrade[$i] >= 80){
            $isPass[$i] = 2;
        }
        $entry = self::findOrFail($id[$i]);
        $entry->entry_practicegrade = $practiceGrade[$i];
        $entry->entry_articlegrade = $articleGrade[$i];
        $entry->entry_status = $status[$i];
        $entry->entry_ispassed = $isPass[$i];
        $res = $entry->save();

        return $res ? Resources::EntryForm($entry) : false;
    }

    // ---下面就是前台了！！！

    /**
     * 是否通过申请人结业考试
     * @param $sno
     * @return bool
     */
    public static function isPass($sno){
        $res = self::where('sno', $sno)
            ->where('entry_ispassed', 1)
            ->get()->toArray();
        return $res ? true : false;
    }

    /**
     * 是否已经报名
     * @param $sno
     * @param $test_id
     * @return array
     */
    public static function isEntry($sno, $test_id){
        $res = self::where('sno', $sno)
            ->where('test_id', $test_id)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res);
    }

    /**
     * 报名结业考试
     * @param $sno
     * @param $test_id
     * @param $campus
     * @return bool
     */
    public static function signAdd($sno, $test_id, $campus){
        $res = self::create([
            'sno' => $sno,
            'test_id' => $test_id,
            'campus' => $campus
        ]);
        return $res ? true : false;
    }

    /**
     * 报名结果
     * @param $sno
     * @return array
     */
    public static function getSignResult($sno){
        $res = self::leftJoin('twt_applicant_testlist', 'twt_applicant_entryform.test_id', '=', 'twt_applicant_testlist.test_id')
            ->where('test_status', '<', 5)
            ->where('sno', $sno)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res);
    }

    /**
     * 退出报名
     * @param $entry_id
     * @return bool
     */
    public static function signExit($entry_id){
        $res = self::where('entry_id', $entry_id)
            ->update(['isexit' => 1]);
        return $res ? true : false;
    }

    /**
     * 成绩查询
     * @param $sno
     * @return array
     */
    public static function gradeCheck($sno){
        $res = self::leftJoin('twt_applicant_testlist', 'twt_applicant_entryform.test_id', '=', 'twt_applicant_testlist.test_id')
            ->where('sno', $sno)
            ->where('twt_applicant_testlist.test_status', '>=', 4)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res);
    }

    /**
     * 证书查询
     * @param $sno
     * @return array
     */
    public static function certificateCheck($sno){
        $res = self::leftJoin('twt_applicant_testlist', 'twt_applicant_entryform.test_id', '=', 'twt_applicant_testlist.test_id')
            ->where('sno', $sno)
            ->where('entry_ispassed', '>', 0)
            ->where('cert_isgrant', 1)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res);
    }

    /**
     * 账号状态
     * @param $sno
     * @return array
     */
    public static function accountStatus($sno){
        $res = self::where('sno', $sno)
            ->where('isexit', 0)
            ->where('entry_status', 1)
            ->whereIn('entry_ispassed', [1, 2])
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::EntryForm($entryForm);
        }, $res);
    }
}
