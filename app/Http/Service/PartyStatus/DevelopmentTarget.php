<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

class DevelopmentTarget extends BaseStatusItem {
    public function __construct()
    {
        parent::__construct();
        $this->status = MainStatus::DEVELOPMENT_TARGET;
    }
}