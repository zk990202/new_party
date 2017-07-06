<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginCount;

class StatisticsController extends Controller
{
    /**
     * 登陆统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(){
        

        return view('Manager.Statistics.login');
    }
}
