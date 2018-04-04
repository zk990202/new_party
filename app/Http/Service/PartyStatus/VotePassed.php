<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

class VotePassed extends BaseStatusItem {
    public function __construct()
    {
        parent::__construct();
        $this->status = MainStatus::VOTE_PASSED;
    }
}