<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:16 AM
 */
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontBaseController;
use App\Http\Service\AcademyService;
use App\Http\Service\ApplicantService;
use App\Models\Academy\EntryForm;
use App\Models\Academy\TestList;
use http\Env\Request;

class AcademyController extends FrontBaseController {
    protected $academyService;

    public $module;

    public function __construct(AcademyService $academyService)
    {
        parent::__construct();
        $this->academyService = $academyService;
    }

    /**
     * 积极分子课程显示界面
     */
    public function courseStudy(){
        $user = $this->userService->getCurrentUser();
        $collegeId = $user['collegeId'];

        $list = TestList::getListByCollegeIdWithPage($collegeId, $numPerPage = 6);

        return view('front.academy.courseList', ['list' => $list]);
    }

    public function courseDetail($id){
        $detail = TestList::getTestById($id);
        if(!$detail)
            return $this->alertService->alertAndBackWithError("课程不存在");

        return view('front.academy.courseDetail', ['detail' => $detail]);
    }

    /**
     * 报名界面
     */
    public function signUpPage(){
        $user = $this->userService->getCurrentUser();

        $can = $this->academyService->canEntryTest($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);
        $data = [
            'user' => $user,
            'test' => $can['test'],
        ];
        return view('front.academy.signUp', ['data' => $data]);
    }


    /**
     * 报名
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function signUp(){
        $user = $this->userService->getCurrentUser();
        $can = $this->academyService->canEntryTest($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);
        $form = EntryForm::create([
            'sno'	=>	$user['userNumber'],
            'test_id'	=>	$can['test']['id'],
        ]);
        if(! $form){
            return $this->alertService->alertAndBackWithError('遇到了一个错误');
        }
        return $this->alertService->alertAndBackWithSuccess('请查看报名结果以确保报名信息无误', $url = url('academy/signResult'));
    }

    /**
     * 报名结果界面
     */
    public function signUpResult(){
        $user = $this->userService->getCurrentUser();
        $entryForm = EntryForm::getSignResult($user['userNumber']);

        if(!$entryForm)
            return $this->alertService->alertAndBack('提示', '您没有报名考试');

        // 都是一样的逻辑，两种模型的 status 共用一套本地化方案
        \App\Models\Applicant\TestList::warpStatus($entryForm);
        \App\Models\Applicant\EntryForm::warpStatus($entryForm);
        $data = [
            'user' => $user,
            'form' => $entryForm
        ];
        return view('front.academy.signUpResult', ['data' => $data]);
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
            \App\Models\Applicant\TestList::warpStatus($v);
            \App\Models\Applicant\EntryForm::warpStatus($v);
            \App\Models\Applicant\EntryForm::warpIsPassed($v);
        }
        $data = [
            'user' => $user,
            'list' => $entryList
        ];
        //dd($entryList);
        return view('front.academy.grade', ['data' => $data]);
    }

    /**
     * 证书查询
     */
    public function ca(){
        // TODO
    }

}