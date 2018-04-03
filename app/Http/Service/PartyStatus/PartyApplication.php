<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\StudentFiles;

// 入党申请书状态
class PartyApplication extends BaseWorkItem{

    public function to()
    {
        parent::to();
        if(!$this->isActive()){
            StudentFiles::create([
                'sno' => $this->userNumber,
                'file_title' => '系统添加',
                'file_content' => '系统添加,并设置为通过状态!',
                'file_addtime' => date('Y-m-d H:i:s'),
                'file_dealtime' => date('Y-m-d H:i:s'),
                'file_type' => 1,
                'file_status' => 1,
                'is_systemadd' => 1
            ]);
        }
    }

    public function cancel()
    {
        parent::cancel();
        if($this->isActive()){
            StudentFiles::where(['sno' => $this->userNumber, 'file_type' => 1])
                ->update(['file_status' => 0]);
        }
        // TODO: Implement cancel() method.
    }

    public function isActive()
    {
        // 是否提交入党申请书
        $file = StudentFiles::getStudentFiles($this->userNumber, $type = [StudentFiles::FILE_TYPE['APPLICANT']], $status = [StudentFiles::FILE_STATUS['QUALIFIED'], StudentFiles::FILE_STATUS['EXCELLENT']]);
        return boolval($file);
    }
}