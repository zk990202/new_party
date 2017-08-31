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
        return $this->belongsTo('App\Models\Userinfo','sno','usernumb');
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
//            ->where('cert_isgrant', 0)
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
        return $res;
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
}
