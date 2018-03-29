<?php

namespace App\Admin\Controllers;

use App\Http\Helpers\Resources;
use App\Http\Service\AdminMenuService;
use App\Models\Column;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
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
    protected $titles;
    protected $fileExtension;
    protected $fileUsage = "noticeFile";

    public function __construct()
    {
        $this->fileExtension = config('fileUpload.');
        $this->titles = AdminMenuService::getMenuName();

    }

    public function partySchoolApplicant(){
        $notice_arr = Notification::getAllNotice(70);
        return Admin::content(function(Content $content) use ($notice_arr){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin/Notice/partySchool', ['notices' => $notice_arr]));
        });
    }

    public function partySchoolAcademy(){
        $notice_arr = Notification::getAllNotice(71);
        return Admin::content(function(Content $content) use ($notice_arr){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin/Notice/partySchool', ['notices' => $notice_arr]));
        });
    }

    public function partySchoolProbationary(){
        $notice_arr = Notification::getAllNotice(72);
        return Admin::content(function(Content $content) use ($notice_arr){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin/Notice/partySchool', ['notices' => $notice_arr]));
        });
    }

    public function partySchoolSecretary(){
        $notice_arr = Notification::getAllNotice(73);
        return Admin::content(function(Content $content) use ($notice_arr){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin/Notice/partySchool', ['notices' => $notice_arr]));
        });
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
     * @return Content
     */
    public function editPage($notice_id){
        $notification = Notification::findOrFail($notice_id);
        $notification = Resources::Notification($notification);
//        dd($notification);
        return Admin::content(function(Content $content) use ($notification){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin/Notice/edit', ['notice' => $notification]));
        });
    }

    /**
     *
     */
    public function addPage(){
        // 党校公告所属类别为 1
        $columns = Column::getColumnsByParentId(1);
        return Admin::content(function(Content $content) use ($columns){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin/Notice/add', ['columns' => $columns]));
        });
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
            'author'    =>  Admin::user()->sno ?? '管理员'
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
        return Admin::content(function(Content $content) use ($activity_arr){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin/Notice/activity', ['notices' => $activity_arr]));
        });
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
        return Admin::content(function(Content $content) use ($notification){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin/Notice/activityEdit', ['notice' => $notification]));
        });
    }

    public function activityAddPage(){
        return Admin::content(function(Content $content){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin/Notice/activityAdd'));
        });
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
}
