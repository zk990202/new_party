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
}
