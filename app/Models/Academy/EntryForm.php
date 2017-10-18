<?php

namespace App\Models\Academy;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EntryForm
 * 院级分党校考试
 * @package App\Models\Academy
 */

class EntryForm extends Model
{
    //
    protected $table = 'twt_academy_entryform';
    protected $primaryKey = 'entry_id';

    const CREATED_AT = 'entry_time';
    protected $fillable = ['sno', 'test_id', 'entry_time', 'entry_practicegrade', 'entry_articlegrade',
        'entry_testgrade', 'entry_status', 'entry_ispassed', 'is_systemadd', 'entry_islastadded',
        'cert_isgrant', 'isexit'];

    public function testList(){
        return $this->belongsTo('App\Models\Academy\TestList', 'test_id', 'test_id');
    }

    public function studentInfo(){
        return $this->belongsTo('App\Models\StudentInfo', 'sno', 'sno');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\UserInfo','sno','usernumb');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'sno', 'usernumb');
    }

    /**
     * 获取最近一期的学生报名信息
     * @param $id
     * @return array
     */
    public static function getLatest($id){
        $res_all = self::where('isexit', 0)
            ->leftJoin('twt_academy_testlist', 'twt_academy_entryform.test_id', '=', 'twt_academy_testlist.test_id')
            ->where('twt_academy_testlist.test_parent', $id)
            ->where('test_status', '<', 5)
            ->where('test_isdeleted', 0)
            ->orderBy('sno', 'asc')
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::AcademyEntryForm($entryForm);
        }, $res_all);
    }

    /**
     * 补考报名时判断是否已经报名
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
     * 院级补报名
     * @param $sno
     * @param $testId
     * @return bool"
     */
    public static function makeup($sno, $testId){
        $entry = self::where('sno', $sno)
            ->where('test_id', $testId)
            ->update(['entry_islastadded' => 1, 'entry_time' => date('Y-m-d H:i:s')])
        ;
        if ($entry)
            return true;
        else
            return false;
    }

    /**
     * 成绩录入界面
     * @param $testId
     * @return array
     */
    public static function gradeInput($testId){
        $entries = self::leftJoin('twt_academy_testlist', 'twt_academy_entryform.test_id', '=', 'twt_academy_testlist.test_id')
            ->where('test_status', 3)
            ->where('test_isdeleted', 0)
//            ->where('test_of_academy', $acdemyId)
            ->where('twt_academy_entryform.test_id', $testId)
            ->where('isexit', 0)
            ->orderBy('sno', 'desc')
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::AcademyEntryForm($entryForm);
        }, $entries);
    }

    /**
     * 更新成绩
     * @param $i
     * @param $id
     * @param $practiceGrade
     * @param $articleGrade
     * @param $testGrade
     * @return array|bool
     */
    public static function gradeInputUpdate($i, $id, $practiceGrade, $articleGrade, $testGrade){
        $isPass[$i] = 0;
        if($practiceGrade[$i] >= 60 && $articleGrade[$i] >= 60 && $testGrade[$i] >= 60){
            $isPass[$i] = 1;
        }
        else if ($practiceGrade[$i] >= 80 && $articleGrade[$i] >= 80 && $testGrade[$i] >= 80){
            $isPass[$i] = 2;
        }
        $entry = self::findOrFail($id[$i]);
        $entry->entry_practicegrade = $practiceGrade[$i];
        $entry->entry_articlegrade = $articleGrade[$i];
        $entry->entry_testgrade = $testGrade[$i];
        $entry->entry_ispassed = $isPass[$i];
        $res = $entry->save();

        return $res ? Resources::AcademyEntryForm($entry) : false;
    }

    /**
     * 获取对应考试期数学生的成绩
     * @param $testId
     * @return array
     */
    public static function getGrade($testId){
        $res_all = self::where('test_id', $testId)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::AcademyEntryForm($entryForm);
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
     * @return array
     */
    public static function getCert($testId){
        $res = self::where('test_id', $testId)
            ->where('cert_isgrant', 0)
            ->whereIn('entry_ispassed', [1, 2])
            ->where('entry_status', 1)
            ->where('isexit', 0)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::AcademyEntryForm($entryForm);
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

    public static function updateCert($sno, $i){
        $res = self::where('sno', $sno[$i])
            ->update(['cert_isgrant' => 1]);
        return $res;
    }

    public static function getGradeBySnoAndTestId($sno, $testId){
        $res = self::where('sno', $sno)
            ->where('test_id', $testId)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::AcademyEntryForm($entryForm);
        }, $res);
    }
}
