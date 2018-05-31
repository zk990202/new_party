<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;


class Summary extends Model
{
    //
    protected $table = "twt_summary";

    const CREATED_AT = 'file_addtime';
    const UPDATED_AT = 'file_dealtime';

    //0表示未处理1表示合格2表示驳回,3表示优秀
    const FILE_STATUS = [
        'UNPROCESSED' => 0,
        'QUALIFIED'   => 1,
        'REJECTED'    => 2,
        'EXCELLENT'   => 3
    ];

    public static function getSummaryByTypeBetween($sno, $type_start, $type_end){
        $res = self::where('sno', $sno)
            ->whereBetween('file_type', [$type_start, $type_end])
            ->paginate(1);
        foreach($res as $i => $v){
            $res[$i] = (function($v){
                $file = Resources::Summary($v);
                return $file;
            })($v);
        }
        return $res;
    }

    public static function getSummaryById($id){
        $res = self::where('file_id', $id)
            ->first();
        return Resources::Summary($res);
    }
}
