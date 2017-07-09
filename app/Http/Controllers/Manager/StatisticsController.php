<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginCount;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class StatisticsController extends Controller
{
    /**
     * 登陆统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginPage(){

        return view('Manager.Statistics.login');
    }

    /**
     * 登陆统计
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(){
        // 获取本月第一天的时间戳
        $end = strtotime(date('Y-m-01', time()));

        // 过去一周
        $start = strtotime(date("Y-m-d", time()).'-7 day');
        $count_week = LoginCount::loginCountByDay($start);

        // 上个月
        $start = strtotime(date("Y-m-d", $end).'-1 month');
        $count_month = LoginCount::loginCountByDay($start, $end);

        // 过去一年
        $start = strtotime(date('Y-m-d', $end).'-1 year');
        $count_year = LoginCount::loginCountByDay($start, $end, "month");

//        dd($count_year);
        return response()->json([
            'week' => $count_week,
            'month' => $count_month,
            'year' => $count_year
        ]);
    }

    /**
     * 20课统计
     */
    public function twentyLessonsPage(){

        return view('Manager.Statistics.twentyLessons');
    }

    public function twentyLessons(){

    }

}
