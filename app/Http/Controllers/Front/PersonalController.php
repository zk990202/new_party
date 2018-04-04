<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2018/4/4
 * Time: 9:09 AM
 */
namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Service\PartyStatusService;

class PersonalController extends FrontBaseController {

    protected $partyStatusService;

    public function __construct(PartyStatusService $partyStatusService)
    {
        parent::__construct();
        $this->partyStatusService = $partyStatusService;
    }

    // 前台个人状态
    public function status(){
        $status = $this->partyStatusService->getPersonalStatus(auth()->user()->userNumber());
        foreach($status as &$v){
            if($v == 2)
                $v = [
                    'class' => 'finish',
                    'pic'   => '/img3/ready.png'
                ];
            else if($v == 1)
                $v = [
                    'class' => 'ready',
                    'pic'   => '/img3/processing.png'
                ];
            else
                $v = [];
        }

        $data = [
            'status' => $status
        ];
        //dd($data);
        return view('front.personal.status', ['data' => $data, 'status' => 'nav1']);
    }
}