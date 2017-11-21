<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Log;
use App\Models\Column;
use App\Models\LoginCount;
use App\Models\Notification;
use App\Models\PartyBranch\PartyBranch;
use App\Models\SpecialNews;
use App\Models\StudentInfo;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/11/14
 * Time: 18:46
 .*/
class IndexController extends Controller{

    public function index(Request $request){
        //这里判断用户登录信息..
        $mainStatus = '';
        if ($request->has('token')){
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            $userNumb = $userInfo['user_number'];
            $date = date('Y-m-d');
            $result = LoginCount::getByDate($date);
            if ($result){
                // 如果当天已经有有结果了，直接+1
                LoginCount::updateCount($result[0]['id']);
            }
            else{
                // 没有则插入一条记录
                LoginCount::addCount($date);
            }

            //登录成功后还要判断用户的入党状态main_status
            $student = StudentInfo::getStudentInfo($userNumb);
            $mainStatus = $student[0]['mainStatus'];

        }


        //党建专项，从数据库中取出6条数据
        //先取出党建专项的id
        $type1 = Column::getSpecialId();
        $type = [];
        for ($i = 0; $i < count($type1); $i++){
            $type[$i] = $type1[$i]['column_id'];
        }
        $partyBuild = SpecialNews::getIndexDataPartyBuild($type);
        //前台需要id和title

        //最新通知，取出最新的四条
        $notices = Notification::getIndexData();
        //前台需要id,title,time

        //党校培训
        $partySchool = SpecialNews::getIndexDataPartySchool();
        //前台需要id,title,imgPath

        //支部风采
        $branchActivity = PartyBranch::getIndexData();
        //前台需要id,name

        //榜样力量
        //(需要链接其他数据库)

        if ($partyBuild && $notices && $partySchool && $branchActivity){
            return response()->json([
                'success'     => 1,
                'partyBuild'  => $partyBuild,
                'notice'      => $notices,
                'partySchool' => $partySchool,
                'branchActivity'      => $branchActivity,
                'mainStatus'  => $mainStatus
            ]);
        }else{
            return response()->json([
                'message' => '取出数据失败'
            ]);
        }

    }

}