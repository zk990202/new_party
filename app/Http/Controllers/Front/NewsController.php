<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 2:08 PM
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Helpers\CodeAndMessage;
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
//        return view('front.news.default', ['data' => $data]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    public function detail($id){
        $news = SpecialNews::getNewsById($id);
        if(!$news){
//            return $this->alertService->alertAndBack('提示', '文件不存在');
            return response()->json([
                'code' => 1,
                'msg'  => CodeAndMessage::returnMsg(1, '文件不存在')
            ]);
        }
//        return view('front.news.detail', ['detail' => $news]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $news
        ]);
    }


}