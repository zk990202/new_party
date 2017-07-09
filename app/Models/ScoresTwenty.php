<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ScoresModel
 *  入党申请人20课考试成绩
 * @package App\Models
 */
class ScoresTwenty extends Model
{
    //
    protected $table = 'twt_20scores';

    public static function scoresTwenty($current_time_stamp = null){

        //学习的课数..
        // set default time stamp
        if($current_time_stamp === null){
            $current_time_stamp = time();
        }
        $ten_days_ago_time_stamp = $current_time_stamp - 9*3600*24;
        for($i = 0; $i < 10; $i++){
//            $current_time_stamp = $ten_days_ago_time_stamp + $i*3600*24;//当天时间
//            $current_date = date('Y-m-d', $current_time_stamp);
            $current_date = '2013-10-23';
            $s_date = $current_date.'00:00:00';//当天开始时间
            $e_date = $current_date.'23:59:59';//当天结束时间
            $res_20lessons_arr = self::where('isdeleted', 0)
                ->whereBetween('complete_time', [$s_date, $e_date])
                ->get()->toArray();
            dd($res_20lessons_arr[count($res_20lessons_arr-1)]);
        }



//        $time = $time - 9*3600*24;//10天之前的时间.
//        //上一天..
//        $results = array();
//        if($type==1){
//            for($i=0;$i<10;$i++){
//                $now_time = $time + $i*3600*24;//当前的时间..
//                $now_date = date('Y-m-d',$now_time);
//                $s_date = $now_date.' 00:00:00';//开始时间...
//                $e_date = $now_date." 23:59:59";//结束时间...
//                $where = " where isdeleted = 0 and complete_time between '".$s_date."' and '".$e_date."' ";
//                $result = countNum('20scores',$where);
//                //print_R($result);
//                $results[$i]['0'] = (9-$i)."天前";
//                $results[$i]['1'] = $result;
//            }//end of for..
//        }
//        //通过20课的.
//        if($type==2){
//            for($i=0;$i<10;$i++){
//                $now_time = $time + $i*3600*24;//当前的时间..
//                $now_date = date('Y-m-d',$now_time);
//                $s_date = $now_date.' 00:00:00';//开始时间...
//                $e_date = $now_date." 23:59:59";//结束时间...
//                $where = " where is_pass20 = 1 and pass20_time between '".$s_date."' and '".$e_date."'";
//                //print_R($where);
//                $result = countNum('student_info',$where);
//                //print_R($result);
//                $results[$i]['0'] = (9-$i)."天前";
//                $results[$i]['1'] = $result;
//            }//end of for..
//        }
    }

}
