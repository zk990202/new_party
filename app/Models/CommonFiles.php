<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CommonFiles extends Model{

    protected $table = 'twt_commonfiles';
    protected $primaryKey = 'file_id';

    //创建时间字段
    const CREATED_AT = 'file_addtime';

    protected $fillable = ['file_title', 'file_content', 'file_addtime', 'file_type', 'file_img', 'file_isdeleted'];

    // 文件类别
    const REGULAR_FILE = 2;
    const INSTRUMENT_FILE = 4;
    const MUST_READ_FILE = 5;
    const MANUAL_FILE = 6;

    /**
     * 模型的「启动」方法
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notDeleted', function(Builder $builder) {
            $builder->where('file_isdeleted', 0);
        });
    }

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
            ->orderBy('file_addtime', 'DESC')
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
        $files = self::get()->all();
        return array_map(function ($commonFiles){
            return Resources::CommonFiles($commonFiles);
        }, $files);
    }

    public static function getFilesByTypeWithPage($type, $perPage = 10){
        $files = self::where('file_type', $type)
            ->orderBy('file_addtime', 'DESC')
            ->paginate($perPage);

        foreach($files as $i => $v){
            $files[$i] = (function($v){
                $notice = Resources::CommonFiles($v);
                $notice['content'] = htmlspecialchars_decode($notice['content']);
                $notice['content'] = str_limit(strip_tags($notice['content']), $limit = 100, $end = '...');
                return $notice;
            })($v);
        }

        return $files;
    }

}