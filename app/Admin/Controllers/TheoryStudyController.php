<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/8/19
 * Time: 10:23
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Resources;
use App\Http\Service\AdminMenuService;
use App\Models\CommonFiles;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Mockery\Exception;

class TheoryStudyController extends Controller{

    protected $videoExtension;
    protected $eBookExtension;
    protected $videoUsage = "theoryStudyVideo";
    protected $eBookUsage = "theoryStudyEBook";
    protected $titles;

    public function __construct()
    {
        $this->videoExtension = config('fileUpload.');
        $this->eBookExtension = config('fileUpload');
        $this->titles = AdminMenuService::getMenuName();
        Admin::js('/Trumbowyg/dist/trumbowyg.js');
        Admin::js('/Trumbowyg/dist/plugins/upload/trumbowyg.upload.js');
        Admin::css('/Trumbowyg/dist/ui/trumbowyg.min.css');

        Admin::css('/vendor/laravel-admin/datatables/dataTables.bootstrap.min.css');

        Admin::js('/vendor/laravel-admin/datatables/jquery.dataTables.min.js');
        Admin::js('/vendor/laravel-admin/datatables/dataTables.bootstrap.min.js');
    }

    /**
     * 内容列表
     * @return \Encore\Admin\Layout\Content
     */
    public function lists(){
        $contents_arr = CommonFiles::getAllContents();
        return Admin::content(function(Content $content) use ($contents_arr){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.TheoryStudy.all', ['contents' => $contents_arr]));
        });
    }

    /**
     * 隐藏(显示)
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function hide($id){
        $commonFiles = CommonFiles::findOrFail($id);
        $commonFiles->file_isdeleted = $commonFiles->file_isdeleted ^ 1;
        $commonFiles->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 编辑文章
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editArticle(Request $request, $id){
        $title = $request->input('title');
        $content = $request->input('content');
        $img_path = $request->input('filePath') ?? null;
        try{
            $res = CommonFiles::updateById($id, [

                'content' => $content,
                'title' => $title,
                'filePath' => $img_path
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
                'message' => 'id有误，未找到'
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
    public function editArticlePage($id){
        $contents = CommonFiles::findOrFail($id);
        $contents = Resources::CommonFiles($contents);
        return Admin::content(function(Content $content) use ($contents){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.TheoryStudy.editArticle', ['contents' => $contents]));
        });
    }

    /**
     * 编辑视频
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editVideo(Request $request, $id){
        $title = $request->input('title');
        $img_path = $request->input('filePath') ?? null;
        try{
            $res = CommonFiles::updateById($id, [
                // 防止编辑器xss攻击，这里进行编码，同时避免二次编码
                'title' => $title,
                'filePath' => $img_path
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
                'message' => 'id有误，未找到'
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
    public function editVideoPage($id){
        $contents = CommonFiles::findOrFail($id);
        $contents = Resources::CommonFiles($contents);
        return Admin::content(function(Content $content) use ($contents){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.TheoryStudy.editVideo', ['contents' => $contents]));
        });
    }

    /**
     * 编辑电子书
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editEBook(Request $request, $id){
        $title = $request->input('title');
        $img_path = $request->input('filePath') ?? null;
        try{
            $res = CommonFiles::updateById($id, [
                // 防止编辑器xss攻击，这里进行编码，同时避免二次编码
                'title' => $title,
                'filePath' => $img_path,
                'content'  => ''
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
                'message' => 'id有误，未找到'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    public function editEBookPage($id){
        $contents = CommonFiles::findOrFail($id);
        $contents = Resources::CommonFiles($contents);
        return Admin::content(function(Content $content) use ($contents){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.TheoryStudy.editEBook', ['contents' => $contents]));
        });
    }

    /**
     * 添加文章
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addArticle(Request $request){
        $title = $request->input('title');
        $content = $request->input('content');
        $type = $request->input('type');
        $file_path = $request->input('filePath') ?? '';
        if(!$title || !$content || !$type){
            return response()->json([
                'message' => '参数丢失'
            ]);
        }
        $res = CommonFiles::add([
            'type' => $type,
            'title' => $title,
            'content' => $content,
            'filePath' => $file_path
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

    /**
     * @return Content
     */
    public function addArticlePage(){
        return Admin::content(function(Content $content) {
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.TheoryStudy.addArticle'));
        });
    }

    /**
     * 添加视频
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addVideo(Request $request){
        $title = $request->input('title');
        $type = $request->input('type');
        $file_path = $request->input('filePath') ?? '';
        if(!$title || !$type){
            return response()->json([
                'message' => '参数丢失'
            ]);
        }
        $res = CommonFiles::addVideo([
            'type' => $type,
            'title' => $title,
            'filePath' => $file_path
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

    /**
     * @return Content
     */
    public function addVideoPage(){
        return Admin::content(function(Content $content) {
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.TheoryStudy.addVideo'));
        });
    }

    /**
     * 添加电子书
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addEBook(Request $request){
        $title = $request->input('title');
        $type = $request->input('type');
        $file_path = $request->input('filePath') ?? '';
        if(!$title || !$type){
            return response()->json([
                'message' => '参数丢失'
            ]);
        }
        $res = CommonFiles::addVideo([  //添加视频与添加电子书类似，均无内容，即content部分
            'type' => $type,
            'title' => $title,
            'filePath' => $file_path
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

    /**
     * @return Content
     */
    public function addEBookPage(){
        return Admin::content(function(Content $content) {
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.TheoryStudy.addEBook'));
        });
    }


    public function getContentsById($id){
        try{
            $content = CommonFiles::findOrFail($id);
            return response()->json([
                'success'   => true,
                'info'      => Resources::CommonFiles($content)
            ]);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['message' => 'Contents not found']);
        }
    }
}
