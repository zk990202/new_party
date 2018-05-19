<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\StudentInfo;
// 第三季度个人小结
class PersonalSummary_3 extends BaseWorkItem{

    public function to()
    {
        if($this->isActive())
            return;
        parent::to();

        StudentInfo::updatePersonalSummaryTo($this->userNumber, 3);
    }

    public function cancel()
    {
        if(!$this->isActive())
            return;
        parent::cancel();
        
        StudentInfo::updatePersonalSummaryTo($this->userNumber, 2);
    }
    public function isActive()
    {
        return intval(StudentInfo::getPersonalSummaryNumber($this->userNumber)) >= 3;
    }
}