<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginCount extends Model
{
    //
    protected $table = "twt_logincount";

    /**
     * 获取过去一段时间（给定时间范围）的访问量，左闭右开
     * @param int $start_time_stamp 起始时间戳
     * @param null $current_time_stamp 结束时间戳
     * @param string $group 分组条件 ["day"|"week"|"year"]
     * @return array
     */
    public static function loginCountByDay($start_time_stamp, $current_time_stamp = null, $group = "day"){
        // set default time stamp
        if($current_time_stamp === null){
            $current_time_stamp = time();
        }
        // set current date
        $current_date = date('Y-m-d', $current_time_stamp);

        //set start date
        $start_date = date("Y-m-d", $start_time_stamp);

        // get user login count collection
        $res_user_arr = self::where('type', 1)
            ->where('login_date', '<', $current_date)
            ->where('login_date', '>=', $start_date)
            ->orderBy('login_date', 'desc')
            ->get()->toArray();

        // 这里需要注意，由于不是每天的访问记录都有（有的时候可能没有人访问），所以需要预处理一下数组，将没有的天加进去
        $res_user_full = [];
        $date = date('Y-m-d', $start_time_stamp);

        $res_user_arr = array_reverse($res_user_arr);
        if($res_user_arr[count($res_user_arr) - 1]['login_date'] != date('Y-m-d', strtotime(date('Y-m-d', $current_time_stamp). '-1 day')))
            $res_user_arr[] = [
                'login_date' => date('Y-m-d', strtotime(date('Y-m-d', $current_time_stamp). '-1 day')),
                'login_num' => 0
            ];

        foreach($res_user_arr as $i => $v) {
            while($v['login_date'] != $date && $date < date('Y-m-d', $current_time_stamp)){
                $res_user_full[] = [
                    'login_date' => $date,
                    'login_num' => 0
                ];
                $date = date('Y-m-d', strtotime($date.'+1 day'));
            }
            $res_user_full[] = [
                'login_date' => $v['login_date'],
                'login_num' => $v['login_num']
            ];
            $date = date('Y-m-d', strtotime($date.'+1 day'));
        }

        // 管理员登录记录，也需要进行预处理
        $res_admin_arr = self::where('type', 2)
            ->where('login_date', '<', $current_date)
            ->where('login_date', '>=', $start_date)
            ->orderBy('login_date', 'desc')
            ->get()->toArray();

        $res_admin_full = [];
        $date = date('Y-m-d', $start_time_stamp);

        $res_admin_arr = array_reverse($res_admin_arr);
        if($res_admin_arr[count($res_admin_arr) - 1]['login_date'] != date('Y-m-d', strtotime(date('Y-m-d', $current_time_stamp). '-1 day')))
            $res_admin_arr[] = [
                'login_date' => date('Y-m-d', strtotime(date('Y-m-d', $current_time_stamp). '-1 day')),
                'login_num' => 0
            ];
        foreach($res_admin_arr as $i => $v) {
            while($v['login_date'] != $date && $date < date('Y-m-d', $current_time_stamp)){
                $res_admin_full[] = [
                    'login_date' => $date,
                    'login_num' => 0
                ];
                $date = date('Y-m-d', strtotime($date.'+1 day'));
            }
            $res_admin_full[] = [
                'login_date' => $v['login_date'],
                'login_num' => $v['login_num']
            ];
            $date = date('Y-m-d', strtotime($date.'+1 day'));
        }

        // 以下是分组数据，按照天，周，月来分组
        $res_admin = $res_user = array();
        switch($group){
            case "day":
                $res_user = $res_user_full;
                $res_admin = $res_admin_full;
                break;
            case "month":
                // 将一个月得记录整合到一起，使用 c_month 判断
                $sum = 0;
                $c_month = date('Y-m', $start_time_stamp);
                foreach($res_user_full as $i => $v){
                    $v_month = date('Y-m', strtotime($v['login_date']));
                    if($c_month != $v_month){
                        $res_user[] = [
                            'login_date' => $c_month,
                            'login_num' => $sum
                        ];
                        $sum = 0;
                        $c_month = $v_month;
                    } else if ($i == count($res_user_full) - 1){
                        $res_user[] = [
                            'login_date' => $c_month,
                            'login_num' => $sum + $v['login_num']
                        ];
                    }
                    $sum += $v['login_num'];
                }

                $sum = 0;
                $c_month = date('Y-m', $start_time_stamp);
                foreach($res_admin_full as $i => $v){
                    $v_month = date('Y-m', strtotime($v['login_date']));
                    if($c_month != $v_month){
                        $res_admin[] = [
                            'login_date' => $c_month,
                            'login_num' => $sum
                        ];
                        $sum = 0;
                        $c_month = $v_month;
                    } else if ($i == count($res_admin_full) - 1){
                        $res_admin[] = [
                            'login_date' => $c_month,
                            'login_num' => $sum + $v_month['login_num']
                        ];
                    }
                    $sum += $v['login_num'];
                }
                break;
        }


        return ['user' => $res_user, 'admin' => $res_admin];
    }
}
