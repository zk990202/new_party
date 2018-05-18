<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\StudentInfo;
//参加申请人学习小组
class ApplicantLearningGroup extends BaseWorkItem{

    public function to()
    {
        if($this->isActive())
            return false;
        parent::to();

        $res = StudentInfo::where('sno', $this->userNumber)->update(['captain_ofgroup' => 1]);
        return boolval($res);
    }

    public function cancel()
    {
        if(!$this->isActive())
            return false;
        parent::cancel();

        $res = StudentInfo::where('sno', $this->userNumber)->update(['captain_ofgroup' => 0]);
        return boolval($res);
    }

    public function isActive()
    {
        $user = StudentInfo::getStudentInfo($this->userNumber);
        return boolval($user['captionOfGroup']);
    }
}