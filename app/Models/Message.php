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
    protected $guarded = [];

    protected $primaryKey = 'message_id';
    const CREATED_AT = 'message_sendtime';
    const UPDATED_AT = null;

    public function fromUser(){
        return $this->belongsTo('App\Models\User', 'from_user_no', 'usernumb');
    }

    public function toUser(){
        return $this->belongsTo('App\Models\User', 'to_user_no', 'usernumb');
    }

    //type
    //0表示学生发给管理员 ,1表示老师发给所有用户,2表示发给所有学生,3表示发给全部管理员4表示发给全部支部委员,5表示发给指定用户

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

    /**
     * 学生写信给书记或院级管理员、超级管理员
     * @param $from
     * @param $type
     * @param $message
     * @return bool
     */
    public static function studentSendMessage($from, $message, $type){
        $res = self::create([
            'from_user_no' => $from,
            'to_user_no'   => $message['to_user'],
            'message_title'=> $message['title'],
            'message_content' => $message['content'],
            'message_type'  => $type,
            'message_isread' => 0,
            'message_ishandled' => 0,
            'message_isdeleted' => 0
        ]);
        return $res ? true : false;
    }
}