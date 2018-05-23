<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/5/23
 * Time: 22:01
 */

namespace App\Http\Controllers\Front;


use App\Http\Controllers\FrontBaseController;

class FileDownloadController extends FrontBaseController
{
    public function download($file, $name){
        $file = realpath(public_path('upload')). '/' . $file;
        if(file_exists($file))
            return response()->download($file, $name);
        else
            return $this->alertService->alertAndBack('提示', '文件不存在');
    }
}