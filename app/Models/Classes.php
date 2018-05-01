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

    /**
     * 获得入学年份是当前年份的学生的入学年份
     * @return mixed
     */
    public static function getInSchoolYearIsCurrentYear(){
        $current_year = date('Y');
        $res = self::where('grade', $current_year)
            ->select('grade')
            ->distinct()
            ->get()->toArray();
        return $res ? $res[0]['grade'] : null;
    }

}
