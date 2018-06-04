<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:16 AM
 */
namespace App\Http\Controllers\Front;


use App\Http\Controllers\FrontBaseController;
use App\Http\Service\NotificationService;
use App\Http\Service\ProbationaryService;
use App\Models\Cert;
use App\Models\Notification;
use App\Models\Probationary\ChildEntryForm;
use App\Models\Probationary\CourseList;
use App\Models\Probationary\EntryForm;
use Illuminate\Http\Request;

class ProbationaryController extends FrontBaseController{
    protected $probationaryService;
    protected $notificationService;
    public $module;
    public function __construct()
    {
        parent::__construct();
        $this->probationaryService = new ProbationaryService();
        $this->notificationService = new NotificationService();
        $this->module = 'probationary';
    }

    /**
     * 党校公告
     */
    public function notice(){
        $notices = $this->notificationService->getProbationaryNotification();
        return view('front.probationary.noticeList', ['list' => $notices]);
    }

    /**
     * 党校公告详情
     * @param $id
     * @return mixed
     */
    public function noticeDetail($id){
        $notice = Notification::getNoticeById($id);
        if(!$notice)
            return $this->alertService->alertAndBack('提示', '通知不存在');
        return view('front.probationary.noticeDetail', ['detail' => $notice]);
    }


    /**
     * 报名界面
     */
    public function signUpPage(){
        $user = $this->userService->getCurrentUser();
        $can = $this->probationaryService->canEntryTest($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);
        $data = [
            'user' => $user,
            'test' => $can['test'],
        ];
        return view('front.probationary.signUp', ['data' => $data]);
    }

    public function signUp(){
        $user = $this->userService->getCurrentUser();
        $can = $this->probationaryService->canEntryTest($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);
        $form = EntryForm::create([
            'sno'	=>	$user['userNumber'],
            'train_id'	=>	$can['test']['id'],
        ]);
        if(! $form){
            return $this->alertService->alertAndBackWithError('遇到了一个错误');
        }
        return $this->alertService->alertAndBackWithSuccess('报名成功，现在就去选课吧', $url = url('probationary/signResult'));
    }

    public function signUpResult(){
        $user = $this->userService->getCurrentUser();
        $entryForm = EntryForm::getSignResult($user['userNumber']);

        if(!$entryForm)
            return $this->alertService->alertAndBack('提示', '您没有报名考试');

        \App\Models\Applicant\EntryForm::warpStatus($entryForm);
        EntryForm::warpStatus($entryForm);
        $data = [
            'user' => $user,
            'form' => $entryForm
        ];
        //dd($entryForm);
        return view('front.probationary.signUpResult', ['data' => $data]);
    }

    public function signExit(){

    }

    public function courseChoosePage(){
        $user = $this->userService->getCurrentUser();
        // determine whether the user has entered the active train
        $can = $this->probationaryService->canChooseCourse($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);

        // 获取课程列表，把已选课程放到后面
        $courseList = CourseList::getByTrainId($can['test']['id']);
        $chosen = [];
        $full = [];
        foreach($courseList as $i => &$v){
            CourseList::warpType($v);
            // get number of people have chosen the course
            $count = ChildEntryForm::getCountByCourseId($v['id']);
            $v['count'] = $count;
            // has chosen
            if(ChildEntryForm::courseHasChosen($user['userNumber'], $v['id'])){
                $v['chooseStatus'] = 1;
                $v['chooseStatusMsg'] = '已选';
                $chosen[] = $v;
                unset($courseList[$i]);
            }
            // full of people
            else if($v['limitNum'] > 0 && $count >= $v['limitNum']){
                $v['chooseStatus'] = 2;
                $v['chooseStatusMsg'] = '满员';
                $full[] = $v;
                unset($courseList[$i]);
            }
            else{
                $v['chooseStatus'] = 0;
                $v['chooseStatusMsg'] = '可选';
            }
        }
        $courseList = array_merge(array_merge($courseList, $full), $chosen);
        //dd($courseList);
        return view('front.probationary.courseList', ['list' => $courseList, 'trainName' => $can['test']['name']]);

    }

