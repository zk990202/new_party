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
    // 1表示申请人,2表示院级,3表示预备党员
    const TYPE = [
        'APPLICANT'    => 1,
        'ACADEMY'      => 2,
        'PROBATIONARY' => 3
    ];

    public function testList(){
        return $this->belongsTo('App\Models\Applicant\TestList', 'test_id', 'test_id');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\UserInfo', 'from_sno', 'user_number');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'from_sno', 'usernumb');
    }

    public function college(){
        return $this->belongsTo('App\Models\College', 'collegeid', 'code');
    }

    //-------------------------------以下是申请人结业模块-------------------------------------------
    /**
     * 获取所有申诉
     * @return array
     */
    public static function getAll(){
        $res_all = self::where('type', 1)
            ->where('isreplay', 0)  //其实应该是reply，数据库里字段拼写错了
            ->orderBy('time', 'DESC')
            ->get()->all();
        return array_map(function ($complain){
            return Resources::Complain($complain);
        }, $res_all);
    }

    /**
     * 根据id取出指定的申诉并将阅读状态更新为已读 (此方法为三种类型的申诉所共用)
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
    public static function addReply($id, $sno, $title, $content, $type){
        $res = self::create([
            'from_sno' => $id,
            'to_sno' => $sno,
            'collegeid' => 0,
            'test_id' => 0,
            'title' => $title,
            'content' => $content,
            'type' => $type,
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

    //------------------------以下是院级积极分子模块----------------------------------------------
    /**
     * 获取所有申诉
     * @return array
     */
    public static function getAllAcademy(){
        $res_all = self::where('type', 2)
            ->where('isreplay', 0)  //其实应该是reply，数据库里字段拼写错了
            ->orderBy('time', 'DESC')
            ->get()->all();
        return array_map(function ($complain){
            return Resources::Complain($complain);
        }, $res_all);
    }

    //------------------------以下是预备党员模块------------------------------------------
    /**
     * 获取所有申诉
     * @return array
     */
    public static function getAllProbationary(){
        $res_all = self::where('type', 3)
            ->where('isreplay', 0)  //其实应该是reply，数据库里字段拼写错了
            ->orderBy('time', 'DESC')
            ->get()->all();
        return array_map(function ($complain){
            return Resources::Complain($complain);
        }, $res_all);
    }


    //下面就是前台的东西了

    /**
     * 院级积极分子培训的申诉
     * @param $sno
     * @param $college_id
     * @param $test_id
     * @param $title
     * @param $content
     * @return bool
     */
    public static function addComplainAcademy($sno, $college_id, $test_id, $title, $content){
        $res =self::create([
            'from_sno' => $sno,
            'to_sno' => '',
            'college_id' => $college_id,
            'test_id' => $test_id,
            'title' => $title,
            'content' => $content,
            'type' => 2,
            'isread' => 0
        ]);
        return $res ? true : false;
    }

    /**
     * 预备党员培训的申诉
     * @param $sno
     * @param $college_id
     * @param $test_id
     * @param $title
     * @param $content
     * @return bool
     */
    public static function addComplainProbationary($sno, $college_id, $test_id, $title, $content){
        $res =self::create([
            'from_sno' => $sno,
            'to_sno' => '',
            'college_id' => $college_id,
            'test_id' => $test_id,
            'title' => $title,
            'content' => $content,
            'type' => 3,
            'isread' => 0
        ]);
        return $res ? true : false;
    }

    /**
     * 根据学号获取申诉信息
     * @param $sno
     * @return mixed
     */
    public static function getComplainBySno($sno){
        $res = self::where('from_sno', $sno)
            ->orderBy('type')
            ->paginate(5);
        foreach($res as $i => $v){
            $res[$i] = (function($v){
                $complain = Resources::Complain($v);
                return $complain;
            })($v);
        }
        return $res;
    }

    /**
     * 根据id获取申诉信息--前台
     * @param $id
     * @return array
     */
    public static function getComplainByIdFront($id){
        $res = self::where('id', $id)
            ->first();
        return Resources::Complain($res);
    }
}
