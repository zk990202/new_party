<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 2:08 PM
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Service\ImportantFilesService;
use App\Http\Service\NewsService;
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
        return view('front.commonFiles.default', ['data' => $data, 'regulation' => 'nav1']);
    }

    public function instrument(){
        $files = $this->importantFilesService->getInstrumentFiles();
        $data = [
            'files' => $files
        ];
        return view('front.commonFiles.default', ['data' => $data, 'instrument' => 'nav1']);
    }

    public function mustRead(){
        $files = $this->importantFilesService->getMustReadFiles();
        $data = [
            'files' => $files
        ];
        return view('front.commonFiles.default', ['data' => $data, 'mustRead' => 'nav1']);
    }

    public function manual(){
        $files = $this->importantFilesService->getManualFiles();
        $data = [
            'files' => $files
        ];
        return view('front.commonFiles.default', ['data' => $data, 'manual' => 'nav1']);
    }

}