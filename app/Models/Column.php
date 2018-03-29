<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\Resources;
class Column extends Model
{
    //
    protected $table = "twt_column";
    public $timestamps = false;

    const PARTY_BUILD_ID = 3;
    const PARTY_SCHOOL_ID = 2;
    const PARTY_NOTIFICATION_ID = 1;

    const APPLICANT_ID = 70;
    const ACADEMY_ID = 71;
    const PROBATIONARY_ID = 72;
    const SECRETARY_ID = 73;

    /**
     * @param $pid
     * @return array
     */
    public static function getColumnsByParentId($pid){
        $columns = self::where('column_pid', $pid)->where('column_isdeleted', 0)
            ->get()->all();
        return array_map(function($column){
            return Resources::Column($column);
        }, $columns);
    }

    /**
     * 获取子栏目ID
     * @return array
     */
    public static function getChildIds($id){
        $t = self::where('column_pid', $id)
            ->where('column_isdeleted', 0)
            ->get()->toArray();

        $res = [];
        foreach($t as $item){
            $res[] = $item['column_id'];
        }
        return $res;
    }




}
