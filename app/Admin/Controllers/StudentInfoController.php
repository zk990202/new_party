<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/5/1
 * Time: 13:34
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Helpers\Message;
use App\Http\Service\AdminMenuService;
use App\Models\Academy\EntryForm;
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

    public function __construct()
    {
        $this->imgExtension = config('fileUpload');
        $this->titles = AdminMenuService::getMenuName();
    }

    /**
     * 状态初始化--筛选学生
     * @return Content
     */
    public function initPreviewPage(){
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
    public function initPage(Request $request){
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

    public function init(Request $request){
        $data = $request->all();
        if (array_key_exists('sno', $data)){
            $sno = $request->input('sno');

            //对状态数据的提取方法很是特别...我分别对n个不同阶段的设置了不同的名称....
            $status_applicant_book = $request->input('status_applicant_book');//递交申请书

            $status_applicant_study = $request->input('status_applicant_study');//网上申请人党校学习
            $status_applicant_exam = $request->input('status_applicant_exam');//结业考试
            $status_applicant_exam_pass = $request->input('status_applicant_exam_pass');//通过结业考试

            $status_applicant_group = $request->input('status_applicant_group');//参加申请人学习小组
            $status_party_member_recommendation = $request->input('status_party_member_recommendation');//党员推荐
            $status_mission_branch_recommendation = $request->input('status_mission_branch_recommendation');//团支部推优

            $status_thought_report = $request->input('status_thought_report'); //递交季度思想汇报

            $status10 = $request->input('status_10');//网上申请人,结业考试,积极分子...
            $status20 = $request->input('status_20');//思想汇报
            $status31 = $request->input('status_31');//小组...
            $status32 = $request->input('status_32');//积极分子.....
            $status33 = $request->input('status_33');//推优...
            $status40 = $request->input('status_40');//发展对象到预备党员...
            $status51 = $request->input('status_51');//到预备党员...结业考试
            $status60 = $request->input('status_60');//到预备党员...个人小结
            $status71 = $request->input('status_71');//到预备党员...参加党内生活
            $status80 = $request->input('status_80');//到预备党员...转正到正式党员....

            $main_status = 0;//这是一个神一样的字段.....

            $time = date('Y-m-d H:i:s');
            $haveDone = ''; //记录错误信息
            $count_20 = 0;

            for ($j = 0; $j < count($sno); $j++){
                if ($sno[$j] != "" && strlen($sno[$j]) == 10){
                    //判断用户是否存在于student_info表中
                    $is_exist = StudentInfo::isExist($sno[$j]);
                    if ($is_exist){

                        //递交申请书
                        if ($status_applicant_book){
                            //如果有,则写申请书
                            $flag = StudentFiles::insertApplicantBookInStudentInfoInit($sno[$j]);

                            if (!$flag){
                                $haveDone = " $sno[$j] 向数据库中插入一份申请书.........失败!<br> ";
                            }
                        }// 申请书 结束

                        //网上申请人党校学习
                        if ($status_applicant_study && $status_applicant_book){
                            //假如该同学已经学习过了,那么现在就把他课程成绩清空
                            $clear = ScoresTwenty::clear($sno[$j]);
                            $course_20_id = array(41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60);
                            //补上新的20课成绩
                            for ($i = 0; $i < 20; $i++){
                                $flag = ScoresTwenty::insert20scoreInStudentInfoInit($sno[$j], $course_20_id[$i]);
                            }
                            //还要更新一下student_info表中的信息
                            $flag = StudentInfo::updateIsPass20ToTrueInStudentInfoInit($sno[$j]);
                            if (!$flag){
                                $haveDone .= "$sno[$j] 将信息更新到学生信息表中.......失败!<br>";
                            }
                        } // 申请人党校学习 结束

                        //网上申请人党校结业考试
                        if ($status_applicant_study && $status_applicant_book && $status_applicant_exam){
                            //补上结业成绩
                            $flag = EntryForm::systemAddInStudentInfoInit($sno[$j]);
                            if ($flag){
                                $entry_id = $flag['id'];
                                //这里是要添加申请人结业证书
                                $flag_1 = Cert::systemAddCertInStudentInfoInit($sno[$j], $entry_id, $j);
                                if (!$flag_1){
                                    $haveDone .= "$sno[$j] 向数据库中插入申请人结业证书.....失败!<br>";
                                }
                            }else{
                                $haveDone .= "$sno[$j] 向数据库中插入申请人结业考试成绩.....失败!<br>";
                            }
                        } // 申请人党校结业考试 结束

                        //网上申请人党校 通过 结业考试    md还不知道这个需求跟上一个的区别在哪。。。。

                        //递交季度思想汇报
                        if ($status_thought_report && $status_applicant_book){
                            $count_thought_report = count($status_thought_report);
                            $flag = StudentInfo::updateThoughtReportInStudentInfoInit($sno[$j], $count_thought_report);
                            if (!$flag){
                                $haveDone .= "$sno[$j] 将信息更新到学生信息表中.......失败!<br>";
                            }
                            dd($flag);
                        }


                    }else{
                        $viewData = [
                            'title' => '提示信息',
                            'message' => " $sno[$j] 学生信息的信息不在学生表中"
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
        }else{
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