<?php
/**
 * 党建专项
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/5/25
 * Time: 17:44
 */

namespace App\Http\Controllers\Front;


use App\Http\Controllers\FrontBaseController;
use App\Http\Helpers\CodeAndMessage;
use App\Http\Service\PartyBuildSpecialService;
use App\Models\SpecialNews;

class PartyBuildSpecialController extends FrontBaseController
{
    protected $partyBuildSpecialService;

    public function __construct(PartyBuildSpecialService $partyBuildSpecialService)
    {
        parent::__construct();
        $this->partyBuildSpecialService = $partyBuildSpecialService;
    }

    /**
     * 身边的英雄
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function heroNews(){
        $newsList = $this->partyBuildSpecialService->getHeroNews();
        $data = [
            'newsList' => $newsList
        ];
//        dd($data);
//        return view('front.partyBuildSpecial.default', ['data' => $data]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 中央精神
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function spiritNews(){
        $newsList = $this->partyBuildSpecialService->getSpiritNews();
        $data = [
            'newsList' => $newsList
        ];
//        return view('front.partyBuildSpecial.default', ['data' => $data]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 群众路线
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function massLineNews(){
        $newsList = $this->partyBuildSpecialService->getMassLineNews();
        $data = [
            'newsList' => $newsList
        ];
//        return view('front.partyBuildSpecial.default', ['data' => $data]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 中国梦
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ChinaDreamNews(){
        $newsList = $this->partyBuildSpecialService->getChinaDreamNews();
        $data = [
            'newsList' => $newsList
        ];
//        return view('front.partyBuildSpecial.default', ['data' => $data]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    public function detail($id){
        $news = SpecialNews::getNewsById($id);
        if(!$news){
            return response()->json([
                'code' => 1,
                'msg'  => CodeAndMessage::returnMsg(1, '文件不存在')
            ]);
        }
//            return $this->alertService->alertAndBack('提示', '文件不存在');
//        return view('front.partyBuildSpecial.detail', ['detail' => $news]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $news
        ]);
    }
}