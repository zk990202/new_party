<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/9/24
 * Time: 10:26
 */

namespace App\Models\Probationary;


use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;
use function PHPSTORM_META\elementType;

class EntryForm extends Model
{
    //
    protected $table = "twt_probationary_entryform";
    protected $primaryKey = "entry_id";

    protected $fillable = ['sno', 'train_id', 'entry_practicegrade', 'entry_articlegrade', 'entry_time',
        'entry_islastadded', 'entry_status', 'entry_isallpassed', 'is_systemadd', 'cert_isgrant',
        'pass_must', 'pass_choose', 'exitcount', 'last_trainid', 'isexit', 'count_zuobi'];

    const CREATED_AT = 'entry_time';
    const UPDATED_AT = 'updated_at';

    public function studentInfo(){
        return $this->belongsTo('App\Models\StudentInfo', 'sno', 'sno');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\UserInfo','sno','usernumb');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'sno', 'usernumb');
    }

    public function trainList(){
        return $this->belongsTo('App\Models\Probationary\TrainList', 'train_id', 'train_id');
    }

    public function childEntryForm(){
        return $this->belongsTo('App\Models\Probationary\ChildEntryForm', 'entry_id', 'child_entryid');
    }

    /**
     * 判断报名是否已经退出
     * 根据trainId获取
     * @param $id
     * @return array
     */
    public static function getByTrainId($id){
        $res = self::where('train_id', $id)
            ->where('isexit', 0)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $res);
    }



    /**
     * 判断是否作弊，并更新字段
     * @param $data
     * @return bool
     */
    public static function isCheat($data){
        if (!$data['countCheat']){
            //没有作弊记录
            if ($data['passCompulsory'] >= 3 && $data['passElective'] >= 1 && $data['practiceGrade'] >= 60 && $data['articleGrade'] >= 60){
                $res = self::where('entry_id', $data['id'])
                    ->update(['entry_isallpassed' => 1]);
                if ($res){
                    return true;
                }else{
                    return false;
                }
            }
            else{
                return true;
            }
        }else{
            //有作弊记录, 清空该学生的成绩
            $res = self::where('entry_id', $data['id'])
                ->update([
                    'pass_must' => 0,
                    'pass_choose' => 0
                ]);
            if ($res){
                return true;
            }else{
                return false;
            }
        }
    }

    /**
     * 更新作弊次数
     * @param $id
     * @return bool
     */
    public static function updateCheatCount($id){
        $res = self::where('entry_id', $id)
            ->incerment('count_zuobi');
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 更新必修课状态
     * @param $id
     * @return bool
     */
    public static function updateCompulsory($id){
        $res = self::where('entry_id', $id)
            ->increment('pass_must');
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 更新选修课状态
     * @param $id
     * @return bool
     */
    public static function updateEletive($id){
        $res = self::where('entry_id', $id)
            ->increment('pass_choose');
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    public static function aHelp($id){
        $res = self::where('entry_id', $id)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $res);
    }

    /**
     * 根据培训id获取所有报名信息
     * @param $id
     * @return array
     */
    public static function getAllSign($id){
        $signs = self::where('train_id', $id)
            ->where('isdeleted', 0)
            ->orderBy('entry_id', 'desc')
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $signs);
    }

    /**
     * 根据培训id获取退报名信息
     * @param $id
     * @return array
     */
    public static function getExitSign($id){
        $signs = self::where('train_id', $id)
            ->where('isdeleted', 0)
            ->where('isexit', 1)
            ->orderBy('entry_id', 'desc')
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $signs);
    }

    /**
     * 判断学号对应学生是否全部通过
     * @param $sno
     * @return bool
     */
    public static function isAllPassed($sno){
        $sign = self::where('sno', $sno)
            ->where('entry_isallpassed', 1)
            ->get()->toArray();
        if ($sign){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 查看是否已经参加过本期考试
     * @param $sno
     * @param $train_id
     * @return bool
     */
    public static function isEntry($sno, $train_id){
        $res = self::where('sno', $sno)
            ->where('train_id', $train_id)
            ->get()->all();
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 添加报名信息
     * @param $sno
     * @param $trainId
     * @return array|bool
     */
    public static function add($sno, $trainId){
        $res = self::create([
            'sno' => $sno,
            'train_id' => $trainId,
            'entry_islastadded' => 1,
            'entry_time' =>date("Y-m-d H:i:s")
        ]);
        return $res ? Resources::ProbationaryEntryForm($res) : false;
    }

    /**
     * 更新多个学生成绩和状态
     * @param $data
     * @param $i
     * @return array|bool
     */
    public static function updateGradeAndStatus($data, $i){
        $entry = self::findOrFail($data['id'][$i]);
        $entry->entry_practicegrade = $data['practiceGrade'][$i];
        $entry->entry_articlegrade = $data['articleGrade'][$i];
        $entry->entry_status = $data['status'][$i];
        $res = $entry->save();
        return $res ? Resources::ProbationaryEntryForm($entry) : false;
    }

    /**
     * 更新一个学生成绩和状态
     * @param $data
     * @return array|bool
     */
    public static function updateOneGradeAndStatus($data){
        $entry = self::findOrFail($data['entryFormId']);
        $entry->entry_practicegrade = $data['practiceGrade'];
        $entry->entry_articlegrade = $data['articleGrade'];
        $entry->entry_status = $data['status'];
        $entry->pass_must = $data['passCompulsory'];
        $entry->pass_choose = $data['passElective'];
        $entry->entry_isallpassed = $data['isAllPassed'];
        $entry->count_zuobi = $data['countCheat'];
        $res = $entry->save();
        return $res ? Resources::ProbationaryEntryForm($entry) : false;
    }

    /**
     * 根据学号获取
     * @param $sno
     * @return array
     */
    public static function getBySno($sno){
        $entry = self::where('sno', $sno)
            ->orderBy('entry_id', 'desc')
            ->limit(1)
            ->get()->all();
        return array_map(function ($childEntryForm){
            return Resources::ProbationaryEntryForm($childEntryForm);
        }, $entry);
    }

    /**
     * 根据trainId和学号获取
     * @param $trainId
     * @param $sno
     * @return array
     */
    public static function getByTrainIdAndSno($trainId, $sno){
        $entry = self::where('train_id', $trainId)
            ->where('sno', $sno)
            ->get()->all();
        return array_map(function ($childEntryForm){
            return Resources::ProbationaryEntryForm($childEntryForm);
        }, $entry);
    }

    /**
     * 根据trainId和学院获取
     * @param $data
     * @return array
     */
    public static function getByTrainIdAndCollege($data){
        $entry = self::where('train_id', $data['trainId'])
//            ->where('twt_probationary_entryform.sno', '<>', 3014201052)
            ->leftJoin('twt_student_info', 'twt_probationary_entryform.sno', '=', 'twt_student_info.sno')
            ->where('academy_id', $data['academyId'])
            ->orderBy('entry_isallpassed', 'desc')
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $entry);
    }

    /**
     * 根据trainId和学院,学生结业状态获取
     * @param $data
     * @return array
     */
    public static function getByTrainIdAndCollegeAndStatus($data){
        $entry = self::where('train_id', $data['trainId'])
//            ->where('twt_probationary_entryform.sno', '<>', 3014201052)
            ->where('isAllPassed', $data['entryIsAllPassed'])
            ->leftJoin('twt_student_info', 'twt_probationary_entryform.sno', '=', 'twt_student_info.sno')
            ->where('academy_id', $data['academyId'])
            ->orderBy('entry_isallpassed', 'desc')
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $entry);
    }

    /**
     * 某一考试中考生的最大id
     * @param $trainId
     * @return mixed
     */
    public static function getMaxEntryId($trainId){
        $max = self::where('train_id', $trainId)
            ->max('entry_id');
        return $max;
    }

    /**
     * 某一考试中考生的最大id
     * @param $trainId
     * @return mixed
     */
    public static function getMinEntryId($trainId){
        $min = self::where('train_id', $trainId)
            ->min('entry_id');
        return $min;
    }

    /**
     * 获取考试合格但未发放证书的学生列表
     * @param $trainId
     * @param $academyId
     * @return array
     */
    public static function getCert($trainId, $academyId){
        $res = self::where('train_id', $trainId)
            ->where('cert_isgrant', 0)
            ->whereIn('entry_isallpassed', [1, 2])
            ->where('entry_status', 1)
            ->where('isexit', 0)
            ->leftJoin('twt_student_info', 'twt_probationary_entryform.sno', '=', 'twt_student_info.sno')
            ->where('academy_id', $academyId)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $res);
    }

    /**
     * 根据学号获取entry_id
     * @param $sno
     * @return mixed
     */
    public static function getEntryId($sno){
        $res = self::where('sno', $sno)
            ->select('entry_id')
            ->get()->toArray();
        return $res[0];
    }

    /**
     * 更新证书
     * @param $sno
     * @param $i
     * @return mixed
     */
    public static function updateCert($sno, $i){
        $res = self::where('sno', $sno[$i])
            ->update(['cert_isgrant' => 1]);
        return $res;
    }

    /**
     * @param $sno
     * @param $trainId
     * @return array
     */
    public static function getGradeBySnoAndTestId($sno, $trainId){
        $res = self::where('sno', $sno)
            ->where('train_id', $trainId)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $res);
    }

    //下面就是前台了‘’‘’‘’‘’

    /**
     * 判断学生是否已经报名
     * @param $sno
     * @param $train_id
     * @return array
     */
    public static function isSign($sno, $train_id){
        $res = self::where('train_id', $train_id)
            ->where('sno', $sno)
            ->where('isexit', 0)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $res);
    }

    /**
     * 退课
     * @param $entry_id
     * @return bool
     */
    public static function courseExit($entry_id){
        $res = self::where('entry_id')
            ->increment('exitcount');
        return $res ? true : false;
    }

    public static function getBySnoAndTrainId($sno, $trainId){
        $res = self::where('sno', $sno)
            ->where('train_id', $trainId)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $res);
    }

    /**
     * 是否已经通过考试
     * @param $sno
     * @return array
     */
    public static function isPass($sno){
        $res = self::where('sno', $sno)
            ->where('entry_isallpassed', 1)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $res);
    }

    /**
     * 前台报名
     * @param $sno
     * @param $train_id
     * @return bool
     */
    public static function sign($sno, $train_id){
        $res = self::create([
            'sno' => $sno,
            'train_id' => $train_id
        ]);
        return $res ? true : false;
    }

    /**
     * 报名结果
     * @param $sno
     * @return array
     */
    public static function signResult($sno){
        $res = self::leftJoin('twt_probationary_trainlist', 'twt_probationary_entryform.train_id', '=', 'twt_probationary_trainlist.train_id')
            ->where('train_isdeleted', 0)
            ->where('train_isend', 1)
            ->where('sno', $sno)
            ->get()->all();
        return array_map(function ($entryForm){
            return Resources::ProbationaryEntryForm($entryForm);
        }, $res);
    }

    /**
     * 退出考试
     * @param $entry_id
     * @return bool
     */
    public static function signExit($entry_id){
        $res = self::where('entry_id', $entry_id)
            ->update(['isexit' => 1]);
        return $res ? true : false;
    }
}