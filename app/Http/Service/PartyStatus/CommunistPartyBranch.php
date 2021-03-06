<?php
///**
// * Created by PhpStorm.
// * User: liebes
// * Date: 02/04/2018
// * Time: 10:52 AM
// */
//
//namespace App\Http\Service\PartyStatus;
//
//use App\Models\StudentInfo;
//
//class CommunistPartyBranch extends BaseWorkItem{
//
//    public function to()
//    {
//        if($this->isActive())
//            return;
//        parent::to();
//        $status = StudentInfo::getMainStatus($this->userNumber) ;
//        // 团支部推优和积极分子平级
//        if($status == MainStatus::ACTIVIST)
//            StudentInfo::updateMainStatusTo($this->userNumber, MainStatus::ACTIVIST_COMMUNIST);
//        else
//            StudentInfo::updateMainStatusTo($this->userNumber, MainStatus::COMMUNIST);
//    }
//
//    public function cancel()
//    {
//        if(!$this->isActive())
//            return;
//        parent::cancel();
//
//        $status = StudentInfo::getMainStatus($this->userNumber) ;
//
//        if($status == MainStatus::COMMUNIST)
//            // 入党申请人
//            StudentInfo::updateMainStatusTo($this->userNumber, MainStatus::APPLICANT);
//        else
//            // 团支部推优
//            StudentInfo::updateMainStatusTo($this->userNumber, MainStatus::ACTIVIST);
//    }
//
//    public function isActive()
//    {
//        $status = StudentInfo::getMainStatus($this->userNumber) ;
//        return $status >= MainStatus::COMMUNIST && $status != MainStatus::ACTIVIST;
//    }
//}