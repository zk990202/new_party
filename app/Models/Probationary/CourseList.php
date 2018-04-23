<?php

namespace App\Models\Probationary;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CourseList extends Model
{
    //
    protected $table = "twt_probationary_courselist";
    protected $primaryKey = "course_id";

    protected $fillable = ['train_id', 'course_name', 'course_type', 'movie_id', 'course_introduction', 'course_requirement',
        'course_begintime', 'course_speaker', 'course_place', 'course_limitnum', 'course_caninsert',
        'course_isinserted', 'course_isdeleted', 'course_number'];

    const CREATED_AT = 'course_begintime';
    const UPDATED_AT = 'updated_at';

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

    public function trainList(){
        return $this->belongsTo('App\Models\Probationary\TrainList', 'train_id', 'train_id');
    }

    public function commonFiles(){
        return $this->belongsTo('App\Models\CommonFiles', 'movie_id', 'file_id');
    }

    /**
     * 判断是否还有考试处于成绩录入状态下
     * @return bool
     */
    public static function isCourseInsert(){
        $res = self::where(function ($query){
                $query->where('course_caninsert', 1)
                    ->orWhere('course_isinserted' , 0);
            })
            ->get()->toArray();
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取课程
     * @param $data
     * @return array
     */
    public static function getSomeCourse($data){
        if ($data['courseType'] != null){
            $courses = self::where('train_id', $data['trainId'])
                ->where('course_type', $data['courseType'])
                ->get()->all();
            return array_map(function ($courseList){
                return Resources::ProbationaryCourseList($courseList);
            }, $courses);
        }else{
            $courses = self::where('train_id', $data['trainId'])
                ->get()->all();
            return array_map(function ($courseList){
                return Resources::ProbationaryCourseList($courseList);
            }, $courses);
        }
    }

    public static function getByTrainId($trainId){
        $courses = self::where('train_id', $trainId)
            ->get()->all();
        return array_map(function ($courseList){
            return Resources::ProbationaryCourseList($courseList);
        }, $courses);
    }

    /**
     * 根据id获取某一课程
     * @param $id
     * @return array
     */
    public static function getCourseById($id){
        $course = self::where('course_id', $id)
            ->first();
        return $course ? Resources::ProbationaryCourseList($course) : null;
    }

    /**
     * 根据id更新课程
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateById($id, $data){
        $course = self::findOrFail($id);
        $course->course_name = $data['name'];
        $course->train_id = $data['trainId'];
        $course->course_begintime = $data['time'];
        $course->course_place = $data['place'] ?? null;
        $course->course_speaker = $data['speaker'] ?? null;
        $course->course_limitnum = $data['limitNum'] ?? 0;
        $course->course_introduction = $data['introduction'];
        $course->course_requirement = $data['requirement'];
        $course->movie_id = $data['movieId'] ?? null;
        $res = $course->save();
        return $res ? Resources::ProbationaryCourseList($course) : false;
    }

    /**
     * 添加必修课
     * @param $data
     * @return array|bool
     */
    public static function addCompulsory($data){
        $course = self::create([
            'course_name' => $data['name'],
            'train_id' => $data['trainId'],
            'course_begintime' => $data['time'],
            'course_speaker' => $data['speaker'],
            'course_place' => $data['place'],
            'course_limitnum' => $data['limitNum'],
            'course_introduction' => $data['introduction'],
            'course_requirement' => $data['requirement'],
            'course_type' => 0,
            'course_isinserted' => 1
        ]);
        return $course ? Resources::ProbationaryCourseList($course) : false;
    }

    /**
     * 添加选修课
     * @param $data
     * @return array|bool
     */
    public static function addElective($data){
        $course = self::create([
            'course_name' => $data['name'],
            'train_id' => $data['trainId'],
            'course_begintime' => $data['time'],
            'movie_id' => $data['movieId'],
            'course_introduction' => $data['introduction'],
            'course_requirement' => $data['requirement'],
            'course_type' => 1,
            'course_isinserted' => 1
        ]);
        return $course ? Resources::ProbationaryCourseList($course) : false;
    }

    /**
     * 后台补选课后更新limitNum字段
     * @param $courseId
     * @param $count
     * @return bool
     */
    public static function updateWhenChooseCourse($courseId, $count){
        $res = where('course_id', $courseId)
            ->update(['course_limitnum' => $count]);
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    public static function warpType(& $item){
        //课程类型，0 必修 1，选修
        if(isset($item['type'])){
            if($item['type'] == 0)
                $item['type'] = '必修';
            else
                $item['type'] = '选修';
        }

        if(isset($item['courseType'])){
            if($item['courseType'] == 0)
                $item['courseType'] = '必修';
            else
                $item['courseType'] = '选修';
        }
    }
}
