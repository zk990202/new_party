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

class AcademyController extends FrontBaseController {
    protected $academyService;

    public $module;

    public function __construct(AcademyService $academyService)
    {
        parent::__construct();
        $this->academyService = $academyService;
    }

    /**
     * 积极分子课程设置
     */
    public function courseStudy(){
        // TODO
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