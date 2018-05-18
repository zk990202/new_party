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
        $res2 = false;
        foreach($courses as $v){
            $res = ScoresTwenty::create([
                'student_id' => $this->userNumber,
                'course_id' => $v['id'],
                'score' => 60,
                'complete_time' => date('Y-m-d H:i:s'),
                'is_systemadd' => 1,
                'isdeleted' => 0
            ]);
            $res2 = $res2 && boolval($res);
        }
        $res3 = StudentInfo::updatePassTwenty($this->userNumber, $status = 1);
        return boolval($res2 && $res3);
    }

    public function cancel()
    {

        parent::cancel();

        $res1 = ScoresTwenty::clear($this->userNumber);
        $res2 = StudentInfo::updatePassTwenty($this->userNumber, $status = 0);
        return boolval($res1) && boolval($res2);
    }

    public function isActive()
    {
        return StudentInfo::isPass20($this->userNumber);
    }
}