<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Resources;
use App\Http\Service\AdminMenuService;
use App\Models\CommonFiles;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class ImportantFilesController extends Controller{

    protected $imgExtension;
    protected $imgUsage = "importantFilesFile";
    protected $titles;

    public function __construct()
    {
        $this->imgExtension = config('fileUpload.');
        $this->titles = AdminMenuService::getMenuName();

    }

    /**
     * 列出所有的重要文件
     * @return \Encore\Admin\Layout\Content
     */
    public function lists(){
        $files_arr = CommonFiles::getAll();

        return Admin::content(function(Content $content) use ($files_arr){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.ImportantFiles.all', ['files' => $files_arr]));
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
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id){
        $title = $request->input('title');
        $content = $request->input('content');
        $filePath = $request->input('filePath') ?? null;
        try{
            $res = CommonFiles::updateById($id, [
                // 防止编辑器xss攻击，这里进行编码，同时避免二次编码
                'content' => $content,
                'title' => $title,
                'filePath' => $filePath
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
     * @return Content
     */
    public function editPage($id){
        $files = CommonFiles::findOrFail($id);
        $files = Resources::CommonFiles($files);

        return Admin::content(function(Content $content) use ($files){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.ImportantFiles.edit', ['files' => $files]));
        });
    }

    /**
     * @return Content
     */
    public function addPage(){
        return Admin::content(function(Content $content) {
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.ImportantFiles.add'));
        });
    }

    public function add(Request $request){
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

    public function getFilesById($id){
        try{
            $notice = CommonFiles::findOrFail($id);
            return response()->json([
                'success'   => true,
                'info'      => Resources::CommonFiles($notice)
            ]);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['message' => 'Files not found']);
        }
    }
}