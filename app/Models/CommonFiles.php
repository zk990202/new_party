<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class CommonFiles extends Model{

    protected $table = 'twt_commonfiles';
    protected $primaryKey = 'file_id';

    //创建时间字段
    const CREATED_AT = 'file_addtime';

    protected $fillable = ['file_title', 'file_content', 'file_addtime', 'file_type', 'file_img', 'file_isdeleted'];

    //以下为重要文件模块

    /**
     * 获取所有重要文件
     * @return array
     */
    public static function getAll(){
        $res_arr = self::whereBetween('file_type', [1, 6])
            ->orderBy('file_isdeleted', 'ASC')
            ->orderBy('file_addtime', 'DESC')
            ->get()->all();

        return array_map(function ($CommonFiles){
            return Resources::CommonFiles($CommonFiles);
        }, $res_arr);

//        dd(array_map(function ($CommonFiles){
//            return Resources::CommonFiles($CommonFiles);
//        }, $res_arr));
    }

    /**
     * 更新
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateById($id, $data){
        $files = self::findOrFail($id);
        $files->file_title = $data['title'];
        $files->file_content = $data['content'];
        $files->file_img = $data['filePath'] ?? $files->file_img;
        $res = $files->save();
        return $res ? Resources::CommonFiles($files) : false;
    }

    /**
     * 添加
     * @param $data
     * @return array|bool
     */
    public static function add($data){
        $files = self::create([
            'file_type' => $data['type'],
            'file_title' => $data['title'],
            'file_content' => $data['content'],
            'file_img' => $data['filePath'],
            'file_isdeleted' => 0
        ]);
        return $files ? Resources::CommonFiles($files) : false;
    }


    //以下是理论学习模块
    public static function getAllContents(){
        $res_arr = self::whereBetween('file_type', [7, 9])
            ->orderBy('file_isdeleted', 'ASC')
            ->orderBy('file_type', 'ASC')
            ->orderBy('file_id', 'DESC')
            ->get()->all();

        return array_map(function ($CommonFiles){
            return Resources::CommonFiles($CommonFiles);
        }, $res_arr);
    }

    public static function addVideo($data){
        $files = self::create([
            'file_type' => $data['type'],
            'file_title' => $data['title'],
            'file_img' => $data['filePath'],
            'file_isdeleted' => 0
        ]);
        return $files ? Resources::CommonFiles($files) : false;
    }

    /**
     * 添加选修课的文件
     * @return array
     */
    public static function getAddElective(){
        $files = self::where('file_isdeleted', 0)
            ->get()->all();
        return array_map(function ($commonFiles){
            return Resources::CommonFiles($commonFiles);
        }, $files);
    }

}