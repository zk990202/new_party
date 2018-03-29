<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:17 AM
 */

namespace App\Http\Service;

use App\Models\Column;
use App\Models\SpecialNews;

class NewsService{
    public function getPartyBuildNews(){
        $data = SpecialNews::newsByTypeWithPage($type = Column::PARTY_SCHOOL_ID, $perPage = 6);
        return $data;
    }
}