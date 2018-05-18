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
        if($this->isActive())
            return false;
        parent::to();
        $res = StudentFiles::create([
            'sno' => $this->userNumber,
            'file_title' => '系统添加',
            'file_content' => '这是后台管理员在为你做系统初始化时添加的申请书,状态为通过!',
            'file_addtime' => date('Y-m-d H:i:s'),
            'file_dealtime' => date('Y-m-d H:i:s'),
            'file_type' => StudentFiles::FILE_TYPE['APPLICANT'],
            'file_status' => StudentFiles::FILE_STATUS['QUALIFIED'],
            'is_systemadd' => 1
        ]);
        return boolval($res);
    }

    public function cancel()
    {
        if(!$this->isActive())
            return false;
        parent::cancel();
        $res = StudentFiles::where(['sno' => $this->userNumber, 'file_type' => StudentFiles::FILE_TYPE['APPLICANT']])
            ->update(['file_status' => StudentFiles::FILE_STATUS['UNPROCESSED']]);
        return boolval($res);
    }

    public function isActive()
    {
        // 是否提交入党申请书
        $file = StudentFiles::getStudentFiles($this->userNumber, $type = [StudentFiles::FILE_TYPE['APPLICANT']], $status = [StudentFiles::FILE_STATUS['QUALIFIED'], StudentFiles::FILE_STATUS['EXCELLENT']]);
        return boolval($file);
    }
}