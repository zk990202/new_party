<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\StudentInfo;

class ApplicantLearningGroup extends BaseWorkItem{

    public function to()
    {
        if($this->isActive())
            return;
        parent::to();

        StudentInfo::where('sno', $this->userNumber)->update(['captain_ofgroup' => 1]);
    }

    public function cancel()
    {
        if(!$this->isActive())
            return;
        parent::cancel();

        StudentInfo::where('sno', $this->userNumber)->update(['captain_ofgroup' => 0]);
    }

    public function isActive()
    {
        $user = StudentInfo::getStudentInfo($this->userNumber);
        return boolval($user['captionOfGroup']);
    }
}