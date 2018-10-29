<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //
    protected $table = "twt_manager";

    protected $primaryKey = 'manager_id';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User', 'manager_name', 'twtname');
    }

    /**
     * 获取院级管理员
     * @param $id
     * @return mixed
     */
    public static function getCollegeManagerByCollegeId($id){
        $res = self::where('manager_academy', $id)
            ->where('manager_type', 120)
            ->where('manager_status', 0)
            ->where('manager_isdeleted', 0)
            ->get()->all();
        return array_map(function ($manager){
            return Resources::Manager($manager);
        }, $res);
//        return $res ? Resources::Manager($res) : null;
    }
}
