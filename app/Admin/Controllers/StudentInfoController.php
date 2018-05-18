<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/5/16
 * Time: 23:10
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Middleware\Access;
use App\Http\Service\AdminMenuService;
use App\Http\Service\PartyStatus\AcademyPartySchool;
use App\Http\Service\PartyStatus\Activity;
use App\Http\Service\PartyStatus\ApplicantLearningGroup;
use App\Http\Service\PartyStatus\ApplicantPartySchool;
use App\Http\Service\PartyStatus\Communist;
use App\Http\Service\PartyStatus\IdeologicalReport_1;
use App\Http\Service\PartyStatus\IdeologicalReport_2;
use App\Http\Service\PartyStatus\IdeologicalReport_3;
use App\Http\Service\PartyStatus\IdeologicalReport_4;
use App\Http\Service\PartyStatus\MainStatus;
use App\Http\Service\PartyStatus\MemberRecommendation;
use App\Http\Service\PartyStatus\PartyApplication;
use App\Models\Applicant\EntryForm;
use App\Models\Cert;
use App\Models\Classes;
use App\Models\College;
use App\Models\Control;
use App\Models\ScoresTwenty;
use App\Models\StudentFiles;
use App\Models\StudentInfo;
use App\Models\UserInfo;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class StudentInfoController extends Controller
{
    protected $imgExtension;
    protected $imgUsage = 'partyBuildImg';
    protected $titles;

    protected $partyApplicationService;
    protected $applicantPartySchoolService;
    protected $ideologicalReport_1Service;
    protected $ideologicalReport_2Service;
    protected $ideologicalReport_3Service;
    protected $ideologicalReport_4Service;
    protected $applicantLearningGroupService;
    protected $academyPartySchoolService;
    protected $communistService;
    protected $memberRecommendationService;
    protected $activityService;

    public $module;

    public function __construct(PartyApplication $partyApplication,
                                ApplicantPartySchool $applicantPartySchool,
                                IdeologicalReport_1 $ideologicalReport_1,
                                IdeologicalReport_2 $ideologicalReport_2,
                                IdeologicalReport_3 $ideologicalReport_3,
                                IdeologicalReport_4 $ideologicalReport_4,
                                ApplicantLearningGroup $applicantLearningGroup,
                                AcademyPartySchool $academyPartySchool,
                                Communist $communist,
                                MemberRecommendation $memberRecommendation,
                                Activity $activity)
    {
        $this->imgExtension = config('fileUpload');
        $this->titles = AdminMenuService::getMenuName();
        $this->partyApplicationService = $partyApplication;
        $this->applicantPartySchoolService = $applicantPartySchool;
        $this->ideologicalReport_1Service = $ideologicalReport_1;
        $this->ideologicalReport_2Service = $ideologicalReport_2;
        $this->ideologicalReport_3Service = $ideologicalReport_3;
        $this->ideologicalReport_4Service = $ideologicalReport_4;
        $this->applicantLearningGroupService = $applicantLearningGroup;
        $this->academyPartySchoolService = $academyPartySchool;
        $this->communistService = $communist;
        $this->memberRecommendationService = $memberRecommendation;
        $this->activityService = $activity;
    }

    /**
     * 状态初始化--筛选学生
     * @return Content
     */
    public function initPreviewPage()
    {
        //先判断当前是否可以进行学生状态初始化
        $status = Control::getStatusReset();
        $status = 1;
        if (!$status){
            if (!Admin::user()->isAdministrator()){
                $title = '功能初始化失败';
                $message = '不好意思,该功能暂未开启.请等待超管开启!';
                $viewData = ['title' => $title, 'message' => $message];
            }else{
                $title = '功能初始化失败';
                $message = '不好意思,该功能暂未开启.您是超管,可以开启!';
                $viewData = ['title' => $title, 'message' => $message];
            }
            return Admin::content(function (Content $content) use ($viewData){
                // 选填
                $content->header($this->titles[0] ?? '管理后台');
                // 选填
                $content->description($this->titles[1] ?? '');
                // 填充页面body部分，这里可以填入任何可被渲染的对象
                $content->body(view('Admin.Message', $viewData));
            });
        }
        else{
            //获取所有学院
            $college = College::getAll();
            //获取入学年份为当前年份的学生的入学年份
            $grade = Classes::getInSchoolYearIsCurrentYear();
            $grade = '2017';
            $viewData = ['colleges' => $college, 'grade' => $grade];
            return Admin::content(function (Content $content) use ($viewData){
                // 选填
                $content->header($this->titles[0] ?? '管理后台');
                // 选填
                $content->description($this->titles[1] ?? '');
                // 填充页面body部分，这里可以填入任何可被渲染的对象
                $content->body(view('Admin.StudentInfo.initPreview', $viewData));
            });
        }
    }

    /**
     * 状态初始化--选择学生和状态
     * @param Request $request
     * @return Content
     */
    public function initPage(Request $request)
    {
        $collegeId = $request->input('collegeId');
        $grade = $request->input('schoolYear');
        if (!$collegeId || !$grade){
            $viewData = [
                'title' => '提示信息',
                'message' => '学院和年级都不能为空'
            ];
            return Admin::content(function (Content $content) use ($viewData){
                // 选填
                $content->header($this->titles[0] ?? '管理后台');
                // 选填
                $content->description($this->titles[1] ?? '');
                // 填充页面body部分，这里可以填入任何可被渲染的对象
                $content->body(view('Admin.Message', $viewData));
            });
        }else{
            $userInfo = UserInfo::getByCollegeIdAndGrade($collegeId, $grade);
            $sno = [];
            for($i = 0; $i < count($userInfo); $i++){
                $sno[$i] = $userInfo[$i]['userNumber'];
            }
//            dd($sno);
            $studentInfo = StudentInfo::getBySnoAndIsInit($sno);

            $viewData = ['studentInfos' => $studentInfo];
            return Admin::content(function (Content $content) use ($viewData){
                // 选填
                $content->header($this->titles[0] ?? '管理后台');
                // 选填
                $content->description($this->titles[1] ?? '');
                // 填充页面body部分，这里可以填入任何可被渲染的对象
                $content->body(view('Admin.StudentInfo.init', $viewData));
            });
        }
    }

    public function init(Request $request)
    {
        $data = $request->all();
        if (array_key_exists('sno', $data)){
            $sno = $request->input('sno');

            //递交申请书
            $status_applicant_book = $request->input('status_applicant_book');

            //网上申请人党校学习
            $status_applicant_study = $request->input('status_applicant_study');
            //通过结业考试
            $status_applicant_exam_pass = $request->input('status_applicant_exam_pass');

            //参加申请人学习小组
            $status_applicant_group = $request->input('status_applicant_group');
            //党员推荐
            $status_party_member_recommendation = $request->input('status_party_member_recommendation');
            //团支部推优
            $status_mission_branch_recommendation = $request->input('status_mission_branch_recommendation');

            //递交季度思想汇报
            $status_thought_report_1 = $request->input('status_thought_report_1');
            $status_thought_report_2 = $request->input('status_thought_report_2');
            $status_thought_report_3 = $request->input('status_thought_report_3');
            $status_thought_report_4 = $request->input('status_thought_report_4');

            //经支委会同意成为积极分子
            $status_become_academy = $request->input('status_become_academy');
            //积极分子党校学习
            $status_academy_study = $request->input('status_academy_study');

            //发展对象 到 预备党员
            $status_development_target_to_probationary = $request->input('status_development_target_to_probationary');

            //完成预备党员结业考试
            $status_probationary_exam_pass = $request->input('status_probationary_exam_pass');

            //递交季度个人小结
            $status_personal_report = $request->input('status_personal_report');

            //参加党内活动
            $status_join_party_activity = $request->input('status_join_party_activity');

            //递交转正申请 到 成为正式党员
            $status_transform_to_official_member = $request->input('status_transform_to_official_member');

            $main_status = 0;//这是一个神一样的字段.....

            $haveDone = ''; //记录错误信息

            for ($j = 0; $j < count($sno); $j++){
                if ($sno[$j] != "" && strlen($sno[$j]) == 10){
                    //判断用户是否存在于student_info表中
                    $is_exist = StudentInfo::isExist($sno[$j]);
                    if ($is_exist){
                        //递交申请书
                        $this->partyApplicationService->setUserNumber($sno[$j]);
                        if ($status_applicant_book){
                            $this->partyApplicationService->to();
                        }
                        elseif (!$status_applicant_book){
                            $this->partyApplicationService->cancel();
                        }

                        //网上申请人党校学习
                        $this->applicantPartySchoolService->setUserNumber($sno[$j]);
                        if ($status_applicant_study){
                            $this->applicantPartySchoolService->to();
                        }
                        elseif(!$status_applicant_study){
                            $this->applicantPartySchoolService->cancel();
                        }

                        //网上申请人党校结业考试
                        if ($status_applicant_exam_pass){
                            $this->applicantPartySchoolService->to();
                        }
                        elseif(!$status_applicant_exam_pass){
                            $this->applicantPartySchoolService->cancel();
                        }// 申请人党校结业考试 结束

                        //递交季度思想汇报
                        $this->ideologicalReport_1Service->setUserNumber($sno[$j]);
                        $this->ideologicalReport_2Service->setUserNumber($sno[$j]);
                        $this->ideologicalReport_3Service->setUserNumber($sno[$j]);
                        $this->ideologicalReport_4Service->setUserNumber($sno[$j]);
                        //1
                        if ($status_thought_report_1){
                            $this->ideologicalReport_1Service->to();
                        }
                        elseif(!$status_thought_report_1){
                            $this->ideologicalReport_1Service->cancel();
                        }
                        //2
                        if ($status_thought_report_2){
                            $this->ideologicalReport_2Service->to();
                        }
                        elseif(!$status_thought_report_2){
                            $this->ideologicalReport_2Service->cancel();
                        }
                        //3
                        if ($status_thought_report_3){
                            $this->ideologicalReport_3Service->to();
                        }
                        elseif(!$status_thought_report_3){
                            $this->ideologicalReport_3Service->cancel();
                        }
                        //4
                        if ($status_thought_report_4){
                            $this->ideologicalReport_4Service->to();
                        }
                        elseif(!$status_thought_report_4){
                            $this->ideologicalReport_4Service->cancel();
                        }
                        // 递交季度思想汇报 结束

                        //分配学习小组..学习小组的名为1
                        $this->applicantLearningGroupService->setUserNumber($sno[$j]);
                        if ($status_applicant_group){
                            $this->applicantLearningGroupService->to();
                        }
                        elseif (!$status_applicant_group){
                            $this->applicantLearningGroupService->cancel();
                        }

                        //党员推荐
                        $this->memberRecommendationService->setUserNumber($sno[$j]);
                        if ($status_party_member_recommendation){
                            $this->memberRecommendationService->to();
                        }
                        elseif(!$status_party_member_recommendation){
                            $this->memberRecommendationService->cancel();
                        }

                        //团支部推优
                        $this->communistService->setUserNumber($sno[$j]);
                        if ($status_mission_branch_recommendation){
                            $this->communistService->to();
                        }
                        elseif (!$status_mission_branch_recommendation){
                            $this->communistService->cancel();
                        }


                        // 经支委会同意成为积极分子
                        $this->activityService->setUserNumber($sno[$j]);
                        if ($status_become_academy){
                            $this->activityService->to();
                        }
                        elseif (!$status_become_academy){
                            $this->activityService->cancel();
                        }

                        // 院级积极分子党校学习
                        $this->academyPartySchoolService->setUserNumber($sno[$j]);
                        if ($status_academy_study){
                            $this->academyPartySchoolService->to();
                        }
                        elseif(!$status_academy_study){
                            $this->academyPartySchoolService->cancel();
                        }
                    }
                }
            }
        }
        else{
            $viewData = [
                'title' => '提示信息',
                'message' => '您未选择学生信息'
            ];
            return Admin::content(function (Content $content) use ($viewData){
                // 选填
                $content->header($this->titles[0] ?? '管理后台');
                // 选填
                $content->description($this->titles[1] ?? '');
                // 填充页面body部分，这里可以填入任何可被渲染的对象
                $content->body(view('Admin.Message', $viewData));
            });
        }
    }

}