<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SpecialNews extends Model
{
    //
    protected $table = 'twt_specialnews';

    //创建时间字段
    const CREATED_AT = 'inserttime';

    protected $fillable = ['title', 'summary', 'content', 'inserttime', 'author', 'type', 'img_path', 'isdeleted'];

    /**
     * 模型的「启动」方法
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notDeleted', function(Builder $builder) {
            $builder->where('isdeleted', 0);
        });
    }

    public function column(){
        return $this->belongsTo('App\Models\Column', 'type', 'column_id');
    }

    public function owner(){
        return $this->hasOne('App\Models\UserInfo', 'user_number', 'author');
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
            'img_path' => $data['filePath'],
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

    public static function getNewsById($id){
        $res = self::where('id', $id)
            ->first();
        return $res ? Resources::SpecialNews($res) : null;
    }

    /**
     * 按照多个类别获取新闻
     * @param $type array
     * @param $limit integer
     * @return array
     */
    public static function newsByTypesLimit($type, $limit = 5){
        $res = self::whereIn('type', $type)
            ->orderBy('isrecommand', 'desc')
            ->orderBy('inserttime', 'desc')
            ->limit($limit)
            ->get()->all();
        return array_map(function ($specialNews){
            return Resources::SpecialNews($specialNews);
        }, $res);
    }

    /**
     * 按照单一类别获取新闻
     * @param $type
     * @param int $limit
     * @return array
     */
    public static function newsByTypeLimit($type, $limit = 5){
        $res = self::where('type', $type)
            ->whereNotNull('img_path')
            ->orderBy('isrecommand', 'desc')
            ->orderBy('inserttime', 'desc')
            ->limit($limit)
            ->get()->all();
        return array_map(function ($specialNews){
            return Resources::SpecialNews($specialNews);
        }, $res);
    }

    public static function newsByTypeWithPage($type, $perPage = 10){
        $res = self::where('type', $type)
            ->whereNotNull('img_path')
            ->orderBy('isrecommand', 'desc')
            ->orderBy('inserttime', 'desc')
            ->paginate($perPage);
        foreach($res as $i => $v){
            $res[$i] = (function($v){
                $notice = Resources::SpecialNews($v);
                $notice['content'] = htmlspecialchars_decode($notice['content']);
                $notice['content'] = str_limit(strip_tags($notice['content']), $limit = 100, $end = '...');
                return $notice;
            })($v);
        }
        return $res;
    }

//    public static function getIndexDataStudyGroup(){
//        $res = self::where('type', 1)
//            ->where('isrecommand',  1)
//            ->//            ->orderBy('inserttime', 'desc')
//            ->limit()
//    }
}