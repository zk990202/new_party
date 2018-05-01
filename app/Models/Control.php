<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    //
    protected $table = "twt_control";

    /**
     * 查询学生状态初始化的状态
     * @return null
     */
    public static function getStatusReset(){
        $res = self::where('name', 'statusreset')
            ->select('status')
            ->get()->toArray();
        return $res ? $res[0]['status'] : null;
    }
}
