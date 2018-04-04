<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\StudentFiles;

class VolunteerBook extends BaseWorkItem{

    public function to()
    {
        if($this->isActive())
            return;
        parent::to();
        StudentFiles::create([
            'sno' => $this->userNumber,
            'file_title' => '系统添加',
            'file_content' => '系统添加,并设置为通过状态!',
            'file_addtime' => date('Y-m-d H:i:s'),
            'file_dealtime' => date('Y-m-d H:i:s'),
            'file_type' => StudentFiles::FILE_TYPE['VOLUNTEER_BOOK'],
            'file_status' => StudentFiles::FILE_STATUS['QUALIFIED'],
            'is_systemadd' => 1
        ]);
    }

    public function cancel()
    {
        if(! $this->isActive())
            return;
        parent::cancel();

        if($this->isActive()){
            StudentFiles::where(['sno' => $this->userNumber, 'file_type' => StudentFiles::FILE_TYPE['VOLUNTEER_BOOK']])
                ->update(['file_status' => StudentFiles::FILE_STATUS['UNPROCESSED']]);
        }
    }

    public function isActive()
    {
        $file = StudentFiles::getStudentFiles($this->userNumber, $type = [StudentFiles::FILE_TYPE['VOLUNTEER_BOOK']], $status = [StudentFiles::FILE_STATUS['QUALIFIED'], StudentFiles::FILE_STATUS['EXCELLENT']]);
        return boolval($file);
    }
}