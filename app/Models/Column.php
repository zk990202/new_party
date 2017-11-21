<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\Resources;
class Column extends Model
{
    //
    protected $table = "twt_column";
    public $timestamps = false;

    /**
     * @param $pid
     * @return array
     */
    public static function getColumnsByParentId($pid){
        $columns = self::where('column_pid', $pid)->where('column_isdeleted', 0)
            ->get()->all();
        return array_map(function($column){
            return Resources::Column($column);
        }, $columns);
    }

    //以下是前台模块了！！！
    /**
     * 前台首页--党建专项--获取党建专项的id
     * @return mixed
     */
    public static function getSpecialId(){
        $res = self::where('column_pid', 3)
            ->where('column_isdeleted', 0)
            ->get()->toArray();
        return $res;
    }
}
