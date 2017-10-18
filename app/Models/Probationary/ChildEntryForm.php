<?php

namespace App\Models\Probationary;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

/**
 * 该表相当于twt_probationary_entryform的子表，存储父表中对应学生的课程信息
 * 每个学生在该表中有四条数据----必修课1~3，选修课
 * Class ChildEntryForm
 * @package App\Models\Probationary
 */

class ChildEntryForm extends Model
{
    //
    protected $table = "twt_probationary_childentryform";
    protected $primaryKey = "entry_id";

    protected $fillable = ['child_entryid', 'child_sno', 'child_courseid', 'child_entrytime', 'child_status',
        'child_status', 'child_grade', 'isexit'];

    const CREATED_AT = 'entry_time';
    const UPDATED_AT = 'updated_at';

    public function studentInfo(){
        return $this->belongsTo('App\Models\StudentInfo', 'sno', 'sno');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\UserInfo','sno','usernumb');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'sno', 'usernumb');
    }

    public function courseList(){
        return $this->belongsTo('App\Models\Probationary\CourseList', 'child_courseid', 'course_id');
    }

    /**
     * 如果没有人选择该课程,则是允许隐藏和删除的,否则不允许删除
     * @param $id
     * @return bool
     */
    public static function isSomeoneChoose($id){
        $res = self::where('child_courseid', $id)
            ->get()->toArray();
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    public static function isExit($id){
        $res = self::where('child_courseid', $id)
            ->where('isexit', 0)
            ->get()->all();
        return array_map(function($childEntryForm){
            return Resources::ProbationaryChildEntryForm($childEntryForm);
        }, $res);
    }

    /**
     * 根据课程和学院获取
     * @param $data
     * @return array
     */
    public static function getByCourseAndCollege($data){
        $entry = self::where('child_courseid', $data['courseId'])
            ->leftJoin('twt_student_info', 'twt_probationary_childentryform.child_sno', '=', 'twt_student_info.sno')
            ->where('academy_id', $data['academyId'])
            ->get()->all();
        return array_map(function ($childEntryForm){
            return Resources::ProbationaryChildEntryForm($childEntryForm);
        }, $entry);
    }

    public static function getBySnoAndTrainId($sno, $trainId, $courseType){
        $res = self::where('child_sno', $sno)
            ->where('isexit', 0)
            ->leftJoin('twt_probationary_courselist', 'twt_probationary_childentryform.child_courseid', '=', 'twt_probationary_courselist.course_id')
            ->where('course_type', $courseType)
            ->where('train_id', $trainId)
            ->get()->all();
        return array_map(function ($childEntryForm){
            return Resources::ProbationaryChildEntryForm($childEntryForm);
        }, $res);
    }

    public static function isChoose($courseId, $entryId){
        $res = self::where('child_entryid', $entryId)
            ->where('child_courseid', $courseId)
            ->where('isexit', 0)
            ->get()->toArray();
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 后台补选课
     * @param $sno
     * @param $entryId
     * @param $courseId
     * @return array|bool
     */
    public static function add($sno, $entryId, $courseId){
        $res = self::create([
            'child_sno' => $sno,
            'child_entryid' => $entryId,
            'child_courseid' => $courseId,
            'child_entrytime' => date('Y-m-d H:i:s')
        ]);
        return $res ? Resources::ProbationaryChildEntryForm($res) : false;
    }

    public static function getByCourseId($courseId){
        $res = self::where('child_courseid', $courseId)
            ->where('isexit', 0)
            ->get()->all();
        return array_map(function ($childEntryForm){
            return Resources::ProbationaryChildEntryForm($childEntryForm);
        }, $res);
    }

    /**
     * 成绩录入后更新字段
     * @param $data
     * @param $i
     * @return array|bool
     */
    public static function updateSome($data, $i){
        $childEntry = self::findOrFail($data['id'][$i]);
        $childEntry->child_grade = $data['grade'][$i];
        $childEntry->child_status = $data['status'][$i];
        $res = $childEntry->save();
        return $res ? Resources::ProbationaryChildEntryForm($childEntry) : false;
    }

    public static function updateSome1($data, $i){
        $childEntry = self::findOrFail($data['childEntryId'][$i]);
        $childEntry->child_grade = $data['grade'][$i];
        $childEntry->child_status = $data['status'][$i];
        $res = $childEntry->save();
        return $res ? Resources::ProbationaryChildEntryForm($childEntry) : false;
    }


    /**
     * 根据entryId获得
     * @param $entryId
     * @return array
     */
    public static function getByEntryId($entryId){
        $childEntry = self::where('child_entryid', $entryId)
            ->get()->all();
        return array_map(function ($childEntryForm){
            return Resources::ProbationaryChildEntryForm($childEntryForm);
        }, $childEntry);
    }

    /**
     * 获取某个学生的课程详细信息
     * @param $entryId
     * @return array
     */
    public static function getCourseInformation($entryId){
        $childEntries = self::where('child_entryid', $entryId)
            ->orderBy('child_courseid', 'asc')
            ->get()->all();
        return array_map(function ($childEntryForm){
            return Resources::ProbationaryChildEntryForm($childEntryForm);
        }, $childEntries);
    }
}
