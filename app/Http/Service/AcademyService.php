<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:17 AM
 */

namespace App\Http\Service;

use App\Models\Academy\EntryForm;
use App\Models\Academy\TestList;
use App\Models\StudentInfo;

class AcademyService{
    public function canEntryTest($userNumber){
        $cid = $this->getCollegeId($userNumber);
        $activeTest = TestList::getActiveTest($cid);
        if(!$activeTest)
            return [
                'status' => false,
                'msg'    => '暂时还没有考试可以报名，请等待考试报名开启后再来报名'
            ];
        $hasEntered = EntryForm::getEntryByTestId($userNumber, $activeTest['id']);
        if($hasEntered)
            return [
                'status' => false,
                'msg'    => '您已经报名了，或者您已经退出该考试报名，都是不能重复报名的，请等待下次报名的开启，或者联系管理员进行处理'
            ];
        $hasPassed = EntryForm::isPass($userNumber);
        if($hasPassed)
            return [
                'status' => false,
                'msg'    => '您已经通过了院级结业考试，无需再次报名！'
            ];
        $applicantHasPassed = \App\Models\Applicant\EntryForm::isPass($userNumber);
        if(!$applicantHasPassed)
            return [
                'status' => false,
                'msg'    => '您还没有通过申请人结业考试，不能参加院级结业考试。'
            ];
        return [
            'status' => true,
            'test'   => $activeTest
        ];
    }

    private function getCollegeId($userNumber){
        return StudentInfo::getCollegeId($userNumber);
    }
}