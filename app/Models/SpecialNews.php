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

    protected $fillable = ['title', 'summary', 'content', 'inserttime', 'author', 'type', 'ima_path', 'isdeleted'];

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
        $news->img_path = $data['imgPath'] ?? $news->img_path;
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
            'img_path' => $data['imgPath'],
            'author' => $data['author'],
            'isrecommand' => 0,
            'isdeleted' => 0
        ]);
        return $news ? Resources::SpecialNews($news) : false;
    }
}