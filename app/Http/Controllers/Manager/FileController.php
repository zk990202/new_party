<?php

namespace App\Http\Controllers\Manager;

use App\Http\Helpers\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Support\Facades\Config;
use Mockery\Exception;

class FileController extends Controller
{
    // 图片上传配置文件
    protected $config;

    // 上传规则
    protected $rules;

    public function __construct()
    {
        $this->config = config('fileUpload');
        $this->rules = array_keys(config('fileUpload.rules'));
    }


    /**
     * 图片上传方法，配置参见config.fileUpload
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request){
        $usage = $request->input('usage');
        if(empty($usage) || !$this->checkUsage($usage)){
            return response()->json([
                'message' => '规则不符'
            ]);
        }

        if(!$request->hasFile('upload')){
            return response()->json([
                'message' => '上传失败'
            ]);
        }

        $file = $request->file('upload');
        $size = $file->getSize();
        $extension = $file->extension();

        if(!$this->checkExtension($extension, $usage)){
            return response()->json([
                'message' => '文件类型不符'
            ]);
        }

        if(!$this->checkFileSize($size, $usage)){
            return response()->json([
                'message' => '文件不能大于5M'
            ]);
        }
        $name = $file->getClientOriginalName();
        $disk = $this->config['rules'][$usage]['disk'];
        $path = $file->store($this->config['rules'][$usage]['path'], $disk);

        $file = File::createFile([
            'name'  => $name,
            'size'  => $size,
            'extension' => $extension,
            'path'  => $path,
            'usage' => $usage
        ]);

        return response()->json([
            'success' => true,
            'file' => config('filesystems.disks.'.$disk.'.url').'/'.$path,
            'info' => $file
        ]);
    }

    /**
     * @param $usage
     * @return bool
     */
    protected function checkUsage($usage){
        return in_array($usage, $this->rules);
    }

    /**
     * @param $extension
     * @param $usage
     * @return bool
     */
    protected function checkExtension($extension, $usage){
        return in_array($extension, $this->config['rules'][$usage]['extensions']);
    }

    /**
     * @param $size
     * @param $usage
     * @return bool
     */
    protected function checkFileSize($size, $usage){
        $max_size = $this->config['rules'][$usage]['max_size'] ?? $this->config['max_size'];
        return $size < $max_size;
    }


}
