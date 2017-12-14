<?php
/**
 * 网上党校--申请人培训
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/11/16
 * Time: 18:41
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Log;
use App\Http\Helpers\Resources;
use App\Models\Applicant\ArticleList;
use App\Models\Applicant\CourseList;
use App\Models\Applicant\EntryForm;
use App\Models\Applicant\ExerciseForTwenty;
use App\Models\Applicant\ExerciseList;
use App\Models\Applicant\TestList;
use App\Models\Cert;
use App\Models\ScoresTwenty;
use App\Models\StudentFiles;
use App\Models\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ApplicantController extends Controller {

    /**
     * 课程学习
     * @return \Illuminate\Http\JsonResponse
     */
    public function allCourse(){
        $course = CourseList::getAll();
        if ($course){
            return response()->json([
                'success' => 1,
                'course' => $course
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 一个课程对应的几篇文章
     * @param $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function course($course_id){
        //得到课程对应的文章
        $article = ArticleList::getArticleById($course_id);
        if ($article){
            return response()->json([
                'success' => 1,
                'article' => $article
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 文章详情
     * @param $article_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function article($article_id){
        $article = ArticleList::getOneArticle($article_id);
        if ($article){
            return response()->json([
                'success' => 1,
                'article' => $article
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 20课成绩查询
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function twentyCoursesScore(Request $request){
        $userInfo = [];
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
                'message' => '老师，不好意思，你不可以查看20课成绩'
            ]);
        }else{
            $sno = $userInfo['user_number'];
            $result = ScoresTwenty::getTwentyCoursesScore($sno);
            if ($result){
                return response()->json([
                    'success' => 1,
                    'studentInfo' => $result
                ]);
            }else{
                return response()->json([
                    'message' => 'Data Error'
                ]);
            }
        }

    }

    /**
     * 根据课程id获取题目
     * @param Request $request
     * @param $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function exercisePage(Request $request, $course_id){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        //判断是否是老师
        if (!$userInfo['is_teacher']){
            $sno = $userInfo['user_number'];
            $exercises = [];
            //如果选择的是第一课,那么就得判断该用户是否提交入党申请书
            if ($course_id == 41){
                $studentFile = StudentFiles::getStudentFile($sno);
                if (!$studentFile){
                    return response()->json([
                        'message' => '不好意思,您可能没有提交入党申请书,或者是没有通过,暂时还不是申请人的身份,不能答题!'
                    ]);
                }else {
                    // 随机获取20道题
                    $exercises = ExerciseList::getExerciseById($course_id);
                    // 将题目答案缓存
                    Cache::put('exercises', $exercises, 60);
                    $exercisesHideAnswer = [];
                    for ($i = 0; $i < count($exercises); $i++){
                        $exercisesHideAnswer[$i]['id'] = $exercises[$i]['id'];
                        $exercisesHideAnswer[$i]['courseName'] = $exercises[$i]['courseName'];
                        $exercisesHideAnswer[$i]['content'] = $exercises[$i]['content'];
                        $exercisesHideAnswer[$i]['optionA'] = $exercises[$i]['optionA'];
                        $exercisesHideAnswer[$i]['optionB'] = $exercises[$i]['optionB'];
                        $exercisesHideAnswer[$i]['optionC'] = $exercises[$i]['optionC'];
                        $exercisesHideAnswer[$i]['optionD'] = $exercises[$i]['optionD'];
                        $exercisesHideAnswer[$i]['optionE'] = $exercises[$i]['optionE'];
                    }
                    return response()->json([
                        'success' => 1,
                        'exercises' => $exercisesHideAnswer
                    ]);
                }
            }else{
                //表示不是第一课..那么判断他的前一课是否通过..
                $preCourseId = $course_id - 1;
                $ifPass = ScoresTwenty::ifPassCourse($preCourseId, $sno);
                if (!$ifPass){
                    return response()->json([
                        'message' => '不好意思，你上一课还没有通过，不能参加下一课的考试'
                    ]);
                }else{
                    $exercises = ExerciseList::getExerciseById($course_id);
                    Cache::put('exercises', $exercises, 30);
                    $exercisesHideAnswer = [];
                    for ($i = 0; $i < count($exercises); $i++){
                        $exercisesHideAnswer[$i]['id'] = $exercises[$i]['id'];
                        $exercisesHideAnswer[$i]['courseName'] = $exercises[$i]['courseName'];
                        $exercisesHideAnswer[$i]['content'] = $exercises[$i]['content'];
                        $exercisesHideAnswer[$i]['optionA'] = $exercises[$i]['optionA'];
                        $exercisesHideAnswer[$i]['optionB'] = $exercises[$i]['optionB'];
                        $exercisesHideAnswer[$i]['optionC'] = $exercises[$i]['optionC'];
                        $exercisesHideAnswer[$i]['optionD'] = $exercises[$i]['optionD'];
                        $exercisesHideAnswer[$i]['optionE'] = $exercises[$i]['optionE'];
                    }
                    return response()->json([
                        'success' => 1,
                        'exercises' => $exercisesHideAnswer
                    ]);
                }
            }
        }else{
            return response()->json([
                'message' => '不好意思，老师，您不能答题'
            ]);
        }
    }

    /**
     * 提交20课题目作答
     * @param Request $request
     * @param $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function exercise(Request $request, $course_id){
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        $sno = $userInfo['user_number'];
        $chooses = $request->input('choose');

        if (Cache::has('exercises')){
            $correct = Cache::get('exercises');
        }
        else{
            return response()->json([
                'message' => '请刷新页面',
                'score'   => 0
            ]);
        }
        $score = 0;
        for ($i = 0; $i < count($correct); $i++){
            if ($chooses[$i] == $correct[$i]['answerLetter']){
                $score+=5;
            }
        }
        // 从缓存中删除题目答案
        Cache::forget('exercises');
        if ($score >= 60){
            //表示通过考试...然后我们要做一下判断...
            //一,看数据库中是否有该课程的成绩...
            $ifExist = ScoresTwenty::ifExistScore($course_id, $sno);
            if ($ifExist){
                //表示有结果了...那么就把她拿出来判断比较一下..
                if ($score > $ifExist[0]['score']){
                    $update = ScoresTwenty::updateScore($course_id, $sno, $score);
                    if ($update){
                        return response()->json([
                            'success' => 1,
                            'score'   => $score
                        ]);
                    }else{
                        return response()->json([
                            'message' => 'Insert Database Error',
                            'score'   => $score
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '没有达到刷分的水平,回去练练再来吧!',
                        'score'   => $score
                    ]);
                }
            }else{
                //判断课程id
                if ($course_id == 60){
                    //如果是60,表示最后一课,我们要在info表中存入数据...
                    //先在20score表插入数据
                    $addScore = ScoresTwenty::addScore($course_id, $sno, $score);
                    if ($addScore){
                        $updateInfo = StudentInfo::updatePassTwenty($sno);
                        if ($updateInfo){
                            return response()->json([
                                'success' => 1,
                                'message' => '恭喜您,通过网上20课党校课程学习!提示:请随时关注党校通知公告,参加申请人结业考试!',
                                'score'   => $score
                            ]);
                        }else{
                            return response()->json([
                                'message' => '操作失败!查看是否有20成绩,如果有成绩但是个人状态未改,请联系管理员',
                                'score'   => $score
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message' => '操作失败!不好意思,该课成绩插入失败!请重新作答!',
                            'score'   => $score
                        ]);
                    }
                }else {
                    //表示就是普通的答题...
                    $addScore = ScoresTwenty::addScore($course_id, $sno, $score);
                    if ($addScore) {
                        return response()->json([
                            'success' => 1,
                            'message' => '答题成功',
                            'score' => $score
                        ]);
                    } else {
                        return response()->json([
                            'message' => '不好意思,成绩插入失败!',
                            'score' => $score
                        ]);
                    }
                }
            }
        }else{
            return response()->json([
                'message' => '不好意思,你没有通过考试',
                'score'   => $score
            ]);
        }
    }

    /**
     * 报名页面
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signPage(Request $request){
        $test = TestList::getAll();
        //获取当前考试的id
        $testId = $test[0]['id'];

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
                'message' => '老师，不好意思，您不能报名参加考试'
            ]);
        }else{
            $sno = $userInfo['user_number'];
            //判断学生是否通过20课考试
            $isPass20 = StudentInfo::isPass20($sno);
            if ($isPass20[0]['isPassed']){
                //判断学生账号是否被锁
                if (!$isPass20[0]['applicantIsLocked']){
                    //判断是否已经通过申请人结业考试
                    $isPass = EntryForm::isPass($sno);
                    if (!$isPass){
                        //判断是否有考试开启
                        $isOpen = TestList::ifOpen();
                        if ($isOpen){
                            //查看该期考试是否已经报名
                            $isSign = EntryForm::isEntry($sno, $testId);
                            if (!$isSign){
                                return response()->json([
                                    'success' => 1
                                ]);
                            }else{
                                return response()->json([
                                    'message' => '您已经参加过本期考试的报名了!到[报名结果中进行查看吧]!'
                                ]);
                            }
                        }else{
                            return response()->json([
                                'message' => '不好意思,暂时还没有考试处于报名开启状态!'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message' => '不好意思,您已经通过申请人结业考试,无需报名!'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '不好意思,您的账号已经被锁住,无法进行报名.请联系超管请求解锁'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '不好意思,您还没有通过20课的学习,无法参加结业考试!'
                ]);
            }
        }
    }

    /**
     * 报名逻辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sign(Request $request){
        $test = TestList::getAll();
        //获取当前考试的id
        $testId = $test[0]['id'];

        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }

        $campus = '';
        if ($request->has('campus')){
            $campus = $request->input('campus');
        }

        $sno = $userInfo['user_number'];
        $isSign = EntryForm::isEntry($sno, $testId);
        //判断是否已经报名，避免重复报名
        if (!$isSign){
            $sign = EntryForm::signAdd($sno, $testId, $campus);
            if ($sign){
                return response()->json([
                    'success' => 1,
                ]);
            }else{
                return response()->json([
                    'message' => '报名失败，遇到了一个错误，请重新提交'
                ]);
            }
        }else{
            return response()->json([
                'message' => '不好意思,您已经报名了,不要重复刷新本页,对您没有半点好处!'
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

        if ($userInfo['is_teacher']){
            return response()->json([
                'message' => '老师，不好意思，您不能查看报名结果'
            ]);
        }else{
            $sno = $userInfo['user_number'];
            $result = EntryForm::getSignResult($sno);
            if ($result){
                return response()->json([
                    'success' => 1,
                    'basicInfo' => $userInfo,
                    'result' => $result[0]
                ]);
            }else{
                return response()->json([
                    'message' => '暂无报名结果'
                ]);
            }
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
                'message' => '不好意思，退出报名失败'
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
                'message' => '老师,不好意思,您不可查看成绩'
            ]);
        }else{
            $sno = $userInfo['user_number'];
            //查看成绩有个要求..必须是考试处于成绩录入结束的状态以后
            $grade = EntryForm::gradeCheck($sno);
            if ($grade){
                $count = count($grade);
                return response()->json([
                    'success' => 1,
                    'basicInfo' => $userInfo,
                    'grade' => $grade,
                    'count' => $count
                ]);
            }else{
                return response()->json([
                    'message' => '查询成绩出错！'
                ]);
            }
        }
    }

    /**
     * 证书查询
     * @param Request $request
     * @param $entry_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function certificateCheck(Request $request, $entry_id){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }

        if ($userInfo['is_teacher']) {
            return response()->json([
                'message' => '老师,不好意思,您不可查看成绩'
            ]);
        }else{
            $sno = $userInfo['user_number'];
            $entryForm = EntryForm::certificateCheck($sno);
            if ($entryForm){
                $cert = Cert::certCheckApplicant($entry_id);
                if ($cert){
                    return response()->json([
                        'success' => 1,
                        'basicInfo' => $userInfo,
                        'cert' => $cert[0]
                    ]);
                }else{
                    return response()->json([
                        'message' => '不好意思,没有找到相应的证书,请联系管理员!'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '不好意思,没有找到相应的证书!'
                ]);
            }
        }
    }

    /**
     * 账号状态
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function accountStatus(Request $request){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }

        if ($userInfo['is_teacher']) {
            return response()->json([
                'message' => '老师,不好意思,您没有账号状态可以查询'
            ]);
        }else{
            $sno = $userInfo['user_number'];
            $studentInfo = StudentInfo::getBySno($sno);
            //申请人结业培训状态
            $status = EntryForm::accountStatus($sno) ? 1 : 0;
            if ($studentInfo){
                return response()->json([
                    'success' => 1,
                    'basicInfo' => $userInfo,
                    'studentInfo' => $studentInfo[0],
                    'status' => $status
                 ]);
            }else{
                return response()->json([
                    'message' => '数据取出失败，请联系超级管理员'
                ]);
            }
        }
    }
}