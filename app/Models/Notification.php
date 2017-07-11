<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\Resources;

class Notification extends Model
{
    //
    protected $table = "twt_notification";
    protected $primaryKey = 'notice_id';
    public $timestamps = false;
    public function column(){
        return $this->belongsTo('App\Models\Column', 'column_id', 'column_id');
    }

    public function owner(){
        return $this->hasOne('App\Models\User', 'usernumb', 'author');
    }

    /**
     * @param $type [70|71|72|73]
     * @return array
     */
    public static function getAllNotice($type){
        $res_arr = self::where('column_id', $type)->where('notice_isdeleted', 0)
            ->orderBy('notice_istop', 'desc')->orderBy('notice_ishidden', 'asc')->orderBy('notice_time', 'desc')
            ->get()->all();
        return array_map(function($notification){
            return Resources::Notification($notification);
        }, $res_arr);
    }
}
