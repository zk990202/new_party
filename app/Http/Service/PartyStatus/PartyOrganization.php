<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;
// 支部组织生活和党内活动
class PartyOrganization extends BaseStatusItem {
    public function __construct()
    {
        parent::__construct();
        $this->status = MainStatus::PARTY_ORGANIZATION;
    }
}