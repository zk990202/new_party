<?php

namespace App\Models\Probationary;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class TrainList extends Model
{
    //
    protected $table = "twt_probationary_trainlist";
    protected $primaryKey = "train_id";

    const CREATED_AT = "train_begintime";
    const UPDATED_AT = "updated_at";

    protected $fillable = ['train_name', 'train_begintime', 'train_filename', 'train_filepath',
        'train_detail', 'train_entry_status', 'train_netchoose_status', 'train_gradesearch_status',
        'train_endlist_show', 'train_goodmember_show', 'train_endinsert', 'train_isendinsert',
        'train_isend', 'train_isdeleted'];

//    public function CourseList(){
//        return $this->belongsTo('App\Models\Probationary\TrainList', 'train_id', 'train_id');
//    }

    /**
     * 获取所有培训
     * @return array
     */
    public static function getAll(){
        $res_all = self::where('train_isdeleted', 0)
            ->orderBy('train_id', 'desc')
            ->get()->all();
        return array_map(function($trainList){
            return Resources::ProbationaryTrainList($trainList);
        }, $res_all);
    }

    /**
     * 获取未结束的培训
     * @return array
     */
    public static function getNotEndTrain(){
        $res = self::where('train_isend', 1)
            ->orderBy('train_begintime', 'desc')
            ->orderBy('train_id', 'desc')
            ->get()->all();
        return array_map(function ($trainList){
            return Resources::ProbationaryTrainList($trainList);
        }, $res);
    }

    /**
     * 获取某一次培训
     * @param $id
     * @return array
     */
    public static function getOneTrain($id){
        $res = self::where('train_id', $id)
            ->get()->all();
        return array_map(function ($trainList){
            return Resources::ProbationaryTrainList($trainList);
        }, $res);
    }

    /**
     * 根据id更新培训
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateById($id, $data){
        $train = self::findOrFail($id);
        $train->train_name = $data['name'];
        $train->train_begintime = $data['time'];
        $train->train_detail = $data['detail'];
        $train->train_filename = $data['fileName'];
        $train->train_filepath = $data['filePath'];
        $res = $train->save();
        return $res ? Resources::ProbationaryTrainList($train) : false;
    }

    /**
     * 判断之前的培训是否结束，isend = 1 表示还在进行中
     * @return bool
     */
    public static function isEnd(){
        $res = self::where('train_isdeleted', 0)
            ->where('train_isend', 1)
            ->get()->toArray();
        if ($res){
            //未结束
            return true;
        }else{
            return false;
        }
    }

    /**
     * 添加培训
     * @param $data
     * @return array|bool
     */
    public static function addTrain($data){
        $train = self::create([
            'train_name' => $data['name'],
            'train_begintime' => $data['time'],
            'train_detail' => $data['detail'],
            'train_filepath' => $data['filePath'] ?? '',
            'train_filename' => $data['fileName'] ?? '',
            'train_isend' => 1
        ]);
        return $train ? Resources::ProbationaryTrainList($train) : false;
    }
}
