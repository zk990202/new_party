<?php
/**
 * 网上党校--院级积极分子培训
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/12/10
 * Time: 20:29
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Helpers\Log;
use App\Models\Academy\EntryForm;
use App\Models\Academy\TestList;
use App\Models\College;
use App\Models\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AcademyController extends Controller{

    /**
     * 课程学习--所有课程
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function allCourse(Request $request){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        $collegeCode = $userInfo['college_code'];
        if ($collegeCode){
            $collegeId = College::codeToId($collegeCode);
            $course = TestList::allCourse($collegeId);
            if ($course){
                return response()->json([
                    'success' => 1,
                    'course' => $course
                ]);
            }else{
                return response()->json([
                    'message' => '取出数据出错，请联系管理员'
                ]);
            }
        }else{
            return response()->json([
                'message' => '不好意思,您没有所属学院,可能您确实没有学院信息,但是如果数据有问题,请联系超管进行处理!'
            ]);
        }
    }

    /**
     * 课程详情
     * @param $test_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseDetail($test_id){
        $test = TestList::TestDetail($test_id);
        if ($test){
            return response()->json([
                'success' => 1,
                'test' => $test[0]
            ]);
        }else{
            return response()->json([
                'message' => '取出数据失败，请联系后台管理员'
            ]);
        }
    }

    /**
     * 报名考试
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signPage(Request $request){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }

        if ($userInfo['is_teacher']){
            return response()->json([
                'message' => '不好意思,老师,您不能参加院级的报名!'
            ]);
        }else{
            $sno = $userInfo['user_number'];
            $collegeCode = $userInfo['college_code'];
            $collegeId = College::codeToId($collegeCode);

            //查看院级考试报名是否开启
            $isOpen = TestList::isOpen($collegeId);
            if ($isOpen){
                //表示有培训可以参加.....
                //这里应该有一步判断..如果该同学已经报名了,就不允许报名了
                $testId = $isOpen[0]['test_id'];
                Cache::put('AcademyTestId', $testId, 30);
                $isSign = EntryForm::isSign($sno, $isOpen[0]['test_id']);
                if (!$isSign){
                    //表示没有报名....
                    //判断该同学是否已经完成院级的考试..
                    $isPass = EntryForm::isPass($sno);
                    if (!$isPass){
                        //表示没有通过...
                        //判断申请人的是否通过.
                        $applicantIsPass = \App\Models\Applicant\EntryForm::isPass($sno);
                        if ($applicantIsPass) {
                            return response()->json([
                                'success' => 1,
                                'test' => $isOpen[0]
                            ]);
                        }else{
                            return response()->json([
                                'message' => '不好意思,您还没有通过申请人结业考试,不能参加院级结业考试'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message' => '不好意思,您已经通过了院级结业考试,无需报名!'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '不好意思,您已经报名了,或者您已经退出该考试报名,都是不能重复报名的,请等待下次报名的开启,或者联系管理员进行处理!!'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '不好意思,暂时还没有考试可以报名!'
                ]);
            }
        }
    }

    /**
     * 报名--提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sign(Request $request){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }

        if (Cache::has('AcademyTestId')){
            $testId = Cache::get('AcademyTestId');
            Cache::forget('AcademyTestId');

            $sno = $userInfo['user_number'];
            $isSign = EntryForm::isSign($sno, $testId);
            if (!$isSign){
                $add = EntryForm::sign($sno, $testId);
                if ($add){
                    return response()->json([
                        'success' => 1,
                        'message' => '恭喜您,报名成功!'
                    ]);
                }else{
                    return response()->json([
                        'message' => '报名失败，未知错误'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '您已经报名了.不可刷新本页面!'
                ]);
            }

        }else{
            return response()->json([
                'message' => '请刷新页面'
            ]);
        }


    }

}