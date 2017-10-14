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

    /**
     * 判断报名是否已经退出
     * @param $id
     * @return array
     */
    public static function isExit($id){
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

}