<?php

namespace App\Http\Controllers\Manager;

use App\Http\Helpers\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use App\Models\Notification;

class NoticeController extends Controller
{

    /**
     * @param $type [70|71|72|73]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function partySchool($type){
        if(!in_array($type, [70, 71, 72, 73])){
            throw new InvalidParameterException();
        }
        $notice_arr = Notification::getAllNotice($type);
        return view('Manager/Notice/partySchool', ['notices' => $notice_arr]);
    }

    /**
     * 隐藏（显示）公告
     * @param $notice_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function hide($notice_id){
        $notification = Notification::findOrFail($notice_id);
        $notification->notice_ishidden = $notification->notice_ishidden ^ 1;
        $notification->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 置顶（取消）公告
     * @param $notice_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function topUp($notice_id){
        $notification = Notification::findOrFail($notice_id);
        $notification->notice_istop = $notification->notice_istop ^ 1;
        $notification->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function edit(Request $request){

    }

    /**
     * @param $notice_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage($notice_id){
        $notification = Notification::findOrFail($notice_id);
        $notification = Resources::Notification($notification);
        return view('Manager.Notice.edit', ['notice' => $notification]);
    }
}
