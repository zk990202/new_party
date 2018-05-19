<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;
// 向上级党组织汇报
class ReportToSuperior extends BaseStatusItem {
    public function __construct()
    {
        parent::__construct();
        $this->status = MainStatus::REPORT_TO_SUPERIOR;
    }
}