    /**
     * 选课操作，上一期如果报名，且没有退出，通过的课程算这次的通过课程
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function courseChoose(Request $request){
        $user = $this->userService->getCurrentUser();
        // determine whether the user has entered the active train
        $can = $this->probationaryService->canChooseCourse($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);

        $data = $request->only(['course_id']);
        if(count($data) != 1 || count($data['course_id']) < 1){
            return $this->alertService->alertAndBackWithError('没有选课，参数丢失');
        }

        $selectedCourses = ChildEntryForm::getSelectedCourses($user['userNumber'], $can['entry']['id']);
        $countOfRequiredClass = 0;
        $countOfElectiveClass = 0;
        $selectedIds = [];
        foreach($selectedCourses as $v){
            $selectedIds[] = $v['id'];
            //
            if($v['courseType'] == 0)
                $countOfRequiredClass ++;
            else
                $countOfElectiveClass ++;
        }
        //dd($countOfRequiredClass);
        // 已经选满
        if($countOfRequiredClass >= $this->probationaryService::NUM_REQUIRED_COURSE && $countOfElectiveClass >= $this->probationaryService::NUM_ELECTIVE_COURSE)
            return $this->alertService->alertAndBack('提示', '您已经选择了三门必修课与一门选修课，无法选择更多的课程，如需选择，请先退课');

        $successCourse = [];
        foreach($data['course_id'] as $v){
            // 表示已经选了这门课
            if(in_array($v, $selectedIds))
                continue;
            // 已经选满
            if($countOfElectiveClass >= $this->probationaryService::NUM_REQUIRED_COURSE && $countOfElectiveClass >= $this->probationaryService::NUM_ELECTIVE_COURSE)
                break;
            $course = CourseList::getCourseById($v);
            if(!$course)
                continue;
            if($course['type'] == 0 && $countOfRequiredClass >= $this->probationaryService::NUM_REQUIRED_COURSE)
                continue;
            if($course['type'] == 1 && $countOfElectiveClass >= $this->probationaryService::NUM_ELECTIVE_COURSE)
                continue;
            $flag = ChildEntryForm::create([
                'child_entryid' => $can['entry']['id'],
                'child_sno' => $user['userNumber'],
                'child_courseid' => $v,
            ]);
            if($flag){
                $successCourse[] = $course['name'];
                if($course['type'] == 0)
                    $countOfRequiredClass ++;
                else
                    $countOfElectiveClass ++;
            }
        }
        return $this->alertService->alertAndBackWithSuccess('【'.implode("】，【", $successCourse) . "】 选课成功", url('probationary/studyList'));
    }

    /**
     * 我的课表
     * 选课允许接着上一期来
     */
    public function courseChooseResult(){
        $user = $this->userService->getCurrentUser();
        // determine whether the user has entered the active train
        $can = $this->probationaryService->canChooseCourse($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);
        $selectedCourses = ChildEntryForm::getSelectedCourses($user['userNumber'], $can['entry']['id']);
        foreach($selectedCourses as & $v){
            CourseList::warpType($v);
        }
        // 预备党员党校允许接着上一期通过的课程接着上，所以要获取上一期已经通过的课程数
        $preEntryForm = $this->probationaryService->getPreEntryForm($user['userNumber'], $can['test']['id']);
        $preCourses = ChildEntryForm::getSelectedCourses($user['userNumber'], $preEntryForm['id']);
        if($preEntryForm){
            $can['entry']['passCompulsory'] = intval($can['entry']['passCompulsory']) + intval($preEntryForm['passCompulsory']);
            $can['entry']['passElective'] = intval($can['entry']['passElective']) + intval($preEntryForm['passCompulsory']);
        }
        $data = [
            'list' => [
                'cur' => $selectedCourses,
                'pre' => $preCourses
            ],
            'info' => [
                $can['test']['name'],
                $can['entry']['passCompulsory'], // 已过必修课
                $this->probationaryService::NUM_REQUIRED_COURSE,
                $can['entry']['passElective'], // 已过选修课
                $this->probationaryService::NUM_ELECTIVE_COURSE,
                $can['entry']['practiceGrade'],
                $can['entry']['articleGrade'],
                $preEntryForm ? '是' : '否',
                $can['entry']['exitCount']
            ]
        ];
        //dd($can);
        //dd($selectedCourses);
        return view('front.probationary.courseListResult', ['data' => $data]);
    }

    public function courseExit($id){
        $user = $this->userService->getCurrentUser();
        $course = ChildEntryForm::getCourseById($id);
        if(!$course)
            return $this->alertService->alertAndBackWithError('课程不存在');
        if($course['sno'] != $user['userNumber'])
            return $this->alertService->alertAndBackWithError('没有权限');
        //dd($course);
        $flag = ChildEntryForm::courseExit($id) && EntryForm::accumulationExitCount($course['childId'], $user['userNumber']);
        if(! $flag)
            return $this->alertService->alertAndBackWithError('系统错误');

        return $this->alertService->alertAndBackWithSuccess('退课成功');
    }

    /**
     * 成绩查询界面
     */
    public function grade(){
        $user = $this->userService->getCurrentUser();
        $entryList = EntryForm::gradeCheck($user['userNumber']);
        foreach ($entryList as $v){
            EntryForm::warpStatus($v);
            \App\Models\Applicant\EntryForm::warpStatus($v);
            EntryForm::warpIsPassed($v);
        }
        $data = [
            'user' => $user,
            'list' => $entryList
        ];
        //dd($entryList);
        return view('front.probationary.grade', ['data' => $data]);
    }

    /**
     * 证书查询
     */
    public function certificate(){
        $user = $this->userService->getCurrentUser();
        $entry = EntryForm::certGetEntry($user['userNumber']);
        if (!$entry){
            return $this->alertService->alertAndBack('提示：没有证书结果', '如果你没有参加过或者未通过院级积极
            分子结业考试,或者通过,但是结业证书还未发放,这些情况您都无法看到自己的证书.如果长时间查看不到自己的结业证书而[成绩查询]
            中显示您的考试状态为通过.那么请联系管理员核实并解决此问题.');
        }
        else{
            $entry_id = $entry[0]['id'];
            $cert = Cert::certCheckAcademy($entry_id);
            if (!$cert){
                return $this->alertService->alertAndBackWithError('不好意思,没有找到相应的证书,请联系管理员!');
            }
            else{
                return view('front.probationary.certificate', ['cert' => $cert]);
            }
        }
    }
    
}