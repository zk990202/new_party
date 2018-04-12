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
use App\Models\Academy\TestList;

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

}