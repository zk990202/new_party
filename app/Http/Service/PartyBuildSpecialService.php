<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Service;


use App\Models\Column;
use App\Models\SpecialNews;

class PartyBuildSpecialService
{
    // 身边的英雄
    public function getHeroNews(){
        $data = SpecialNews::newsByTypeWithPage($type = Column::HERO_ID, $perPage = 6);
        return $data;
    }

    // 中央精神
    public function getSpiritNews(){
        $data = SpecialNews::newsByTypeWithPage($type = Column::SPIRIT_ID, $perPage = 6);
        return $data;
    }

    // 群众路线
    public function getMassLineNews(){
        $data = SpecialNews::newsByTypeWithPage($type = Column::MASS_LINE, $perPage = 6);
        return $data;
    }

    // 中国梦
    public function getChinaDreamNews(){
        $data = SpecialNews::newsByTypeWithPage($type = Column::CHINA_DREAM, $perPage = 6);
        return $data;
    }
}