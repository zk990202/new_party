<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/5/1
 * Time: 13:34
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Service\AdminMenuService;
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

class StudentInfoOldController extends Controller
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
//        $status = 1;
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

    /**
     * 真正初始化
     * @param Request $request
     * @return Content
     */
    public function init(Request $request){
        $data = $request->all();
        if (array_key_exists('sno', $data)){
            $sno = $request->input('sno');

            //对状态数据的提取方法很是特别...我分别对n个不同阶段的设置了不同的名称....
            $status_applicant_book = $request->input('status_applicant_book');//递交申请书

            $status_applicant_study = $request->input('status_applicant_study');//网上申请人党校学习
//            $status_applicant_exam = $request->input('status_applicant_exam');//结业考试
            $status_applicant_exam_pass = $request->input('status_applicant_exam_pass');//通过结业考试

            $status_applicant_group = $request->input('status_applicant_group');//参加申请人学习小组
            $status_party_member_recommendation = $request->input('status_party_member_recommendation');//党员推荐
            $status_mission_branch_recommendation = $request->input('status_mission_branch_recommendation');//团支部推优

            $status_thought_report = $request->input('status_thought_report'); //递交季度思想汇报

            $status_become_academy = $request->input('status_become_academy'); //经支委会同意成为积极分子
            $status_academy_study = $request->input('status_academy_study'); //积极分子党校学习

            $status_development_target_to_probationary = $request->input('status_development_target_to_probationary'); //发展对象 到 预备党员

            $status_probationary_exam_pass = $request->input('status_probationary_exam_pass'); //完成预备党员结业考试

            $status_personal_report = $request->input('status_personal_report'); //递交季度个人小结

            $status_join_party_activity = $request->input('status_join_party_activity'); //参加党内活动

            $status_transform_to_official_member = $request->input('status_transform_to_official_member'); //递交转正申请 到 成为正式党员

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
                        if ($status_applicant_study && $status_applicant_book && $status_applicant_exam_pass){
                            //补上结业成绩
                            $flag = EntryForm::systemAddInStudentInfoInit($sno[$j]);
                            if ($flag){
                                $entry_id = $flag['id'];
                                //这里是要添加申请人结业证书
                                $flag_1 = Cert::systemAddCertInStudentInfoInit($sno[$j], $entry_id, $j, 1);
                                if (!$flag_1){
                                    $haveDone .= "$sno[$j] 向数据库中插入申请人结业证书.....失败!<br>";
                                }
                            }else{
                                $haveDone .= "$sno[$j] 向数据库中插入申请人结业考试成绩.....失败!<br>";
                            }
                        } // 申请人党校结业考试 结束


                        //递交季度思想汇报
                        if ($status_thought_report && $status_applicant_book){
                            $count_thought_report = count($status_thought_report);
                            $flag = StudentInfo::updateThoughtReportInStudentInfoInit($sno[$j], $count_thought_report);
                            if (!$flag){
                                $haveDone .= "$sno[$j] 将信息更新到学生信息表中.......失败! <br>";
                            }
                        } // 递交季度思想汇报 结束

                        //分配学习小组..学习小组的名为1
                        if ($status_applicant_group && $status_applicant_book){
                            $flag = StudentInfo::updateApplicantGroupInStudentInfoInit($sno[$j]);
                            if (!$flag){
                                $haveDone .= "$sno[$j] 为该学生分配学习小组......失败! <br>";
                            }
                            //党员推荐
                            if ($status_party_member_recommendation){
                                $main_status = 20;
                            }
                            //团支部推优
                            if ($status_mission_branch_recommendation){
                                $main_status = 2;
                            }
                            //党员推荐+团支部推优
                            if ($status_party_member_recommendation && $status_mission_branch_recommendation){
                                $main_status = 220;
                            }
                        } // 分配学习小组 结束

                        // 经支委会同意成为积极分子
                        if ($status_become_academy && $main_status == 220 && $status_applicant_book){
                            $main_status = 1;
                            // 院级积极分子党校学习
                            if ($status_academy_study){
                                $flag = \App\Models\Academy\EntryForm::systemAddInStudentInfoInit($sno[$j]);
                                if ($flag){
                                    $entry_id = $flag['id'];
                                    //把院级的结业证书发放一下
                                    $flag_1 = Cert::systemAddCertInStudentInfoInit($sno[$j], $entry_id, $j, 2);
                                    if (!$flag_1){
                                        $haveDone .= "$sno[$j] 向数据库中插入院级积极分子结业证书.....失败!<br>";
                                    }
                                }else{
                                    $haveDone .= "$sno[$j] 向数据库中插入院级结业考试成绩......失败!<br>";
                                }
                            }
                        }

                        //发展对象到预备党员
                        if ($status_development_target_to_probationary && $main_status == 1){
                            $count_status_development_target_to_probationary = count($status_development_target_to_probationary);
                            //发展对象 到 党员发展公示
                            if ($count_status_development_target_to_probationary >= 1 && $count_status_development_target_to_probationary <= 5){
                                $main_status = $count_status_development_target_to_probationary + 2;
                            }
                            if ($count_status_development_target_to_probationary >= 6){
                                $main_status = 7; //入党志愿书
                                $flag = StudentFiles::insertVolunteerBookInStudentInfoInit($sno[$j]);
                                if (!$flag){
                                    $haveDone .= "$sno[$j] 向数据库中插入党志愿书........失败!<br>";
                                }
                            }
                            //召开发展大会，党支部表决通过 到 预备党员
                            if ($count_status_development_target_to_probationary >= 7){
                                $main_status = $count_status_development_target_to_probationary + 1;
                            }

                        }

                        //完成预备党党校学习
                        if ($status_probationary_exam_pass && $main_status == 10){
                            $flag = \App\Models\Probationary\EntryForm::systemAddInStudentInfoInit($sno[$j]);
                            if ($flag){
                                $entry_id = $flag['id'];
                                //添加预备党结业考试证书
                                $flag_1 = Cert::systemAddCertInStudentInfoInit($sno[$j], $entry_id, $j, 3);
                                if (!$flag_1){
                                    $haveDone .= "$sno[$j] 向数据库中插入预备党员结业证书.....失败!<br>";
                                }
                            }else{
                                $haveDone .= "$sno[$j] 向数据库中插入预备党员结业考试成绩.....失败!<br>";
                            }
                        }

                        //递交季度个人小结
                        $count_personal_report = 0;
                        if ($status_personal_report && $main_status == 10){
                            $count_personal_report = count($status_personal_report);
                            $flag = StudentInfo::updatePersonalReportInStudentInfoInit($sno[$j], $count_personal_report+5);
                            if (!$flag){
                                $haveDone .= "$sno[$j] 将信息更新到学生信息表中.......失败!<br>";
                            }
                        }

                        //参加党内活动
                        if ($status_join_party_activity && $main_status == 10){
                            $main_status = 11;
                        }

                        //递交转正申请 到 成为正式党员
                        if ($status_transform_to_official_member && $status_probationary_exam_pass && $count_personal_report >= 4 && $main_status == 11){
                            $count_transform_to_official_member = count($status_transform_to_official_member);
                            //转正申请
                            if ($count_transform_to_official_member >= 1){
                                $flag = StudentFiles::insertTransFormBookInStudentInfoInit($sno[$j]);
                                if (!$flag){
                                    $haveDone .= "$sno[$j] 向数据库中插入转正申请......失败!<br>";
                                }
                            }
                            //党员转正公示 到 成为正式党员
                            if ($count_transform_to_official_member >= 2){
                                $main_status = $count_transform_to_official_member + 10;
                            }
                        }

                        //下面要根据main_status来更新数据库
                        $flag_0 = StudentInfo::updateMainStatusTo($sno[$j], $main_status);
                        if (!$flag_0){
                            $haveDone .= "$sno[$j] 将信息更新到学生信息表中.......失败!<br>";
                        }

                        //在这里,我非常想说一句,我操啊.....这么多流程,就冲这一点就知道共产党有多坑爹了
                        // ----来自我之前的写党建的学长的真诚吐槽
                        // 我只能说：：学长说得太tm有道理了

                        if ($haveDone){
                            $viewData = [
                                'title' => '提示信息:操作已经结束,但是有一些错误',
                                'message' => $haveDone
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
                            $viewData = [
                                'title' => '提示信息',
                                'message' => '操作成功，没有错误'
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