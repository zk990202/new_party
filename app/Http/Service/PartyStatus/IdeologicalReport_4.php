<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\StudentInfo;

class IdeologicalReport_4 extends BaseWorkItem{

    public function to()
    {
        if($this->isActive())
            return;
        parent::to();

        StudentInfo::updateReportTo($this->userNumber, 4);

    }

    public function cancel()
    {
        if(!$this->isActive())
            return;
        parent::cancel();
        StudentInfo::updateReportTo($this->userNumber, 3);
    }
    public function isActive()
    {
        return intval(StudentInfo::getReportNumber($this->userNumber)) >= 4;
    }
}