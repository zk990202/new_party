<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\StudentInfo;
//第四季度思想汇报
class IdeologicalReport_4 extends BaseWorkItem{

    public function to()
    {
        if($this->isActive())
            return false;
        parent::to();

        $res = StudentInfo::updateReportTo($this->userNumber, 4);
        return boolval($res);
    }

    public function cancel()
    {
        if(!$this->isActive())
            return false;
        parent::cancel();
        $res = StudentInfo::updateReportTo($this->userNumber, 3);
        return boolval($res);
    }
    public function isActive()
    {
        return intval(StudentInfo::getReportNumber($this->userNumber)) >= 4;
    }
}