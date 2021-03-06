<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    //
    protected $table = "b_college";

    public static function getAll(){
        $res = self::where('state', 'ok')
            ->where('code', '!=', 220)
            ->where('code', '>=', 201)
            ->where('code', '<=', 231)
            ->get()->toArray();
        return $res;
    }

    public static function getById($id){
        $res = self::where('state', 'ok')
            ->where('code', '!=', 220)
            ->where('code', '>=', 201)
            ->where('code', '<=', 231)
            ->where('id', $id)
            ->get()->toArray();
        return $res;
    }

    /**
     * 学院代号的转换
     * @param $code
     * @return mixed
     */
    public static function codeToId($code){
        $res = self::where('code', $code)
            ->get()->toArray();
        return $res[0]['id'];
    }

}
