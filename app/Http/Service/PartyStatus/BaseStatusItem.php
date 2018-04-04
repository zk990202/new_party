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
        // 这个逻辑不满足入党积极分子和团支部推优那里
        StudentInfo::updateMainStatusTo($this->userNumber, $this->status - 1);
    }

    public function isActive()
    {
        $status = StudentInfo::getMainStatus($this->userNumber) ;
        return $status >= $this->status && $status != MainStatus::ACTIVIST_COMMUNIST;
    }
}