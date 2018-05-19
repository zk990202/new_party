<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;
use App\Models\StudentInfo;

/**
 * 状态类，调整状态即可
 * Class DevelopmentTarget
 * @package App\Http\Service\PartyStatus
 */
abstract class BaseStatusItem extends BaseWorkItem{

    public $status;

    public function to()
    {
        if ($this->isActive())
            return;
        parent::to();
        StudentInfo::updateMainStatusTo($this->userNumber, $this->status);
    }

    public function cancel()
    {
        if(!$this->isActive())
            return;
        parent::cancel();
        // 如果当前状态是发展对象（3），cancel后成为积极分子（1）
        // 党员推荐+团支部推优的逻辑不在这里，在Communist.php和MemberRecommendation.php中单独完成的
        // 其他情况，cancel后直接将状态码减一即可
        $current_status = StudentInfo::getMainStatus($this->userNumber);
        if ($current_status == MainStatus::DEVELOPMENT_TARGET){
            StudentInfo::updateMainStatusTo($this->userNumber, MainStatus::ACTIVIST);
        }
        else{
            StudentInfo::updateMainStatusTo($this->userNumber, $this->status - 1);
        }
    }

    public function isActive()
    {
        $current_status = StudentInfo::getMainStatus($this->userNumber) ;
        return $current_status >= $this->status && $current_status != MainStatus::MEMBER_RECOMMENDATION && $current_status != MainStatus::COMMUNIST_MEMBER_RECOMMENDATION;
    }
}