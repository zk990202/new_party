<?php
/**
 * 网上党校--院级积极分子培训
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/12/10
 * Time: 20:29
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontBaseController;
use App\Http\Service\HomeService;

//首页
class HomeController extends FrontBaseController{
    protected $homeService;
    public $module;
    public function __construct(HomeService $homeService)
    {
        parent::__construct();
        $this->homeService = $homeService;
    }

    //首页最新通知板块
    public function index(){
        $data = $this->homeService->data();

        return view('front.index', ['data' => $data]);
    }
}