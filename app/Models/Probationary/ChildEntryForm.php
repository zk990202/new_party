<?php

namespace App\Models\Probationary;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class ChildEntryForm extends Model
{
    //
    protected $table = "twt_probationary_childentryform";
    protected $primaryKey = "entry_id";

    protected $fillable = ['child_entryid', 'child_sno', 'child_courseid', 'child_entrytime', 'child_status',
        'child_status', 'child_grade', 'isexit'];

    /**
     * 如果没有人选择该课程,则是允许隐藏和删除的,否则不允许删除
     * @param $id
     * @return bool
     */
    public static function isSomeoneChoose($id){
        $res = self::where('child_courseid', $id)
            ->get()->toArray();
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    public static function isExit($id){
        $res = self::where('child_courseid', $id)
            ->where('isexit', 0)
            ->get()->all();
        return array_map(function($childEntryForm){
            return Resources::ProbationaryChildEntryForm($childEntryForm);
        }, $res);
    }
}
