<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * Class ScoresTwenty
 * 入党申请人20课通过课数统计
 * @package App\Models
 */
class ScoresTwenty extends Model
{
    //
    protected $table = 'twt_20scores';
    protected $fillable = ['student_id', 'course_id','score', 'complete_time', 'is_systemadd', 'isdeleted'];

    const UPDATED_AT = 'complete_time';
    const CREATED_AT = 'complete_time';

    /**
     * 模型的「启动」方法
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notDeleted', function(Builder $builder) {
            $builder->where('isdeleted', 0);
        });
    }

    public static function scoresTwenty($start_time_stamp, $current_time_stamp = null, $group = "day"){
        // set default time stamp
        if($current_time_stamp === null){
            $current_time_stamp = time();
        }
        // set current date
        $current_date = date('Y-m-d', $current_time_stamp);

        //set start date
        $start_date = date("Y-m-d", $start_time_stamp);

        // get twenty lessons count collection
        $res_20lessons_arr = self::where('complete_time', '<', $current_date)
            ->where('complete_time', '>=', $start_date)
            ->orderBy('complete_time', 'desc')
            ->get()->toArray();
        //dd($res_20lessons_arr);
        
        //以下是分组数据按照天、周、月来分组
        $res_20lessons = array();
        $res_20lessons_final = [];
        $res_20lessons_arr = array_reverse($res_20lessons_arr);
        switch ($group){
            case "day":
                //将每天的记录整合到一起，使用 c_day 判断
                $sum = 0;
                $c_day = date('Y-m-d', $start_time_stamp);
                foreach ($res_20lessons_arr as $i => $v){
                    $v_day = date('Y-m-d', strtotime($v['complete_time']));
                    if($c_day != $v_day){
                        $res_20lessons[] = [
                            'complete_time' => $c_day,
                            'lessons_number' => $sum
                        ];
                        $sum = 0;
                        $c_day = $v_day;
                    }
                    else if($i == count($res_20lessons_arr)-1){
                        $res_20lessons[] = [
                            'complete_time' => $c_day,
                            'lessons_number' => $sum + 1
                        ];
                    }
                    $sum += 1;
                }
                //把得到的日期-课数数据组进行处理，如果某一天无数据，则置为0
                $date = date('Y-m-d', $start_time_stamp);
                if( count($res_20lessons) == 0 || $res_20lessons[count($res_20lessons) - 1]['complete_time'] != date('Y-m-d', strtotime(date('Y-m-d', $current_time_stamp). '-1 day'))){
                    $res_20lessons[] = [
                        'complete_time' => date('Y-m-d', strtotime(date('Y-m-d', $current_time_stamp). '-1 day')),
                        'lessons_number' => 0
                    ];
                }
                
                foreach ($res_20lessons as $i => $v){
                    while($v['complete_time'] != $date && $date < date('Y-m-d', $current_time_stamp)){
                        $res_20lessons_final[] = [
                            'complete_time' => $date,
                            'lessons_number' => 0
                        ];
                        $date = date('Y-m-d', strtotime($date.'+1 day'));
                    }
                    $res_20lessons_final[] = [
                        'complete_time' => $v['complete_time'],
                        'lessons_number' => $v['lessons_number']
                    ];
                    $date = date('Y-m-d', strtotime($date.'+1 day'));
                }

                break;
            
            case "month":
                // 将一个月得记录整合到一起，使用 c_month 判断
                $sum = 0;
                $c_month = date('Y-m', $start_time_stamp);
                foreach($res_20lessons_arr as $i => $v) {
                    $v_month = date('Y-m', strtotime($v['complete_time']));
                    if ($c_month != $v_month) {
                        $res_20lessons_final[] = [
                            'complete_time' => $c_month,
                            'lessons_number' => $sum
                        ];
                        $sum = 0;
                        $c_month = $v_month;
                    } else if ($i == count($res_20lessons_arr) - 1) {
                        $res_20lessons_final[] = [
                            'complete_time' => $c_month,
                            'lessons_number' => $sum + 1
                        ];
                    }
                    $sum += 1;
                }
                break;
        }


        return ['twenty_lessons' => $res_20lessons_final];

    }

    /**
     * 获取20课成绩
     * @param $sno
     * @return mixed
     */
    public static function getTwentyCoursesScore($sno){
        $res = self::leftJoin('twt_applicant_courselist', 'twt_applicant_courselist.course_id', '=', 'twt_20scores.course_id')
            ->where('student_id', $sno)
            ->where('twt_20scores.isdeleted', 0)
            ->orderBy('twt_applicant_courselist.course_id', 'desc')
            ->get()->toArray();
        return $res;
    }

    /**
     * 是否通过课程
     * @param $course_id
     * @param $sno
     * @return mixed
     */
    public static function ifPassCourse($course_id, $sno){
        $res = self::where('course_id', $course_id)
            ->where('student_id', $sno)
            ->get()->toArray();
        return $res;
    }

    /**
     * 更新20课分数
     * @param $course_id
     * @param $sno
     * @param $score
     * @return mixed
     */
    public static function updateScore($course_id, $sno, $score){
        $res = self::where('course_id', $course_id)
            ->where('student_id', $sno)
            ->update([
                'score' => $score,
                'is_systemadd' => 0
            ]);
        return $res;
    }

    /**
     * 添加20课分数
     * @param $course_id
     * @param $sno
     * @param $score
     * @return mixed
     */
    public static function addScore($course_id, $sno, $score){
        $res = self::create([
            'student_id' => $sno,
            'course_id'  => $course_id,
            'score'      => $score,
            'is_systemadd' => 0
        ]);
        return $res;
    }

    /**
     * 分数是否已经存在
     * @param $course_id
     * @param $sno
     * @return mixed
     */
    public static function ifExistScore($course_id, $sno){
        $res = self::where('course_id', $course_id)
            ->where('student_id', $sno)
            ->get()->toArray();
        return $res;
    }

    /**
     * @param $sno
     */
    public static function unclear20($sno){
        $res = self::where('student_id', $sno)
            ->groupBy('course_id')
            ->max('id');
        dd($res);
    }

    /**
     * 清除20课成绩
     * @param $sno
     * @return bool
     */
    public static function clear($sno){
        $res = self::where('student_id', $sno)->update([
            'isdeleted' => 1
        ]);
        return $res ? true : false;
    }

    /**
     * 学生信息管理--状态初始化--系统插入20课成绩
     * @param $sno
     * @param $course_20_id
     * @return bool
     */
    public static function insert20scoreInStudentInfoInit($sno, $course_20_id){
        $res = self::create([
            'student_id' => $sno,
            'course_id' => $course_20_id,
            'score' => 60,
            'is_systemadd' => 1
        ]);
        return $res ? true : false;
    }
}
