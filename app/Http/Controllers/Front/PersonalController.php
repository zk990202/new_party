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
use App\Http\Service\PersonalService;
use App\Models\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PersonalController extends FrontBaseController {

    protected $partyStatusService;
    protected $alertService;
    protected $personalService;

    protected $user;

    public function __construct(PartyStatusService $partyStatusService, AlertService $alertService, PersonalService $personalService)
    {
        parent::__construct();
        $this->partyStatusService = $partyStatusService;
        $this->alertService = $alertService;
        $this->personalService = $personalService;
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
        $user = $this->userService->getCurrentUser();
        //dd($user);
        //$partyBranch = $this->partyStatusService->getPartyBranchInfoById($user['partyBranchId']);
        //dd($partyBranch, $user);

        return view('front.personal.partyBranch', ['user' => $user, 'partyBranch' => 'nav1']);
    }

    public function members(){
        $user = $this->userService->getCurrentUser();
        $members = StudentInfo::getPartyBranchMembersByIdWithPage($user['partyBranchId'], $limit = 20);
        foreach($members as $i => &$item){
            $members[$i] = MainStatus::warpStatus($item);
        }
        //dd($members);
        return view('front.personal.members', ['list' => $members]);
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
            return $this->alertService->alertAndBack('提示', '您目前没有可提交的文件');
        }
        // TODO
    }

    /**
     * 上传文献查看
     * @param $type_start
     * @param $type_end
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function fileWatch($type_start, $type_end){
        $nav_data = '入党申请书';
        if ($type_start == 1)
            $nav_data = '入党申请书';
        elseif($type_start == 2)
            $nav_data = '思想汇报';
        elseif($type_start == 6)
            $nav_data = '个人小结';
        elseif($type_start == 10)
            $nav_data = '入党志愿书';
        elseif($type_start == 11)
            $nav_data = '转正申请';
        else
            return $this->alertService->alertAndBack('提示', '未知的文件类型！');

        $user = $this->userService->getCurrentUser();
        $sno = $user['userNumber'];

        $result = [];
        if ($type_start && $type_end){
            if ($type_start == $type_end){
                $result = $this->personalService->getFileByTypeOnly($sno, $type_start);
            }
            elseif ($type_start == 2){
                $result = $this->personalService->getReportByTypeBetween($sno, $type_start, $type_end);
            }
            elseif ($type_start == 6){
                $result = $this->personalService->getSummaryTypeBetween($sno, $type_start, $type_end);
            }
            elseif ($type_start == 10 || $type_start == 11){
                $result = $this->personalService->getFileByTypeBetween($sno, $type_start, $type_end);
            }
        }
        return view('front.personal.fileWatch', [
            'result' => $result,
            'nav' => $nav_data,
            'user' => $user,
        ]);

    }

    /**
     * 上传文献详情
     * @param $type
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fileDetail($type, $id){
        if ($type == 2){
            $detail = $this->personalService->getReportById($id);
        }
        elseif ($type == 6){
            $detail = $this->personalService->getSummaryById($id);
        }
        else{
            $detail = $this->personalService->getFileById($id);
        }
        return view('front.personal.fileDetail', ['detail' => $detail]);
    }

}