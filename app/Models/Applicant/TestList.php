<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/8/26
 * Time: 9:05
 */

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\Resources;

class TestList extends Model {
    protected $table = "twt_applicant_testlist";
    protected $primaryKey = "test_id";
    const CREATED_AT = 'test_begintime';

    protected $fillable = ['test_name', 'test_begintime', 'test_attention', 'test_filename', 'test_filepath',
        'test_status', 'test_ishidden'];

    // 0未开始1报名开始,2报名截止,3成绩录入,4录入结束5,考试结束
    const TEST_STATUS = [
        'NOT_START' => 0,
        'STARTED'   => 1,
        'STOPPED'   => 2,
        'ENTERING'  => 3,
        'ENTERED'   => 4,
        'FINISHED'  => 5
    ];
    /**
     * 获取所有考试
     * @return array
     */
    public static function getAll(){
        $res_all = self::where('test_isdeleted', 0)
            ->orderBy('test_begintime', 'DESC')
            ->get()->all();

        return array_map(function ($testList){
            return Resources::TestList($testList);
        }, $res_all);
    }

    /**
     * 根据id获取考试
     * @param $id
     * @return array
     */
    public static function getExamById($id){
        $res = self::where('test_id', $id)
            ->where('test_isdeleted', 0)
            ->get()->all();

        return array_map(function ($testList){
            return Resources::TestList($testList);
        }, $res);
    }

    /**
     * 更新考试信息
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateById($id, $data){
        $exam = self::findOrFail($id);
        $exam->test_name = $data['name'];
        $exam->test_begintime = $data['time'];
        $exam->test_attention = $data['attention'];
        $exam->test_filename = $data['fileName'] ?? $exam->test_filename;
        $exam->test_filepath = $data['filePath'] ?? $exam->test_filepath;

        $res = $exam->save();
        return $res ? Resources::TestList($exam) : false;
    }

    /**
     * 添加考试
     * @param $data
     * @return array|bool
     */
    public static function add($data){
        $exam = self::create([
            'test_name' => $data['name'],
            'test_begintime' => $data['time'],
            'test_attention' => $data['attention'],
            'test_filename' => $data['fileName'] ?? "",
            'test_filepath' => $data['filePath'] ?? "",
            'test_status' => 0,
            'test_isdeleted' => 0
        ]);
        return $exam ? Resources::TestList($exam) : false;
    }

    /**
     * 取出状态处于成绩录入的考试
     * @return array
     */
    public static function gradeInput(){
        $test = self::where('test_status', 3)
            ->where('test_isdeleted', 0)
            ->get()->all();
        return array_map(function ($testList){
            return Resources::TestList($testList);
        }, $test);
    }


    /**
     * 判断考试是否开启报名
     * @return bool
     */
    public static function ifOpen(){
        $res = self::where('test_status', 1)
            ->where('test_isdeleted', 0)
            ->get()->toArray();
        return $res ? true : false;
    }

    public static function getActiveTest(){
        $res = self::where('test_status', 1)
            ->where('test_isdeleted', 0)
            ->first();
        if(!$res)
            return null;
        return Resources::TestList($res);
    }

    public static function warpStatus(&$item){
        if(isset($item['testStatus'])){
            $status = $item['testStatus'];
            switch($status){
                case self::TEST_STATUS['NOT_START']:
                    $item['testStatus'] = '尚未开始';
                    break;
                case self::TEST_STATUS['STARTED']:
                    $item['testStatus'] = '报名开始';
                    break;
                case self::TEST_STATUS['STOPPED']:
                    $item['testStatus'] = '报名结束';
                    break;
                case self::TEST_STATUS['ENTERING']:
                    $item['testStatus'] = '成绩录入中';
                    break;
                case self::TEST_STATUS['ENTERED']:
                    $item['testStatus'] = '成绩录入结束';
                    break;
                case self::TEST_STATUS['FINISHED']:
                    $item['testStatus'] = '考试结束';
                    break;
                default:
                    $item['testStatus'] = '未知状态';
            }
        }
    }


}