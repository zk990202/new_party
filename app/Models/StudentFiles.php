<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StudentFiles extends Model
{
    //
    protected $table = "twt_student_files";
    protected $primaryKey = "file_id";

    protected $fillable = ['sno', 'file_title', 'file_content', 'file_addtime', 'file_dealtime', 'file_type', 'file_status', 'is_systemadd'];

    const CREATED_AT = 'file_addtime';
    const UPDATED_AT = 'file_dealtime';

    protected $guarded = [];
    public $timestamps = true;
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


    /**
     * 学生信息管理--状态初始化--添加入党申请书
     * @param $sno
     * @return bool
     */
    public static function insertApplicantBookInStudentInfoInit($sno){
        $res = self::create([
            'sno' => $sno,
            'file_title' => '系统初始化',
            'file_content' =>'这是后台管理员在为你做系统初始化时添加的申请书,状态为通过!',
            'file_type' => 1,
            'file_status' => 1,
            'is_systemadd' => 1
        ]);
        return $res ? true : false;
    }

    /**
     * 学生信息管理--状态初始化--添加志愿书
     * @param $sno
     * @return bool
     */
    public static function insertVolunteerBookInStudentInfoInit($sno){
        $res = self::create([
            'sno' => $sno,
            'file_title' => '系统初始化',
            'file_content' =>'这是后台管理员在为你做系统初始化时添加的入党志愿书,状态为通过!',
            'file_type' => 10,
            'file_status' => 1,
            'is_systemadd' => 1
        ]);
        return $res ? true : false;
    }

    /**
     * 学生信息管理--状态初始化--添加转正申请书
     * @param $sno
     * @return bool
     */
    public static function insertTransFormBookInStudentInfoInit($sno){
        $res = self::create([
            'sno' => $sno,
            'file_title' => '系统初始化',
            'file_content' =>'这是后台管理员在为你做系统初始化时添加的转正申请,状态为通过!',
            'file_type' => 11,
            'file_status' => 1,
            'is_systemadd' => 1
        ]);
        return $res ? true : false;
    }

    /**
     *  根据类型获取文件
     * @param $sno
     * @param $type
     * @return array
     */
    public static function getFileByTypeOnly($sno, $type){
        $res = self::where('sno', $sno)
            ->where('file_type', $type)
            ->paginate(1);
        foreach($res as $i => $v){
            $res[$i] = (function($v){
                $file = Resources::StudentFiles($v);
                return $file;
            })($v);
        }
        return $res;
    }

    /**
     * 根据类型区间获取文件
     * @param $sno
     * @param $type_start
     * @param $type_end
     * @return mixed
     */
    public static function getFileByTypeBetween($sno, $type_start, $type_end){
        $res = self::where('sno', $sno)
            ->whereBetween('file_type', [$type_start, $type_end])
            ->paginate(1);
        foreach($res as $i => $v){
            $res[$i] = (function($v){
                $file = Resources::StudentFiles($v);
                return $file;
            })($v);
        }
        return $res;
    }

    public static function getFileById($id){
        $res = self::where('file_id', $id)
            ->first();
        return Resources::StudentFiles($res);
    }
}
