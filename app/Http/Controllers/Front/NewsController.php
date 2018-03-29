<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 2:08 PM
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Service\NewsService;
use App\Models\SpecialNews;

class NewsController extends FrontBaseController{
    protected $newsService;

    public function __construct(NewsService $newsService){
        parent::__construct();
        $this->newsService = $newsService;
    }

    /**
     * 党校培训-新闻中心
     */
    public function partySchool(){
        $newsList = $this->newsService->getPartyBuildNews();
        $data = [
            'newsList' => $newsList
        ];
        return view('front.news.default', ['data' => $data]);
    }

}