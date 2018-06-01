<?php
/**
 * 我的支部
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/5/31
 * Time: 17:41
 */

namespace App\Http\Service;


use App\Models\Message;
use App\Models\PartyBranch\PartyBranch;
use App\Models\Report;
use App\Models\StudentFiles;
use App\Models\Summary;

class PersonalService
{
    public function getFileByTypeOnly($sno, $type){
        $data = StudentFiles::getFileByTypeOnly($sno, $type);
        return $data;
    }

    public function getFileByTypeBetween($sno, $type_start, $type_end){
        $data = StudentFiles::getFileByTypeBetween($sno, $type_start, $type_end);
        return $data;
    }

    public function getFileById($id){
        $data = StudentFiles::getFileById($id);
        return $data;
    }

    public function getReportByTypeBetween($sno, $type_start, $type_end){
        $data = Report::getReportByTypeBetween($sno, $type_start, $type_end);
        return $data;
    }

    public function getReportById($id){
        $data = Report::getReportById($id);
        return $data;
    }

    public function getSummaryTypeBetween($sno, $type_start, $type_end){
        $data = Summary::getSummaryByTypeBetween($sno, $type_start, $type_end);
        return $data;
    }

    public function getSummaryById($id){
        $data = Summary::getSummaryById($id);
        return $data;
    }

    public function getPartyBranchInfoById($id){
        $data = PartyBranch::getById($id);
        return $data;
    }

    public function getReceivedMessageByTypeAndSno($type, $sno){
        $data = Message::getReceivedMessageByTypeAndSno($type, $sno);
        return $data;
    }

    public function getSentMessageBySno($sno){
        $data = Message::getSentMessageBySno($sno);
        return $data;
    }

    public function getMessageDetail($id){
        $data = Message::getMessageById($id);
        return $data;
    }

}