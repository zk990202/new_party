<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class SpecialNews extends Model
{
    //
    protected $table = 'twt_specialnews';

    //创建时间字段
    const CREATED_AT = 'inserttime';

    protected $fillable = ['title', 'summary', 'content', 'inserttime', 'author', 'type', 'img_path', 'isdeleted'];

    public function column(){
        return $this->belongsTo('App\Models\Column', 'type', 'column_id');
    }

    public function owner(){
        return $this->hasOne('App\Models\User', 'usernumb', 'author');
    }

    /*以下为党建专项模块---------------------------------------------------------------------------------------------------*/
    /**
     * 获取所有新闻
     * @return array
     */
    public static function getAllNews(){
        $res_arr = self::whereIn('type', [75, 78, 81, 83])
            ->orderBy('isrecommand', 'DESC')
            ->orderBy('isdeleted', 'ASC')
            ->orderBy('inserttime', 'DESC')
            ->get()->all();

        return array_map(function($SpecialNews){
            return Resources::SpecialNews($SpecialNews);
        }, $res_arr);
    }

    /**
     * 更新
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateById($id, $data){
        $news = self::findOrFail($id);
        $news->title = $data['title'];
        $news->content = $data['content'];
        $news->img_path = $data['imgPath'] ?? $news->img_path;
        $res = $news->save();
        return $res ? Resources::SpecialNews($news) : false;
    }

    /**
     * 添加
     * @param $data
     * @return array|bool
     */
    public static function add($data){
        $news = self::create([
            'type' => $data['type'],
            'title' => $data['title'],
            'content' => $data['content'],
            'img_path' => $data['imgPath'],
            'author' => $data['author'],
            'isrecommand' => 0,
            'isdeleted' => 0
        ]);
        return $news ? Resources::SpecialNews($news) : false;
    }
    
    /*以下为学习小组模块--------------------------------------------------------------------------------------------*/
    /**
     * 获取所有新闻
     * @return array
     */
    public static function getAllNewsStudy(){
        $res_arr = self::where('type', 1)
            ->orderBy('isrecommand', 'DESC')
            ->orderBy('isdeleted', 'ASC')
            ->orderBy('inserttime', 'DESC')
            ->get()->all();

        return array_map(function($SpecialNews){
            return Resources::SpecialNews($SpecialNews);
        }, $res_arr);
    }

    /**
     * 更新
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateByIdStudy($id, $data){
        $news = self::findOrFail($id);
        $news->title = $data['title'];
        $news->content = $data['content'];
        $news->img_path = $data['filePath'] ?? $news->img_path;
        $res = $news->save();
        return $res ? Resources::SpecialNews($news) : false;
    }

    /**
     * 添加
     * @param $data
     * @return array|bool
     */
    public static function addStudy($data){
        $news = self::create([
            'type' => 1,
            'title' => $data['title'],
            'content' => $data['content'],
            'img_path' => $data['filePath'],
            'author' => $data['author'],
            'isrecommand' => 0,
            'isdeleted' => 0
        ]);
        return $news ? Resources::SpecialNews($news) : false;
    }

    /*以下为党校培训模块--------------------------------------------------------------------------------------------*/
    /**
     * 获取所有新闻
     * @return array
     */
    public static function getAllNewsSchool(){
        $res_arr = self::where('type', 2)
            ->orderBy('isrecommand', 'DESC')
            ->orderBy('isdeleted', 'ASC')
            ->orderBy('inserttime', 'DESC')
            ->get()->all();

        return array_map(function($SpecialNews){
            return Resources::SpecialNews($SpecialNews);
        }, $res_arr);
    }

    /**
     * 更新
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateByIdSchool($id, $data){
        $news = self::findOrFail($id);
        $news->title = $data['title'];
        $news->content = $data['content'];
        $news->img_path = $data['imgPath'] ?? $news->img_path;
        $res = $news->save();
        return $res ? Resources::SpecialNews($news) : false;
    }

    /**
     * 添加
     * @param $data
     * @return array|bool
     */
    public static function addSchool($data){
        $news = self::create([
            'type' => 2,
            'title' => $data['title'],
            'content' => $data['content'],
            'img_path' => $data['imgPath'],
            'author' => $data['author'],
            'isrecommand' => 0,
            'isdeleted' => 0
        ]);
        return $news ? Resources::SpecialNews($news) : false;
    }

    //下面为前台的模块了！！

    /**
     * 前台首页--获取6条党建专项数据
     * @param $type
     * @return array
     */
    public static function getIndexDataPartyBuild($type){
        $res = self::whereIn('type', $type)
            ->where('isdeleted', 0)
            ->orderBy('inserttime', 'desc')
            ->limit(6)
            ->get()->all();
        return array_map(function ($specialNews){
            return Resources::SpecialNews($specialNews);
        }, $res);
    }

    /**
     * 前台首页--获取5条党校培训数据
     * @return array
     */
    public static function getIndexDataPartySchool(){
        $res = self::where('type', 2)
            ->where('isrecommand', 1)
            ->where('isdeleted', 0)
            ->orderBy('inserttime', 'desc')
            ->limit(5)
            ->get()->all();
        return array_map(function ($specialNews){
            return Resources::SpecialNews($specialNews);
        }, $res);
    }

//    public static function getIndexDataStudyGroup(){
//        $res = self::where('type', 1)
//            ->where('isrecommand',  1)
//            ->where('isdeleted', 0)
//            ->orderBy('inserttime', 'desc')
//            ->limit()
//    }
}