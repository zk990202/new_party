<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:17 AM
 */

namespace App\Http\Service;

use App\Models\Column;
use App\Models\Notification;

class NotificationService{
    public function getApplicantNotification(){
        $data = Notification::getAllNoticeByColumnIdWithPage(Column::APPLICANT_ID);
        return $data;
    }

    public function getAcademyNotification(){
        $data = Notification::getAllNoticeByColumnIdWithPage(Column::ACADEMY_ID);
        return $data;
    }

    public function getProbationaryNotification(){
        $data = Notification::getAllNoticeByColumnIdWithPage(Column::PROBATIONARY_ID);
        return $data;
    }

    public function getSecretaryNotification(){
        $data = Notification::getAllNoticeByColumnIdWithPage(Column::SECRETARY_ID);
        return $data;
    }

    public function getActivityNotification(){
        $data = Notification::getAllNoticeByColumnIdWithPage(Column::PARTY_SCHOOL_ID);
        return $data;
    }
}