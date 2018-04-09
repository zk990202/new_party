<?php


/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:05 AM
 */
namespace App\Http\Service;
use App\Http\Service\PartyStatus\BaseWorkItem;
use App\Http\Service\PartyStatus\CorrectApplication;
use App\Http\Service\PartyStatus\IWorkable;
use App\Http\Service\PartyStatus\MainStatus;
use App\Models\PartyBranch\PartyBranch;
use App\Models\StudentFiles;
use App\Models\StudentInfo;

class PartyStatusService{
    const RETURN_STATUS = [
        'MESSAGE' => 1,
        'JUMP'    => 2,
    ];

    /**
     * 获取个人入党状况 0 未完成 1 正在进行 2 已完成
     * @param $userNumber
     * @return array
     */
    public function getPersonalStatus($userNumber){
        $status = [];

        // 初始节点,根据依赖关系取得每个节点状态
        $determinationList = ['PartyApplication'];
        while(!empty($determinationList)){
            $tmp = [];
            foreach($determinationList as $v){
                if(isset($status[$v]))
                    continue;

                $obj = app()->make(config('party.namespace') . $v);
                $obj->setUserNumber($userNumber);

                //要保证当前节点父节点都已经完成了初始化，如果未完成，放进下一轮迭代数组进行初始化
                $flag = true;
                foreach($obj->dependenceList() as $item){
                    if(!isset($status[$item])){
                        $flag = false;
                        break;
                    }
                }
                if(!$flag){
                    $tmp[] = $v;
                    continue;
                }
                $status[$v] = $obj->isActive() ? 2 : 0;
                // 判断正在进行中的结点
                if($status[$v] == 0){
                    $flag = true;
                    foreach($obj->dependenceList() as $item){
                        if($status[$item] != 2){
                            //只要父节点有一没有通过，就判定为未通过
                            $flag = false;
                            break;
                        }
                    }
                    if($flag)
                        $status[$v] = 1;
                }

                $tmp = array_merge($tmp, $obj->determinationList());
            }
            $determinationList = array_unique($tmp);
        }

        return $status;
    }


    public function getPartyBranchInfo($userNumber){
        $user = StudentInfo::getStudentInfo($userNumber);
        $partyBranch = PartyBranch::getBranchById($user['partyBranchId']);
        return $partyBranch;
    }

    /**
     * 获取用户应当提交的文档类型，没有可提交的文档返回false
     * @param $userNumber
     * @return bool
     */
    public function getDocType($userNumber){
        $status = 1;
        if($status == MainStatus::APPLICANT)
            return StudentFiles::FILE_TYPE['APPLICANT'];

        if($status == MainStatus::DEVELOPMENT_PUBLICITY)
            return StudentFiles::FILE_TYPE['VOLUNTEER_BOOK'];

        // 需要提交季度思想汇报
        if(($status >= MainStatus::ACTIVIST && $status < MainStatus::DEVELOPMENT_TARGET) || $status == MainStatus::ACTIVIST_COMMUNIST){
            $count = StudentInfo::getReportNumber($userNumber);
            if($count == 0)
                return StudentFiles::FILE_TYPE['REPORT_1'];
            if($count == 1)
                return StudentFiles::FILE_TYPE['REPORT_2'];
            if($count == 2)
                return StudentFiles::FILE_TYPE['REPORT_3'];
            if($count == 3)
                return StudentFiles::FILE_TYPE['REPORT_4'];
        }

        // 需要提交个人小结或者转正申请
        if($status >= MainStatus::PROBATIONARY && $status < MainStatus::CORRECT_PUBLICITY){
            $count = StudentInfo::getPersonalSummaryNumber($userNumber);
            if($count == 0)
                return StudentFiles::FILE_TYPE['PERSONAL_SUMMARY_1'];
            if($count == 1)
                return StudentFiles::FILE_TYPE['PERSONAL_SUMMARY_2'];
            if($count == 2)
                return StudentFiles::FILE_TYPE['PERSONAL_SUMMARY_3'];
            if($count == 3)
                return StudentFiles::FILE_TYPE['PERSONAL_SUMMARY_4'];

            // 判断是否应该提交转正申请
            $correct = new CorrectApplication();
            $correct->setUserNumber($userNumber);
            if($correct->isProcessing()){
                return StudentFiles::FILE_TYPE['CORRECT_APPLICATION'];
            }
        }
        return false;
    }

    public function getNextAction($userNumber, BaseWorkItem $item){
        $item->setUserNumber($userNumber);
        if($item->isActive()){
            return [
                'status' => self::RETURN_STATUS['MESSAGE'],
                'msg'    => [
                    'type'    => AlertService::ALERT_TYPE['INFO'],
                    'title'   => '提示',
                    'content' => "您已通过【". $item->getName() ."】！",
                ]
            ];
        }
        else if($item->isProcessing()){
            return [
                'status' => self::RETURN_STATUS['JUMP'],
                'url'    => $item->getActionUri()
            ];
        }
        else{
            $arr = "";
            foreach($item->dependenceList() as $p){
                $obj = app()->make(config('party.namespace') . $p);
                $obj->setUserNumber($userNumber);
                if(!$obj->isActive())
                    $arr .= '【' . $obj->getName() .'】';
            }
            return [
                'status' => self::RETURN_STATUS['MESSAGE'],
                'msg'    => [
                    'type'    => AlertService::ALERT_TYPE['INFO'],
                    'title'   => '提示',
                    'content' => $arr . '尚未通过'
                ]
            ];
        }
    }
}