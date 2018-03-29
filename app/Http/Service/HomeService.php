<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 27/03/2018
 * Time: 3:39 PM
 */

namespace App\Http\Service;

use App\Models\Column;
use App\Models\Notification;
use App\Models\SpecialNews;

class HomeService {

    // 首页
    public function data(){
        // 活动通知信息
        $notices = Notification::getIndexData(4);

        // 党建专项新闻
        $specialNews = SpecialNews::newsByTypesLimit(Column::getChildIds(Column::PARTY_BUILD_ID), 6);

        // TODO 支部风采

        // TODO 榜样的力量

        // 党校培训
        $school = SpecialNews::newsByTypeLimit(Column::PARTY_SCHOOL_ID, 5);

        return[
            'notices' => $notices,
            'special' => $specialNews,
            'school'  => $school
        ];
    }

}