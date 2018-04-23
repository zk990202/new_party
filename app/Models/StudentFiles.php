<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFiles extends Model
{
    //
    protected $table = "twt_student_files";

    protected $guarded = [];
    public $timestamps = false;
    //文件类型1表示申请书2表示思想汇报一3表示思想汇报二,4表示思想汇报三,5表示思想汇报四,6表示个人小结一,7表示个人小结二,8表示个人小结三,9表示个人小结四,10表示入党志愿书11表示转正申请
    const FILE_TYPE = [
        'APPLICANT' => 1,
        'REPORT_1'  => 2,
        'REPORT_2'  => 3,
        'REPORT_3'  => 4,
        'REPORT_4'  => 5,
        'PERSONAL_SUMMARY_1' => 6,
        'PERSONAL_SUMMARY_2' => 7,
        'PERSONAL_SUMMARY_3' => 8,
        'PERSONAL_SUMMARY_4' => 9,
        'VOLUNTEER_BOOK'     => 10,
        'CORRECT_APPLICATION'=> 11
    ];

    //0表示未处理1表示合格2表示驳回,3表示优秀
    const FILE_STATUS = [
        'UNPROCESSED' => 0,
        'QUALIFIED'   => 1,
        'REJECTED'    => 2,
        'EXCELLENT'   => 3
    ];

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

    public static function getStudentFiles($sno, $type, $status){
        $res = self::where('sno', $sno)
            ->where('file_type', $type)
            ->whereIn('file_status', $status)
            ->get()->toArray();
        return $res;
    }
}
