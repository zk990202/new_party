<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/11/14
 * Time: 21:34
 */

namespace App\Http\Controllers\Api;
use App\Models\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller {

    /**
     * 党校公告--申请人党校
     * @return \Illuminate\Http\JsonResponse
     */
    public function partySchoolApplicant(){
        $notice_arr = Notification::getAllNoticeWithPage(70);
//        $notice_arr = DB::table('twt_notification')
//                ->where('column_id', 70)->where('notice_isdeleted', 0)
//                ->orderBy('notice_istop', 'desc')->orderBy('notice_ishidden', 'asc')->orderBy('notice_time', 'desc')
//                ->paginate(6);
        if ($notice_arr){
            return view('noticeApplicant', [
                'success' => 1,
                'notice' => $notice_arr
            ]);
//
//            return response()->json([
//                'success' => 1,
//                'notice' => $notice_arr
//            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
//        return view('test', ['notices' => $notice_arr]);
    }

    /**
     * 党校公告--院级积极分子
     * @return \Illuminate\Http\JsonResponse
     */
    public function partySchoolAcademy(){
        $notice_arr = Notification::getAllNoticeWithPage(71);
        if ($notice_arr){
            return response()->json([
                'success' => 1,
                'notice' => $notice_arr
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 党校公告--预备党员党校
     * @return \Illuminate\Http\JsonResponse
     */
    public function partySchoolProbationary(){
        $notice_arr = Notification::getAllNoticeWithPage(72);
        if ($notice_arr){
            return response()->json([
                'success' => 1,
                'notice' => $notice_arr
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 党校公告--党支部书记培训
     * @return \Illuminate\Http\JsonResponse
     */
    public function partySchoolSecretary(){
        $notice_arr = Notification::getAllNoticeWithPage(73);
        if ($notice_arr){
            return response()->json([
                'success' => 1,
                'notice' => $notice_arr
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 活动通知
     * @return \Illuminate\Http\JsonResponse
     */
    public function activity(){
        $activity_arr = Notification::activityGetAllNoticeWithPage();
        if ($activity_arr){
            return response()->json([
                'success' => 1,
                'notice' => $activity_arr
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 通知详情
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id){
        $notice = Notification::getById($id);
        if ($notice){
            return response()->json([
                'success' => 1,
                'notice' => $notice
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

}