<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class Notification extends Model
{
    //
    protected $table = "twt_notification";
    protected $primaryKey = 'notice_id';

    // 创建时间字段
    const CREATED_AT = 'notice_time';

    protected $fillable = ['column_id', 'notice_title', 'notice_content', 'notice_filename', 'notice_filepath', 'notice_istop', 'author', 'notice_author', 'notice_ishidden', 'notice_isdeleted'];

    public function column(){
        return $this->belongsTo('App\Models\Column', 'column_id', 'column_id');
    }

    public function owner(){
        return $this->hasOne('App\Models\UserInfo', 'user_number', 'author');
    }

    //以下是党校公告专区
    /**
     * @param $type [70|71|72|73]
     * @return array
     */
    public static function getAllNotice($type){
        $res_arr = self::where('column_id', $type)->where('notice_isdeleted', 0)
            ->orderBy('notice_istop', 'desc')->orderBy('notice_ishidden', 'asc')->orderBy('notice_time', 'desc')
            ->get()->all();
        return array_map(function($notification){
            return Resources::Notification($notification);
        }, $res_arr);
    }

    /**
     * @param $notice_id
     * @param $data
     * @throws ModelNotFoundException
     * @return array|bool
     */
    public static function updateById($notice_id, $data){
        $notice = self::findOrFail($notice_id);
        $notice->notice_title           = $data['title'];
        $notice->notice_content         = $data['content'];
        $notice->notice_filename        = $data['fileName'] ?? $notice->notice_filename;
        $notice->notice_filepath        = $data['filePath'] ?? $notice->notice_filepath;
        $res = $notice->save();
        return $res ? Resources::Notification($notice) : false;
    }

    public static function add($data){
        $notice = self::create([
            'column_id'=>  $data['columnId'],
            'notice_title'     =>  $data['title'],
            'notice_content'   =>  $data['content'],
            'notice_filename'  =>  $data['fileName'],
            'notice_filepath'  =>  $data['filePath'],
            'notice_istop'     =>  0,
            'author'           =>  $data['author'],
            'notice_ishidden'  =>  0,
            'notice_isdeleted' =>  0
        ]);

        return $notice ? Resources::Notification($notice) : false;
    }


    //以下是活动通知专区
    public static function activityGetAllNotice(){
        $res_arr = self::where('column_id', 2)->where('notice_isdeleted', 0)
            ->orderBy('notice_istop', 'desc')->orderBy('notice_ishidden', 'asc')->orderBy('notice_time', 'desc')
            ->get()->all();
        return array_map(function($notification){
            return Resources::Notification($notification);
        }, $res_arr);
    }

    public static function activityUpdateById($activity_id, $data){
        $notice = self::findOrFail($activity_id);
        $notice->notice_title           = $data['title'];
        $notice->notice_content         = $data['content'];
        $notice->notice_filename        = $data['fileName'] ?? $notice->notice_filename;
        $notice->notice_filepath        = $data['filePath'] ?? $notice->notice_filepath;
        $res = $notice->save();
        return $res ? Resources::Notification($notice) : false;
    }

    public static function activityAdd($data){
        $notice = self::create([
            'column_id' => 2,
            'notice_title'     =>  $data['title'],
            'notice_content'   =>  $data['content'],
            'notice_filename'  =>  $data['fileName'],
            'notice_filepath'  =>  $data['filePath'],
            'notice_istop'     =>  0,
            'author'           =>  $data['author'],
            'notice_ishidden'  =>  0,
            'notice_isdeleted' =>  0
        ]);

        return $notice ? Resources::Notification($notice) : false;
    }

    //以下是前台模块了！！

    /**
     * 前台首页--取出最新4条通知
     * @param int $limit
     * @return array
     */
    public static function getIndexData($limit = 4){
        $res = self::where('notice_isdeleted', 0)
            ->orderBy('notice_istop', 'desc')
            ->orderBy('notice_time', 'desc')
            ->limit($limit)
            ->get()->all();
        return array_map(function($notification){
            return Resources::Notification($notification);
        }, $res);
    }

    /**
     * 根据id取出通知
     * @param $id
     * @return array
     */
    public static function getById($id){
        $res = self::where('notice_id', $id)
            ->get()->all();
        return array_map(function($notification){
            return Resources::Notification($notification);
        }, $res);
    }

    /**
     * 取出所有通知--带分页
     * @param $columnId
     * @return mixed
     * @internal param $type
     */
    public static function getAllNoticeByColumnIdWithPage($columnId){
        $res_arr = self::where('column_id', $columnId)->where('notice_isdeleted', 0)
            ->orderBy('notice_istop', 'desc')->orderBy('notice_ishidden', 'asc')->orderBy('notice_time', 'desc')
            ->paginate(6);

        foreach($res_arr as $i => $v){
            $res_arr[$i] = (function($v){
                $notice = Resources::Notification($v);
                $notice['content'] = htmlspecialchars_decode($notice['content']);
                $notice['content'] = str_limit(strip_tags($notice['content']), $limit = 100, $end = '...');
                return $notice;
            })($v);
        }
        return $res_arr;
    }
}
