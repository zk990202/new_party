<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:16 AM
 */
namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Service\ApplicantService;

class ApplicantController extends FrontBaseController{
    protected $applicantService;
    public $module;
    public function __construct(ApplicantService $applicantService)
    {
        parent::__construct();
        $this->applicantService = $applicantService;
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
     * 申请人党校报名界面
     */
    public function signUp(){
         // TODO
    }

    /**
     * 报名结果界面
     */
    public function signUpResult(){
        // TODO
    }

    /**
     * 成绩查询界面
     */
    public function grade(){
        // TODO
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