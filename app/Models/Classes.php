<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Classes extends Model
{
    //
    protected $table = "b_class";

    public static function getGrades(){
        $res = self::where('grade', '<>', 0)
            ->where('grade', '>', 2005)
            ->orderBy('grade', 'desc')
            ->select('grade')
            ->distinct()
            ->get()->toArray();
        return $res;
    }
}
