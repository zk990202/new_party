<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2018/4/4
 * Time: 9:09 AM
 */
namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Helpers\CodeAndMessage;
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
        $user = $this->userService->getCurrentUser();
//        $status = $this->partyStatusService->getPersonalStatus(auth()->user()->userNumber());
        $status = $this->partyStatusService->getPersonalStatus($user['userNumber']);
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
            'user'   => $user,
            'status' => $status
        ];
        //dd($data);
//        return view('front.personal.status', ['data' => $data, 'status' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     *  个人党支部状态
     */
    public function partyBranch(){
        $user = $this->userService->getCurrentUser();
        //dd($user);
        //$partyBranch = $this->partyStatusService->getPartyBranchInfoById($user['partyBranchId']);
        //dd($partyBranch, $user);

//        return view('front.personal.partyBranch', ['user' => $user, 'partyBranch' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $user
        ]);
    }

    /**
     * 支部成员
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function members(){
        $user = $this->userService->getCurrentUser();
        $members = StudentInfo::getPartyBranchMembersByIdWithPage($user['partyBranchId'], $limit = 20);
        foreach($members as $i => &$item){
            $members[$i] = MainStatus::warpStatus($item);
        }
        //dd($members);
        return view('front.personal.members', ['list' => $members]);
    }

    /**
     * 我的学习小组
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function groupMembers(){
        $user = $this->userService->getCurrentUser();
        $group = StudentInfo::getStudentInfo($user['userNumber'])['captionOfGroup'];
        $groupMembers = StudentInfo::getPartyBranchGroupMembersByIdAndGroupWithPage($user['partyBranchId'], $group, $limit = 20);
        foreach($groupMembers as $i => &$item){
            $groupMembers[$i] = MainStatus::warpStatus($item);
        }
        return view('front.personal.groupMembers', ['list' => $groupMembers]);
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

    /**
     * 我的消息
     * 包括接受的消息和发送的消息
     * @param $SentOrReceived
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function myMessage($SentOrReceived){
        $user = $this->userService->getCurrentUser();
        $sno = $user['userNumber'];
        $partyBranchId = $user['partyBranchId'];
        $partyBranchInfo = $this->personalService->getPartyBranchInfoById($partyBranchId);
        if (!$partyBranchInfo)
            return $this->alertService->alertAndBackWithError('未找到所在支部信息');
        else{
            $partyBranchInfo = $partyBranchInfo[0];
            //0表示学生发给管理员 ,1表示老师发给所有用户,2表示发给所有学生,3表示发给全部管理员4表示发给全部支部委员,5表示发给指定用户
            if ($SentOrReceived == 'received'){
                //下面判断该用户是否是支部委员
                if ($sno == $partyBranchInfo['secretary'] || $sno == $partyBranchInfo['organizer'] || $sno == $partyBranchInfo['propagator']){
                    $messages = $this->personalService->getReceivedMessageByTypeAndSno([1, 2, 4], $sno);
                }
                else{
                    $messages = $this->personalService->getReceivedMessageByTypeAndSno([1, 2], $sno);
                }
            }
            else{
                $messages = $this->personalService->getSentMessageBySno($sno);
            }
            return view('front.personal.myMessage', ['messages' => $messages, 'user' => $user]);
        }

    }

    /**
     * 消息详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function messageDetail($id){
        $detail = $this->personalService->getMessageDetail($id);
        return view('front.personal.messageDetail', ['detail' => $detail]);
    }

    /**
     * 我的申诉
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myComplain(){
        $user = $this->userService->getCurrentUser();
        $sno = $user['userNumber'];
        $complain = $this->personalService->getComplainBySno($sno);
        return view('front.personal.myComplain', ['complain' => $complain, 'user' => $user]);
    }

    /**
     * 申诉详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function complainDetail($id){
        $detail = $this->personalService->getComplainDetail($id);
        return view('front.personal.complainDetail', ['detail' => $detail]);
    }

}