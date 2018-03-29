<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:17 AM
 */

namespace App\Http\Service;

use App\Models\Column;
use App\Models\CommonFiles;
use App\Models\Notification;

class ImportantFilesService{
    // 规章制度
    public function getRegulationFiles(){
        $data = CommonFiles::getFilesByTypeWithPage($type = CommonFiles::REGULAR_FILE, $perPage = 6);
        return $data;
    }

    // 常用文书
    public function getInstrumentFiles(){
        $data = CommonFiles::getFilesByTypeWithPage($type = CommonFiles::INSTRUMENT_FILE, $perPage = 6);
        return $data;
    }

    // 入党必读
    public function getMustReadFiles(){
        $data = CommonFiles::getFilesByTypeWithPage($type = CommonFiles::MUST_READ_FILE, $perPage = 6);
        return $data;
    }

    // 系统手册
    public function getManualFiles(){
        $data = CommonFiles::getFilesByTypeWithPage($type = CommonFiles::MANUAL_FILE, $perPage = 6);
        return $data;
    }
}