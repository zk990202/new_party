<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFiles extends Model
{
    //
    protected $table = "twt_student_files";

    /**
     * 获取学生文件信息
     * @param $sno
     * @return mixed
     */
    public static function getStudentFile($sno){
        $res = self::where('sno', $sno)
            ->where('file_type', 1)
            ->whereIn('file_status', [1, 3])
            ->get()->toArray();
        return $res;
    }
}
