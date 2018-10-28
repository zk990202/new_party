<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 2:08 PM
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontBaseController;
use App\Http\Helpers\CodeAndMessage;
use App\Http\Service\NotificationService;
use App\Models\Notification;

class NotificationController extends FrontBaseController{
    protected $notificationService;
    public $module;
    public function __construct(NotificationService $notificationService){
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    /**
     * 申请人培训
     */
    public function applicant(){
        $notice = $this->notificationService->getApplicantNotification();
        $data = [
            'notice' => $notice
        ];
//        dd($data);
//        return view('front.notification.default', ['data' => $data, 'applicant' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg' => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 院级积极分子
     */
    public function academy(){
        $notice = $this->notificationService->getAcademyNotification();
        $data = [
            'notice' => $notice
        ];
        //dd($data);
//        return view('front.notification.default', ['data' => $data, 'academy' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 预备党员
     */
    public function probationary(){
        $notice = $this->notificationService->getProbationaryNotification();
        $data = [
            'notice' => $notice
        ];
        //dd($data);
//        return view('front.notification.default', ['data' => $data, 'probationary' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 党支部书记
     */
    public function secretary(){
        $notice = $this->notificationService->getSecretaryNotification();
        $data = [
            'notice' => $notice
        ];
//        dd($data);
//        return view('front.notification.default', ['data' => $data, 'secretary' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 活动通知
     */
    public function activity(){
        $notice = $this->notificationService->getActivityNotification();
        $data = [
            'notice' => $notice
        ];
//        dd($data);
//        return view('front.notification.default', ['data' => $data, 'activity' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 公告详情
     * @param $id
     * @return mixed
     */
    public function detail($id){
        $notice = Notification::getNoticeById($id);
        if(!$notice){
//            return $this->alertService->alertAndBack('提示', '通知不存在');
            return response()->json([
                'code' => 1,
                'msg'  => CodeAndMessage::returnMsg(1),
            ]);
        }
//        return view('front.notification.detail', ['detail' => $notice]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $notice
        ]);
    }


}