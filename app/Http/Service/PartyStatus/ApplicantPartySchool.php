<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\Applicant\CourseList;
use App\Models\ScoresTwenty;
use App\Models\StudentInfo;

class ApplicantPartySchool extends BaseWorkItem{

    // 更新20课状态为通过
    public function to()
    {
        parent::to();

        ScoresTwenty::where(['is_systemadd' => 1, 'student_id' => $this->userNumber])->delete();
        $courses = CourseList::getAll();
        foreach($courses as $v){
            ScoresTwenty::create([
                'student_id' => $this->userNumber,
                'course_id' => $v['id'],
                'score' => 60,
                'complete_time' => date('Y-m-d H:i:s'),
                'is_systemadd' => 1,
                'isdeleted' => 0
            ]);
        }

        StudentInfo::updatePassTwenty($this->userNumber);
    }

    public function cancel()
    {
        parent::cancel();

        ScoresTwenty::clear($this->userNumber);
        StudentInfo::updatePassTwenty($this->userNumber, $status = 0);
    }

    public function isActive()
    {
        return StudentInfo::isPass20($this->userNumber);
    }
}