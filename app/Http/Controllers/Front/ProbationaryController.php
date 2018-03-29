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
use App\Http\Service\ProbationaryService;

class ProbationaryController extends FrontBaseController{
    protected $probationaryService;
    public $module;
    public function __construct(ProbationaryService $probationaryService)
    {
        parent::__construct();
        $this->probationaryService = $probationaryService;
        $this->module = 'probationary';
    }

    /**
     * 党校公告
     */
    public function notice(){
        // TODO
    }

    /**
     * 报名界面
     */
    public function signUp(){
         // TODO
    }

    /**
     * 我的课表
     */
    public function studyList(){
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