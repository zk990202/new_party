<?php

namespace App\Models\Applicant;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CourseList
 * 入党申请人课程
 * @package App\Models\Applicant
 */
class CourseList extends Model
{
    //
    protected $table = "twt_applicant_courselist";
    protected $primaryKey = 'course_id';
    public $timestamps = false;

    //创建时间字段
    const CREATED_AT = 'course_inserttime';
    protected $fillable = ['course_name', 'course_detail', 'course_priority', 'course_ishidden', 'course_isdeleted'];

    /**
     * 模型的「启动」方法
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notDeleted', function(Builder $builder) {
            $builder->where('course_isdeleted', 0);
        });
    }

    /**
     * 获取所有课程
     * @return array
     */
    public static function getAll(){
        $res_arr = self::orderBy('course_priority', 'ASC')
            ->get()->all();

        return array_map(function ($CourseList){
            return Resources::CourseList($CourseList);
        }, $res_arr);
    }

    /**
     * 获取$limit条课程
     * @param int $limit
     * @return array
     */
    public static function getCourseByLimit($limit = 20){
        $res_arr = self::orderBy('course_priority', 'ASC')
            ->limit($limit)
            ->get()->all();

        return array_map(function ($CourseList){
            return Resources::CourseList($CourseList);
        }, $res_arr);
    }

    /**
     * 更新
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateById($id, $data){
        $course = self::findOrFail($id);
        $course->course_name = $data['courseName'];
        $course->course_detail = $data['detail'];
        $res = $course->save();
        return $res ? Resources::CourseList($course) : false;
    }

    public static function getCourse(){
        $courses = self::get()->all();
        return array_map(function ($course){
            return Resources::CourseList($course);
        }, $courses);
    }

    public static function getCourseById($id){
        $courses = self::where('course_id', $id)
            ->get()->all();
        return array_map(function ($course){
            return Resources::CourseList($course);
        }, $courses);
    }
}
