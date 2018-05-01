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
use App\Models\Classes;
use App\Models\College;
use App\Models\Control;
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
    public function statusResetPreviewPage(){
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
                $content->body(view('Admin.StudentInfo.StatusResetPreview', $viewData));
            });
        }
    }

    /**
     * 状态初始化--选择学生和状态
     * @param Request $request
     * @return Content
     */
    public function statusResetPage(Request $request){
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
                $content->body(view('Admin.StudentInfo.StatusReset', $viewData));
            });
        }
    }

    public function statusReset(Request $request){
        $data = $request->all();
        if (array_key_exists('sno', $data)){
            $sno = $request->input('sno');


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