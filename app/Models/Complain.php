<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    //
    protected $table = "twt_complain";
    const CREATED_AT = 'time';

    protected $fillable = ['from_sno', 'to_sno', 'collegeid', 'test_id', 'title', 'content', 'type',
        'time', 'isread', 'isreplay'];

    public function testList(){
        return $this->belongsTo('App\Models\Applicant\TestList', 'test_id', 'test_id');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\UserInfo', 'from_sno', 'usernumb');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'from_sno', 'usernumb');
    }

    public function college(){
        return $this->belongsTo('App\Models\College', 'collegeid', 'id');
    }

    /**
     * 获取所有申诉
     * @return array
     */
    public static function getAll(){
        $res_all = self::where('type', 1)
            ->where('isreplay', 0)
            ->orderBy('time', 'DESC')
            ->get()->all();
        return array_map(function ($complain){
            return Resources::Complain($complain);
        }, $res_all);
    }

    /**
     * 根据id取出指定的申诉并将阅读状态更新为已读
     * @param $id
     * @return array
     */
    public static function getComplainById($id){
        $complain = self::findOrFail($id);
        $complain->isread = 1;
        $complain->save();
        $res = self::where('id', $id)
            ->get()->all();
//        dd($res);
        return array_map(function ($complain){
            return Resources::Complain($complain);
        }, $res);
    }

    /**
     * 回复申诉
     * @param $id
     * @param $sno
     * @param $title
     * @param $content
     * @return array|bool
     */
    public static function addReply($id, $sno, $title, $content){
        $res = self::create([
            'from_sno' => $id,
            'to_sno' => $sno,
            'collegeid' => 0,
            'test_id' => 0,
            'title' => $title,
            'content' => $content,
            'type' => 1,
            'time' =>date('Y-m-d H:i:s'),
            'isread' => 0,
            'isreplay' => 1
        ]);

        //这里是判断申诉是否被回复，未回复to_sno为空，已回复把to_sno设为1
        $complain = self::findOrFail($id);
        $complain->to_sno = 1;
        $complain->save();

        return $res ? Resources::Complain($res) : false;
    }

    /**
     * 获取回复
     * @param $id
     * @return array
     */
    public static function getReply($id){
        $res = self::where('from_sno', $id)
            ->get()->all();
        return array_map(function($complain){
            return Resources::Complain($complain);
        }, $res);
    }
}
