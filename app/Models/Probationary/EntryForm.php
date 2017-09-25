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

}