<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $table = "twt_report";

    const CREATED_AT = 'file_addtime';
    const UPDATED_AT = 'file_dealtime';

    const FILE_TYPE = [
        'REPORT_1'  => 2,
        'REPORT_2'  => 3,
        'REPORT_3'  => 4,
        'REPORT_4'  => 5,
    ];

    //0表示未处理1表示合格2表示驳回,3表示优秀
    const FILE_STATUS = [
        'UNPROCESSED' => 0,
        'QUALIFIED'   => 1,
        'REJECTED'    => 2,
        'EXCELLENT'   => 3
    ];

    public static function getReportByTypeBetween($sno, $type_start, $type_end){
        $res = self::where('sno', $sno)
            ->whereBetween('file_type', [$type_start, $type_end])
            ->orderBy('file_type', 'desc')
            ->paginate(5);
        foreach($res as $i => $v){
            $res[$i] = (function($v){
                $file = Resources::Report($v);
                return $file;
            })($v);
        }
        return $res;
    }

    public static function getReportById($id){
        $res = self::where('file_id', $id)
            ->first();
        return Resources::Report($res);
    }
}
