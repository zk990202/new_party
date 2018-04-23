<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:17 AM
 */

namespace App\Http\Service;

use App\Http\Helpers\Resources;
use App\Http\Service\PartyStatus\MainStatus;
use App\Models\Probationary\EntryForm;
use App\Models\Probationary\TrainList;
use App\Models\StudentInfo;

class ProbationaryService{
    // 选修课、必修课需要上的数量
    const NUM_REQUIRED_COURSE = 3;
    const NUM_ELECTIVE_COURSE = 1;

    public function canEntryTest($userNumber){
        $userStatus = StudentInfo::getMainStatus($userNumber);
        if($userStatus != MainStatus::PROBATIONARY && $userStatus != MainStatus::PARTY_ORGANIZATION)
            return [
                'status' => false,
                'msg'    => '您目前的状态不符合报名的要求，只有状态通过【预备党员】或者是已经完成【支部组织生活和党内活动】，并且没有完成预备党员党校学习的学员才可以参加预备党员结业考试！如果有任何问题，请联系超管处理，谢谢'
            ];

        $hasPassed = EntryForm::isPass($userNumber);
        if($hasPassed)
            return [
                'status' => false,
                'msg'    => '已经通过预备党员结业考试，无需重复报名'
            ];

        $activeTest = TrainList::getActiveTrain();
        if(!$activeTest)
            return [
                'status' => false,
                'msg'    => '暂时还没有考试开启，或考试开启但是报名通道未开放，请耐心等待!'
            ];

        $hasEntered = EntryForm::isSign($userNumber, $activeTest['id']);
        if($hasEntered)
            return [
                'status' => false,
                'msg'    => '您已经报名了该期考试或已经退出考试，不能重复报名，去查看你的课表吧'
            ];

        return [
            'status' => true,
            'test'   => $activeTest
        ];
    }

    public function canChooseCourse($userNumber){
        $activeTest = TrainList::getActiveTrain();
        if(!$activeTest)
            return [
                'status' => false,
                'msg'    => '暂时还没有考试开启，或考试开启但是报名通道未开放，请耐心等待!'
            ];

        $hasEntered = EntryForm::isSignNotExit($userNumber, $activeTest['id']);
        if(! $hasEntered)
            return [
                'status' => false,
                'msg'    => '您尚未报名本次预备党员党校培训，请前往报名界面报名'
            ];

        return [
            'status' => true,
            'test'   => $activeTest,
            'entry'  => $hasEntered
        ];
    }

    public function getSelectedCourses($userNumber, $entryId){

    }

    public function getPreEntryForm($userNumber, $curTrainId = null){
        if($curTrainId)
            $trains = TrainList::where('train_id', '<=', $curTrainId)->where('train_isdeleted', 0)->orderBy('train_id', 'DESC')->limit(2)->get()->all();
        else
            $trains = TrainList::where('train_isdeleted', 0)->orderBy('train_id', 'DESC')->limit(2)->get()->all();
        if(!$trains || count($trains) != 2){
            return null;
        }
        return $entry = EntryForm::getBySnoAndTrainIdNotExit($userNumber, $trains[1]->train_id);
    }
}