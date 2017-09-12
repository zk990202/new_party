<?php

namespace App\Models\Academy;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestList
 * 院级分党校考试
 * @package App\Models\Academy
 */
class TestList extends Model
{
    //
    protected $table = 'twt_academy_testlist';
    protected $primaryKey = 'test_id';
    const CREATED_AT = 'test_begintime';

    protected $fillable = ['test_parent', 'test_name', 'test_of_academy', 'test_begintime', 'test_introduction',
        'test_attention', 'test_status', 'test_isdeleted'];

    public function college(){
        return $this->belongsTo('App\Models\College', 'test_of_academy', 'id');
    }

    public function testList(){
        return $this->belongsTo('App\Models\Academy\TestList', 'test_parent', 'test_id');
    }

    /**
     * 获取所有总培训
     * @return array
     */
    public static function getAllTrain(){
        $res_all = self::where('test_parent', 0)
            ->where('test_isdeleted', 0)
            ->orderBy('test_id', 'DESC')
            ->get()->all();
        return array_map(function ($testList){
            return Resources::AcademyTestList($testList);
        }, $res_all);
    }

    /**
     * 关闭子培训
     * @param $id
     * @return mixed
     */
    public static function closeTest($id){
        $res = self::where('test_parent', $id)
            ->update(['test_status' => 5]);
        return $res;
    }

    /**
     * 添加总培训
     * @param $name
     * @param $time
     * @return array|bool
     */
    public static function addTrain($name, $time){
        $train = self::create([
            'test_parent' => 0,
            'test_name' => $name,
            'test_begintime' => $time,
            'test_of_academy' => '',
            'test_attention' => '总培训添加',
            'test_status' => 0,
            'test_isdeleted' => 0
        ]);
        return $train ? Resources::AcademyTestList($train) : false;
    }

    /**
     * 获取所有子培训
     * @return array
     */
    public static function getAllTest(){
        $res_all = self::where('test_isdeleted', 0)
            ->where('test_parent', '>', 0)
//            ->where('test_status', '<', 5)
            ->orderBy('test_begintime', 'desc')
            ->orderBy('test_of_academy')
            ->orderBy('test_id', 'desc')
            ->get()->all();
        return array_map(function ($testList){
            return Resources::AcademyTestList($testList);
        }, $res_all);
    }

    /**
     * 查看子培训详情
     * @param $id
     * @return array
     */
    public static function TestDetail($id){
        $res = self::where('test_id', $id)
            ->get()->all();
        return array_map(function ($testList){
            return Resources::AcademyTestList($testList);
        }, $res);
    }

    /**
     * 编辑子培训
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function TestEdit($id, $data){
        $test = self::findOrFail($id);
        $test->test_name = $data['name'];
        $test->test_begintime = $data['time'];
        $test->test_introduction = $data['introduction'];
        $test->test_attention = $data['attention'];
        $res = $test->save();
        return $res ? Resources::AcademyTestList($test) : false;
//        if ($res){
//            return true;
//        }
    }

    public static function TestAdd($data){
        $test = self::create([
            'test_parent' => $data['id'],
            'test_name' => $data['name'],
            'test_of_academy' => $data['academyId'],
            'test_begintime' => $data['time'],
            'test_introduction' => $data['introduction'],
            'test_attention' => $data['attention'],
            'test_status' => 0,
            'test_isdeleted' => 0
        ]);
        return $test ? Resources::AcademyTestList($test) : false;
    }
}
