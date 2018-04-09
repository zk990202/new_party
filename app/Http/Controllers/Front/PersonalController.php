<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2018/4/4
 * Time: 9:09 AM
 */
namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Helpers\Resources;
use App\Http\Service\AlertService;
use App\Http\Service\PartyStatus\DevelopmentTarget;
use App\Http\Service\PartyStatus\IdeologicalReport_1;
use App\Http\Service\PartyStatus\MainStatus;
use App\Http\Service\PartyStatus\MaterialsReady;
use App\Http\Service\PartyStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PersonalController extends FrontBaseController {

    protected $partyStatusService;
    protected $alertService;

    protected $user;

    public function __construct(PartyStatusService $partyStatusService, AlertService $alertService)
    {
        parent::__construct();
        $this->partyStatusService = $partyStatusService;
        $this->alertService = $alertService;
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
                $v = [
                    'class' => 'ready',
                    'pic'   => '/img3/processing.png'
                ];
        }

        $data = [
            'status' => $status
        ];
        //dd($data);
        return view('front.personal.status', ['data' => $data, 'status' => 'nav1']);
    }

    /**
     *  个人党支部状态
     */
    public function partyBranch(){
        $partyBranch = $this->partyStatusService->getPartyBranchInfo(auth()->user()->userNumber());

        return view('front.personal.partyBranch', ['data' => $partyBranch, 'user' => auth()->user(), 'partyBranch' => 'nav1']);
    }

    public function docStore(Request $request){
        $data = $request->only(['title', 'content']);
        if(count($data) != 2)
            return back()->with('msg', '请填写标题和内容');
        // TODO
    }

    public function docPage(){
        $nextAction = $this->partyStatusService->getNextAction(auth()->user()->userNumber(), new IdeologicalReport_1());
        if($nextAction['status'] == PartyStatusService::RETURN_STATUS['MESSAGE']){
            return $this->alertService->alertAndBackByConfig($nextAction['msg']);
        }
        $type = $this->partyStatusService->getDocType(auth()->user()->userNumber());
        if(!$type){
            Alert::info('提示', '您目前没有可提交的文件');
            return back();
        }
        // TODO
    }


}