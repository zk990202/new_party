<?php

namespace App\Http\Controllers\Manager;

use App\Http\Helpers\Resources;
use App\Models\Column;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Mockery\Exception;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    protected $fileExtension;
    protected $fileUsage = "noticeFile";

    public function __construct()
    {
        $this->fileExtension = config('fileUpload.');
    }

    //以下为党校公告专区
//    /**
//     * @param $type [70|71|72|73]
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function partySchool($type){
//        if(!in_array($type, [70, 71, 72, 73])){
//            throw new InvalidParameterException();
//        }
//        $notice_arr = Notification::getAllNotice($type);
//        return view('Manager/Notice/partySchool', ['notices' => $notice_arr]);
//    }

    public function partySchoolApplicant(){
        $notice_arr = Notification::getAllNotice(70);
        return view('Manager/Notice/partySchool', ['notices' => $notice_arr]);
    }

    public function partySchoolAcademy(){
        $notice_arr = Notification::getAllNotice(71);
        return view('Manager/Notice/partySchool', ['notices' => $notice_arr]);
    }

    public function partySchoolProbationary(){
        $notice_arr = Notification::getAllNotice(72);
        return view('Manager/Notice/partySchool', ['notices' => $notice_arr]);
    }

    public function partySchoolSecretary(){
        $notice_arr = Notification::getAllNotice(73);
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

    public function getNoticeById($nid){
        try{
            $notice = Notification::findOrFail($nid);
            return response()->json([
                'success'   => true,
                'info'      => Resources::Notification($notice)
            ]);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['message' => 'Notice not found']);
        }
    }

    /**
     * 更新操作
     * @param Request $request
     * @param $notice_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $notice_id){

        $content = $request->input('content');
        $title = $request->input('title');
        $file_name = $request->input('fileName') ?? null;
        $file_path = $request->input('filePath') ?? null;
        try{
            $res = Notification::updateById($notice_id, [
                // 防止编辑器xss攻击，这里进行编码，同时避免二次编码
                'content'   => $content,
                'title'     => $title,
                'fileName'  => $file_name,
                'filePath'  => $file_path
            ]);
            if($res){
                return response()->json([
                    'info' => $res,
                    'success' => true
                ]);
            } else{
                return response()->json([
                    'message' => '更新失败，请联系后台管理员',
                ]);
            }

        } catch (ModelNotFoundException $e){
            return response()->json([
                'message' => '公告id有误，未找到'
            ]);
        } catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    /**
     * @param $notice_id
     * @throws ModelNotFoundException
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage($notice_id){
        $notification = Notification::findOrFail($notice_id);
        $notification = Resources::Notification($notification);
//        dd($notification);
        return view('Manager.Notice.edit', ['notice' => $notification]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addPage(){
        // 党校公告所属类别为 1
        $columns = Column::getColumnsByParentId(1);
        return view('Manager.Notice.add', ['columns' => $columns]);
    }

    public function add(Request $request){
        $title = $request->input('title');
        $content = $request->input('content');
        $column = $request->input('column');
        $filePath = $request->input('filePath') ?? '';
        $fileName = $request->input('fileName') ?? '';
        if(!$title || !$content || !$column){
            return response()->json([
                'message' => '参数丢失'
            ]);
        }
        $res = Notification::add([
            'columnId'  =>  $column,
            'title'     =>  $title,
            'content'   =>  $content,
            'fileName'  =>  $fileName,
            'filePath'  =>  $filePath,
            // 介入登陆后进行调整
            'author'    =>  Auth::user()->username ?? '3014218099'
        ]);
        if($res){
            return response()->json([
                'success' => true,
                'info' => $res
            ]);
        }
        return response()->json([
            'message' => '添加失败，请联系后台管理员'
        ]);
    }

    //以下为活动通知专区
    public function activity(){
        $activity_arr = Notification::activityGetAllNotice();
        return view('Manager/Notice/activity', ['notices' => $activity_arr]);
    }

    public function activityEdit(Request $request, $activity_id){

        $content = $request->input('content');
        $title = $request->input('title');
        $file_name = $request->input('fileName') ?? null;
        $file_path = $request->input('filePath') ?? null;
        try{
            $res = Notification::activityUpdateById($activity_id, [
                // 防止编辑器xss攻击，这里进行编码，同时避免二次编码
                'content'   => $content,
                'title'     => $title,
                'fileName'  => $file_name,
                'filePath'  => $file_path
            ]);
            if($res){
                return response()->json([
                    'info' => $res,
                    'success' => true
                ]);
            } else{
                return response()->json([
                    'message' => '更新失败，请联系后台管理员',
                ]);
            }

        } catch (ModelNotFoundException $e){
            return response()->json([
                'message' => '公告id有误，未找到'
            ]);
        } catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    public function activityEditPage($activity_id){
        $notification = Notification::findOrFail($activity_id);
        $notification = Resources::Notification($notification);
//        dd($notification);
        return view('Manager.Notice.activityEdit', ['notice' => $notification]);
    }

    public function activityAddPage(){
        return view('Manager.Notice.activityAdd');
    }

    public function activityAdd(Request $request){
        $title = $request->input('title');
        $content = $request->input('content');
        $filePath = $request->input('filePath') ?? '';
        $fileName = $request->input('fileName') ?? '';
        if(!$title || !$content ){
            return response()->json([
                'message' => '参数丢失'
            ]);
        }
        $res = Notification::activityAdd([
            'title'     =>  $title,
            'content'   =>  $content,
            'fileName'  =>  $fileName,
            'filePath'  =>  $filePath,
            // 介入登陆后进行调整
            'author'    =>  Auth::user()->username ?? '3014218099'
        ]);
        if($res){
            return response()->json([
                'success' => true,
                'info' => $res
            ]);
        }
        return response()->json([
            'message' => '添加失败，请联系后台管理员'
        ]);
    }


    public function test(Request $request){

        return \Illuminate\Support\Facades\Route::currentRouteName();
    }
}
