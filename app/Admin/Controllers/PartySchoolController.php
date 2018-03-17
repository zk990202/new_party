<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/7/16
 * Time: 10:25
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Resources;
use App\Http\Service\AdminMenuService;
use App\Models\SpecialNews;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class PartySchoolController extends Controller{
    protected $imgExtension;
    protected $imgUsage = "partyBuildImg";//党校培训与党建专项的图片上传一样,在同一个数据表中
    protected $titles;

    public function __construct()
    {
        $this->imgExtension = config('fileUpload.');
        $this->titles = AdminMenuService::getMenuName();
        Admin::js('/Trumbowyg/dist/trumbowyg.js');
        Admin::js('/Trumbowyg/dist/plugins/upload/trumbowyg.upload.js');
        Admin::css('/Trumbowyg/dist/ui/trumbowyg.min.css');

        Admin::css('/vendor/laravel-admin/datatables/dataTables.bootstrap.min.css');

        Admin::js('/vendor/laravel-admin/datatables/jquery.dataTables.min.js');
        Admin::js('/vendor/laravel-admin/datatables/dataTables.bootstrap.min.js');
    }

    /**
     * 列出所有新闻
     * @return \Encore\Admin\Layout\Content
     */
    public function lists(){
        $news_arr = SpecialNews::getAllNewsSchool();
        return Admin::content(function(Content $content) use ($news_arr){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartySchool.news', ['newses' => $news_arr]));
        });
    }

    /**
     * 隐藏(显示)新闻
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function hide($id){
        $partyBuild = SpecialNews::findOrFail($id);
        $partyBuild->isdeleted = $partyBuild ->isdeleted ^ 1; //异或操作
        $partyBuild->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 置顶(取消)新闻
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function topUp($id){
        $partyBuild = SpecialNews::findOrFail($id);
        $partyBuild->isrecommand = $partyBuild->isrecommand ^ 1;
        $partyBuild->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id){
        $title = $request->input('title');
        $content = $request->input('content');
        $img_path = $request->input('imgPath') ?? null;
        try{
            $res = SpecialNews::updateByIdSchool($id, [
                // 防止编辑器xss攻击，这里进行编码，同时避免二次编码
                'content' => $content,
                'title' => $title,
                'imgPath' => $img_path
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
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => '公告id有误，未找到'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    /**
     * @param $id
     * @return Content
     */
    public function editPage($id){
        $news = SpecialNews::FindorFail($id);
        $news = Resources::SpecialNews($news);
        return Admin::content(function(Content $content) use ($news){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartySchool.edit', ['newses' => $news]));
        });
    }

    public function addPage(){
        return Admin::content(function(Content $content){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartySchool.add'));
        });
    }

    public function add(Request $request){
        $title = $request->input('title');
        $content = $request->input('content');
        $img_path = $request->input('imgPath') ?? null;
        if(!$title || !$content){
            return response()->json([
                'message' => '参数丢失'
            ]);
        }
        $res = SpecialNews::addSchool([
            'type' => 1,
            'title' => $title,
            'content' => $content,
            'imgPath' => $img_path,
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

    public function getNewsById($id){
        try{
            $notice = SpecialNews::findOrFail($id);
            return response()->json([
                'success'   => true,
                'info'      => Resources::SpecialNews($notice)
            ]);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['message' => 'News not found']);
        }
    }
}