<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 2:08 PM
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Helpers\CodeAndMessage;
use App\Http\Service\ImportantFilesService;
use App\Http\Service\NewsService;
use App\Models\CommonFiles;
use App\Models\Notification;
use App\Models\SpecialNews;

/**
 * 重要文件栏目
 * Class FilesController
 * @package App\Http\Controllers\Front
 */
class FilesController extends FrontBaseController{
    protected $importantFilesService;

    public function __construct(ImportantFilesService $importantFilesService){
        parent::__construct();
        $this->importantFilesService = $importantFilesService;
    }


    public function regulation(){
        $files = $this->importantFilesService->getRegulationFiles();
        $data = [
            'files' => $files
        ];
//        dd($data);
//        return view('front.commonFiles.default', ['data' => $data, 'regulation' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    public function instrument(){
        $files = $this->importantFilesService->getInstrumentFiles();
        $data = [
            'files' => $files
        ];
//        return view('front.commonFiles.default', ['data' => $data, 'instrument' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    public function mustRead(){
        $files = $this->importantFilesService->getMustReadFiles();
        $data = [
            'files' => $files
        ];
//        return view('front.commonFiles.default', ['data' => $data, 'mustRead' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    public function manual(){
        $files = $this->importantFilesService->getManualFiles();
        $data = [
            'files' => $files
        ];
//        return view('front.commonFiles.default', ['data' => $data, 'manual' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    public function detail($id){
        $common_file = CommonFiles::getCommonFileById($id);
//        dd($common_file);
        if(!$common_file)
//            return $this->alertService->alertAndBack('提示', '文件不存在');
        {
            return response()->json([
                'code' => 1,
                'msg'  => CodeAndMessage::returnMsg(1, '文件不存在')
            ]);
        }
//        return view('front.commonFiles.detail', ['detail' => $common_file]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $common_file
        ]);
    }

}