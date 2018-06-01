<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/6/1
 * Time: 11:54
 */

namespace App\Models;


use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'twt_message';
    protected $fillable = [];

    protected $primaryKey = 'message_id';
    const CREATED_AT = 'message_sendtime';
    const UPDATED_AT = null;

    public function fromUser(){
        return $this->belongsTo('App\Models\User', 'from_user_no', 'usernumb');
    }

    public function toUser(){
        return $this->belongsTo('App\Models\User', 'to_user_no', 'usernumb');
    }

    public static function getReceivedMessageByTypeAndSno($type, $sno){
        $res = self::whereIn('message_type', $type)
            ->where('to_user_no', $sno)
            ->paginate(6);
        foreach($res as $i => $v){
            $res[$i] = (function($v){
                $message = Resources::Message($v);
                return $message;
            })($v);
        }
        return $res;
    }

    public static function getSentMessageBySno($sno){
        $res = self::where('from_user_no', $sno)
            ->paginate(6);
        foreach($res as $i => $v){
            $res[$i] = (function($v){
                $message = Resources::Message($v);
                return $message;
            })($v);
        }
        return $res;
    }

    public static function getMessageById($id){
        $res = self::where('message_id', $id)
            ->first();
        return Resources::Message($res);
    }
}