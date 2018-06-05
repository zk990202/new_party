<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/6/4
 * Time: 10:23
 */

namespace App\Http\Controllers\Front;


use App\Http\Controllers\FrontBaseController;
use App\Models\CommonFiles;

class TheoryStudyController extends FrontBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function lists(){
        $result = CommonFiles::getTheoryStudyFilesWithPage($perPage = 5);
        return view('front.theoryStudy.lists', ['result' => $result]);
    }

    public function detail($id){
        $detail = CommonFiles::getCommonFileById($id);
        return view('front.theoryStudy.detail', ['detail' => $detail]);
    }
}