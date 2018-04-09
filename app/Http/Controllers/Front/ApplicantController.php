<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:16 AM
 */
namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Service\AlertService;
use App\Http\Service\ApplicantService;
use App\Models\Applicant\ArticleList;
use App\Models\Applicant\EntryForm;
use App\Models\Applicant\TestList;
use App\Models\StudentInfo;
use Illuminate\Http\Request;

class ApplicantController extends FrontBaseController{
    protected $applicantService;

    public $module;
    public function __construct()
    {
        parent::__construct();
        $this->applicantService = new ApplicantService();
    }

    /**
     * 20课学习列表
     */
    public function courseStudy(){
        // 20 课列表
        $courseList = $this->applicantService->courseList(true);
        $data = [
            'courseList' => $courseList
        ];
        return view('front.applicant.courseList', ['data' => $data]);
    }

    /**
     * 20课详情
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function courseDetail($id){
        $course = $this->applicantService->getCourseById($id);
        if(!$course){
            return $this->alertService->alertAndBackByConfig([
                'type'    => AlertService::ALERT_TYPE['ERROR'],
                'title'   => '错误',
                'content' => '课程不存在'
            ]);
        }
        $articles = ArticleList::getArticleByCourseId($id);
        $data = [
            'articles' => $articles,
            'course'   => $course
        ];
        return view('front.applicant.courseDetail', ['data' => $data]);
    }

    /**
     * 申请人党校报名界面
     */
    public function signUpPage(){
        $user = $this->userService->getCurrentUser();

        $can = $this->applicantService->canEntryTest($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);

        $data = [
            'user' => $user,
            'test' => $can['test'],
        ];
        return view('front.applicant.signUp', ['data' => $data]);
    }

    public function signUp(Request $request){
        $data = $request->only(['school']);
        if(count($data) != 1){
            return $this->alertService->alertAndBack('提示', '请选择考试校区');
        }

        $user = $this->userService->getCurrentUser();
        $can = $this->applicantService->canEntryTest($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);

        $form = EntryForm::create([
            'sno'	=>	$user['userNumber'],
            'test_id'	=>	$can['test']['id'],
            'entry_time'	=>	date("Y-m-d H:i:s"),
            'campus'    => $data['school'] == 'new' ? '新校区' : '老校区'
        ]);
        if(! $form){
            return $this->alertService->alertAndBackWithError('遇到了一个错误');
        }
        alert()->success('报名成功', '请查看报名结果以确保报名信息无误');
        return redirect(url('applicant/signResult'));
    }

    /**
     * 报名结果界面
     */
    public function signUpResult(){
        $user = $this->userService->getCurrentUser();

        $entryForm = EntryForm::getSignResult($user['userNumber']);

        if(!$entryForm)
            return $this->alertService->alertAndBack('提示', '您没有报名考试');
        $entryForm = $entryForm[0];
        TestList::warpStatus($entryForm);
        EntryForm::warpStatus($entryForm);
        //dd($entryForm);
        $data = [
            'user' => $user,
            'form' => $entryForm
        ];

        return view('front.applicant.signUpResult', ['data' => $data]);
    }

    /**
     * 退出报名
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signExit(){
        $user = $this->userService->getCurrentUser();
        $entryForm = EntryForm::getSignResult($user['userNumber']);
        if(!$entryForm)
            return $this->alertService->alertAndBack('提示', '您没有报名考试');
        $entryForm = $entryForm[0];
        if($entryForm['isExit'])
            return $this->alertService->alertAndBack('提示', '您已经退出考试了！');

        $flag = EntryForm::exitEntryByUserNumber($user['userNumber'], $entryForm['id']);

        if(!$flag)
            return $this->alertService->alertAndBackWithError('遇到了一个错误');
        return $this->alertService->alertAndBackWithSuccess('退出成功');
    }

    /**
     * 成绩查询界面
     */
    public function grade(){
        $user = $this->userService->getCurrentUser();

        $entryList = EntryForm::gradeCheck($user['userNumber']);
        foreach($entryList as &$v){
            TestList::warpStatus($v);
            EntryForm::warpStatus($v);
            EntryForm::warpIsPassed($v);
        }
        $data = [
            'user' => $user,
            'list' => $entryList
        ];
        //dd($entryList);
        return view('front.applicant.grade', ['data' => $data]);
    }

    /**
     * 证书查询
     */
    public function ca(){
        // TODO
    }

    /**
     * 账号状态
     */
    public function userStatus(){
        // TODO
    }
}