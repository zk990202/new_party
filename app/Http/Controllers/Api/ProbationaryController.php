<?php
/**
 * 网上党校--预备党员培训
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/12/14
 * Time: 15:28
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Helpers\Log;
use App\Models\Cert;
use App\Models\College;
use App\Models\Complain;
use App\Models\Probationary\CourseList;
use App\Models\Probationary\ChildEntryForm;
use App\Models\Probationary\EntryForm;
use App\Models\Probationary\TrainList;
use App\Models\StudentInfo;
use Illuminate\Cache\Events\CacheHit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\CssSelector\Node\ElementNode;

class ProbationaryController extends Controller{

    /**
     * 我的课表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function course(Request $request){
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
                'message' => '老师，不好意思，您不能查看课程'
            ]);
        }else{
            $sno = $userInfo['user_number'];
//            $sno = 2014203222;
            //这里还得判断一下..如果该同学报名了,但是没有选课的情况..
            ///这里判断只有一个开启的新的培训....
            $train = TrainList::getNotEndTrain();
            if ($train){
                //这里还得看一下,,如果没有结果可能是已经退出报名了(是否还处于报名状态中)
                $trainId = $train[0]['id'];
//                $trainId = 446;
                $entry = EntryForm::isSign($sno, $trainId);
                if ($entry){
                    $entryId = $entry[0]['id'];
//                    $sno = 3010203239;
//                    $entryId = 119295;
                    $Course = ChildEntryForm::isCourse($sno, $entryId);
                    if ($Course){
                        return response()->json([
                            'success' => 1,
                            'basicInfo' => $userInfo,
                            'entry' => $entry[0],
                            'course'  => $Course
                        ]);
                    }else{
                        return response()->json([
                            'message' => '不好意思,您的课程列表中没有内容,赶紧去选课吧!'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '不好意思,您可能没有报名,或者已经退出选课报名,无法查看您的课表!'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '数据错误，没有最近的培训'
                ]);
            }
        }
    }

    /**
     * 退课
     * @param Request $request
     * @param $entry_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseExit(Request $request, $entry_id){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        $exitInChild = ChildEntryForm::courseExit($entry_id);
        $exit = EntryForm::courseExit($entry_id);
        if ($exitInChild && $exit){
            return response()->json([
                'success' => 1,
                'message' => '退课成功! 该课程已经退选.您已经没有退课的机会了'
            ]);
        }else{
            return response()->json([
                'message' => '退课失败'
            ]);
        }
    }

    public function courseChoosePage(Request $request){
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
                'message' => '老师,不好意思,你不能参加选课!'
            ]);
        }else{
            $sno = $userInfo['user_number'];
            //在这里查看是否有考试开启并且处于网上选课状态,如果有,则列出课程
            $train = TrainList::getTrainInNetChoose();
            if ($train){
                //如果有结果,查看该同学是否已经报名...若报名,则可以继续
                $trainId = $train[0]['id'];
                $isSign = EntryForm::isSign($sno, $trainId);
                if ($isSign){
                    //如果有结果,表示已经报名...把课表拿出来
                    $course = CourseList::getByTrainId($trainId);
                    if ($course){
                        return response()->json([
                            'success' => 1,

                            'course'  => $course
                        ]);
                    }else{
                        return response()->json([
                            'message' => '温馨提示:实在不好意思,虽然网上选课的通道已经开放,但是老师还没有添加相应的课程信息,请耐心等待,或者提醒管理员添加课程信息!'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '您还没有报名,不能查看课表,赶快去看看是否有考试可以参加吧!'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '温馨提示:可能您已经报名,但是可能网上选课的通道还未开放, 或者暂时还没有考试处于开启状态,无法选课!请耐心等待的通道开放'
                ]);
            }
        }
    }

    /**
     * 选课
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseChoose(Request $request){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }

        if ($request->has('trainId') && $request->has('courseId')){
            $trainId = $request->input('trainId');
            $courseId = $request->input('courseId');
            $sno = $userInfo['user_number'];
            for ($i = 0; $i < count($courseId); $i++){
                //第一步应该是查看该用户是否已经选择该课程,如果选择,直接跳过,这里包括你已经退选的课程,也不能再继续选课了
                $chosen = ChildEntryForm::courseHasChosen($sno, $courseId[$i]);
                if (!$chosen){
                    //这里表示没有选择该课程
                    $course = CourseList::getCourseById($courseId[$i]);
                    //这里进行第一步判断,是否能选
                    $isEnough = ChildEntryForm::getByCourseId($courseId[$i]);
                    //必修课 或者是 选修课且人数没满
                    if (count($isEnough) < $course[0]['limitNum'] || $course[0]['type']){
                        //第二步,在数据库里查看该用户已经选择的课程.如果没选满,则查看该课程是否已经选择
                        $choose = ChildEntryForm::isChosen($sno, $course[0]['type'], $trainId);
                        $count = count($choose);//如果是必修课则不能超过3个,选修课不能超过1个
                        //这里还的有一步操作,从数据库里把该同学的报名表拿出来
                        $entry = EntryForm::getBySnoAndTrainId($sno, $trainId);
                        if ($entry){
                            if (!$course[0]['type']){
                                //必修课
                                if ($count < (3 - $entry[0]['passCompulsory'])) {
                                    $add = ChildEntryForm::add($sno, $entry[0]['id'], $courseId[$i]);
                                    if ($add) {
                                        return response()->json([
                                            'success' => 1
                                        ]);
                                    } else {
                                        return response()->json([
                                            'message' => '选课失败'
                                        ]);
                                    }
                                }else{
                                    return response()->json([
                                        'message' => '1'
                                    ]);
                                }
                            }else{
                                //选修课
                                if ($count < (1 - $entry[0]['passElective'])){
                                    $add = ChildEntryForm::add($sno, $entry[0]['id'], $courseId[$i]);
                                    if ($add) {
                                        return response()->json([
                                            'success' => 1
                                        ]);
                                    } else {
                                        return response()->json([
                                            'message' => '选课失败'
                                        ]);
                                    }
                                }else{
                                    return response()->json([
                                        'message' => '1'
                                    ]);
                                }
                            }
                        }else{
                            return response()->json([
                                'message' => '不好意思，没有你的报名信息'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message' => ''
                        ]);
                    }
                }else{
                    continue;
                }
            }
        }else{
            return response()->json([
                'message' => '参数丢失(trainId||courseId)'
            ]);
        }
    }

    /**
     * 考试报名
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function testSignPage(Request $request){
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
                'message' => '老师,不好意思,您不能参加考试报名!'
            ]);
        }else{
            $sno = $userInfo['user_number'];
//            $sno = 2009205035;
            $studentInfo = StudentInfo::getBySno($sno);
            if ($studentInfo){
                //先到数据库里查看一下该用户是否满足报名预备党员考试....状态在10和11的都可以参加报名考试
                if ($studentInfo[0]['mainStatus'] == 10 || $studentInfo[0]['mainStatus'] == 11){
                    //再看下用户是否已经通过了预备党员考试
                    $isPass = EntryForm::isPass($sno);
                    if (!$isPass){
                        //查看是哪一期考试开启了....选择状态为1==报名开始的
                        $train = TrainList::getTrainInSign();
                        if ($train){
                            $trainId = $train[0]['id'];
                            //还得判断该同学该期考试是否已经报名
                            $entry = EntryForm::isSign($sno, $trainId);
                            if (!$entry){
                                return response()->json([
                                    'success' => 1,
                                    'train' => $train[0]
                                ]);
                            }else{
                                return response()->json([
                                    'message' => '您已经报名了该期考试,不能重复报名,去查看你的课表吧.!'
                                ]);
                            }
                        }else{
                            return response()->json([
                                'message' => '温馨提示:不好意思,暂时还没有考试开启或者考试开启但是参加报名通道未开放,请耐心等待!'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message' => '您已经通过预备党员结业考试,无需再次报名!'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '不好意思,您目前的状态不符合报名的要求,只有状态通过[预备党员]或者是已经完成[支部组织生活和党内活动],并且没有完成预备党员党校学习的学员才可以参加预备党员结业考试!如果有任何问题,请联系超管处理,谢谢!'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '学生信息获取失败'
                ]);
            }
        }
    }

    /**
     * 考试报名--提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function testSign(Request $request){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }

        $sno = $userInfo['user_number'];
//            $sno = 2009205035;
        $studentInfo = StudentInfo::getBySno($sno);
        if ($studentInfo){
            //先到数据库里查看一下该用户是否满足报名预备党员考试....状态在10和11的都可以参加报名考试
            if ($studentInfo[0]['mainStatus'] == 10 || $studentInfo[0]['mainStatus'] == 11){
                //再看下用户是否已经通过了预备党员考试
                $isPass = EntryForm::isPass($sno);
                if (!$isPass){
                    //查看是哪一期考试开启了....选择状态为1==报名开始的
                    $train = TrainList::getTrainInSign();
                    if ($train){
                        $trainId = $train[0]['id'];
                        //还得判断该同学该期考试是否已经报名
                        $entry = EntryForm::isSign($sno, $trainId);
                        if (!$entry){
                            $add = EntryForm::sign($sno, $trainId);
                            if ($add){
                                return response()->json([
                                    'success' => 1,
                                    'message' => '恭喜你,报名成功! 现在就去选课吧!'
                                ]);
                            }else{
                                return response()->json([
                                    'message' => '不好意思,报名失败! 未知错误!'
                                ]);
                            }
                        }else{
                            return response()->json([
                                'message' => '您已经报名了该期考试,不能重复报名,去查看你的课表吧.!'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message' => '温馨提示:不好意思,暂时还没有考试开启或者考试开启但是参加报名通道未开放,请耐心等待!'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '您已经通过预备党员结业考试,无需再次报名!'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '不好意思,您目前的状态不符合报名的要求,只有状态通过[预备党员]或者是已经完成[支部组织生活和党内活动],并且没有完成预备党员党校学习的学员才可以参加预备党员结业考试!如果有任何问题,请联系超管处理,谢谢!'
                ]);
            }
        }else{
            return response()->json([
                'message' => '学生信息获取失败'
            ]);
        }
    }

    /**
     * 报名结果
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signResult(Request $request){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        $sno = $userInfo['user_number'];
        $entry = EntryForm::signResult($sno);
        if ($entry){
            return response()->json([
                'success' => 1,
                'basicInfo' => $userInfo,
                'entry'   => $entry[0]
            ]);
        }else{
            return response()->json([
                'message' => '不好意思，暂无报名信息'
            ]);
        }
    }

    /**
     * 退出报名
     * @param Request $request
     * @param $entry_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function signExit(Request $request, $entry_id){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }

        $exit = EntryForm::signExit($entry_id);
        if ($exit){
            return response()->json([
                'success' => 1,
                'message' => '恭喜,您已经退出本期考试的报名,不能再参加本期考试了.!'
            ]);
        }else{
            return response()->json([
                'message' => '退出报名失败!'
            ]);
        }
    }

    /**
     * 成绩查询
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function gradeCheck(Request $request){
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
                'message' => '老师,不好意思,您没有考试成绩可以查看!'
            ]);
        }else{
            $sno = $userInfo['user_number'];
//            $sno = 2014203222;
            $entry = EntryForm::gradeCheck($sno);
            if (!$entry){
                return response()->json([
                    'message' => '不好意思，没有找到你的考试信息'
                ]);
            }else{
                if (!$entry[0]['gradeSearchStatus']){
                    return response()->json([
                        'message' => '不好意思,成绩查询通道未开启!'
                    ]);
                }else{
                    return response()->json([
                        'success' => 1,
                        'basicInfo' => $userInfo,
                        'grade'   => $entry[0]
                    ]);
                }
            }
        }
    }

    /**
     * 申诉--页面
     * @param Request $request
     * @param $train_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function complainPage(Request $request, $train_id){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        $train = TrainList::getOneTrain($train_id);
        if (!$train){
            return response()->json([
                'message' => '没有找到对应的培训'
            ]);
        }else{
            return response()->json([
                'success' => 1,
                'basicInfo' => $userInfo,
                'train' => $train[0]
            ]);
        }
    }

    /**
     * 申诉--提交
     * @param Request $request
     * @param $train_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function complain(Request $request, $train_id){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        $title = $request->input('title');
        $content = $request->input('content');
        if (!$title){
            return response()->json([
                'message' => '不要太懒,至少得添加标题!'
            ]);
        }else{
            $sno = $userInfo['user_number'];
            $collegeCode = $userInfo['college_code'];
            $collegeId = College::codeToId($collegeCode);
            $complain = Complain::addComplainProbationary($sno, $collegeId, $train_id, $title, $content);
            if (!$complain){
                return response()->json([
                    'message' => '不好意思,该申诉未能正常保存!'
                ]);
            }else{
                return response()->json([
                    'success' => 1,
                    'message' => '申诉成功'
                ]);
            }
        }
    }

    /**
     * 证书查看
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function certificateCheck(Request $request){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        if (!$userInfo['is_teacher']){
            $sno = $userInfo['user_number'];
//            $sno = 2008201021;
            $entry = EntryForm::certGetEntry($sno);
            if (!$entry){
                return response()->json([
                    'message' => '不好意思，你还没有获得证书'
                ]);
            }else{
                $entryId = $entry[0]['id'];
                $cert = Cert::certCheckProbationary($entryId);
                if ($cert){
                    return response()->json([
                        'success' => 1,
                        'basicInfo' => $userInfo,
                        'cert' => $cert[0]
                    ]);
                }else{
                    return response()->json([
                        'message' => '温馨提示:不好意思,没有找到相应的证书,但是您的考试状态为通过,并且显示已经发放证书.可能后台数据出现了问题.请联系管理员进行处理,申请补发证书!'
                    ]);
                }
            }
        }else{
            return response()->json([
                'message' => '不好意思，老师，您不能查看证书'
            ]);
        }
    }
}