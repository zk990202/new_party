<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Resources;
use App\Models\CommonFiles;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class ImportantFilesController extends Controller{

    protected $imgExtension;
    protected $imgUsage = "importantFilesFile";

    public function __construct()
    {
        $this->imgExtension = config('fileUpload.');
    }

    /**
     * 列出所有的重要文件
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lists(){
        $files_arr = CommonFiles::getAll();
        return view('Manager.ImportantFiles.all', ['files' => $files_arr]);
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
        $img_path = $request->input('filePath') ?? null;
        try{
            $res = CommonFiles::updateById($id, [
                // 防止编辑器xss攻击，这里进行编码，同时避免二次编码
                'content' => htmlspecialchars($content, ENT_COMPAT | ENT_HTML401, ini_get("default_charset") , false) ,
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
                'message' => '公告id有误，未找到'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage($id){
        $files = CommonFiles::findOrFail($id);
        $files = Resources::CommonFiles($files);
        return view('Manager.ImportantFiles.edit', ['files' => $files]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addPage(){
        return view('Manager.ImportantFiles.add');
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
}