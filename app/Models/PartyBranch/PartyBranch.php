<?php

namespace App\Models\PartyBranch;

use App\Http\Helpers\Resources;
use Illuminate\Database\Console\Migrations\ResetCommand;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PartyBranch
 * 党支部
 * @package App\Models\PartyBranch
 */
class PartyBranch extends Model
{
    //
    protected $table = "twt_partybranch";
    protected $primaryKey = 'partybranch_id';
    protected $fillable = ['partybranch_name', 'partybranch_secretary', 'partybranch_organizer', 'partybranch_propagator',
        'partybranch_academy', 'partybranch_type', 'partybranch_schoolyearyear', 'partybranch_establishtime',
        'partybranch_ishidden', 'partybranch_isdeleted', 'partybranch_total_score', 'partybranch_total_reply',
        'partybranch_total_topic', 'partybranch_total_act'];

    public $timestamps = true;

    const CREATED_AT = 'partybranch_establishtime';

    public function user_secretary(){
        return $this->belongsTo('App\Models\UserInfo', 'partybranch_secretary', 'user_number');
    }

    public function user_organizer(){
        return $this->belongsTo('App\Models\UserInfo', 'partybranch_organizer', 'user_number');
    }

    public function user_propagator(){
        return $this->belongsTo('App\Models\UserInfo', 'partybranch_propagator', 'user_number');
    }

    public function college_(){
        return $this->belongsTo('App\Models\College', 'partybranch_academy', 'id');
    }

    /**
     * 按学院
     * @param $college
     * @return array
     */
    public static function college($college){
        $res = array();
        foreach ($college as $i => $v){
            $res[$i]['college'] = $v->shortname;

            //本科生
            $undergraduate = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_academy', $v->id)
                ->where('partybranch_type', 1)
                ->get();
            $num_undergraduate = count($undergraduate);
            $res[$i]['undergraduate'] = $num_undergraduate;

            //硕士生
            $master = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_academy', $v->id)
                ->where('partybranch_type', 2)
                ->get();
            $num_master = count($master);
            $res[$i]['master'] = $num_master;

            //博士生
            $doctor = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_academy', $v->id)
                ->where('partybranch_type', 3)
                ->get();
            $num_doctor = count($doctor);
            $res[$i]['doctor'] = $num_doctor;

            //混合党支部
            $mix = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_academy', $v->id)
                ->where('partybranch_type', 1)
                ->get();
            $num_mix = count($mix);
            $res[$i]['mix'] = $num_mix;
        }
        return $res;
    }
    
    public static function grade($grade)
    {
        $res = array();
        foreach ($grade as $i => $v) {
            $res[$i]['grade'] = $v->grade;

            //本科生
            $undergraduate = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_schoolyearyear', $v->grade)
                ->where('partybranch_type', 1)
                ->get();
            $num_undergraduate = count($undergraduate);
            $res[$i]['undergraduate'] = $num_undergraduate;

            //硕士生
            $master = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_schoolyearyear', $v->grade)
                ->where('partybranch_type', 2)
                ->get();
            $num_master = count($master);
            $res[$i]['master'] = $num_master;

            //博士生
            $doctor = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_schoolyearyear', $v->grade)
                ->where('partybranch_type', 3)
                ->get();
            $num_doctor = count($doctor);
            $res[$i]['doctor'] = $num_doctor;

        }
        return $res;
    }

    public static function category(){
        //本科生
        $undergraduate = self::where('partybranch_ishidden', 0)
            ->where('partybranch_isdeleted', 0)
            ->where('partybranch_type', 1)
            ->get();
        $num_undergraduate = count($undergraduate);

        //硕士生
        $master = self::where('partybranch_ishidden', 0)
            ->where('partybranch_isdeleted', 0)
            ->where('partybranch_type', 2)
            ->get();
        $num_master = count($master);

        //博士生
        $doctor = self::where('partybranch_ishidden', 0)
            ->where('partybranch_isdeleted', 0)
            ->where('partybranch_type', 3)
            ->get();
        $num_doctor = count($doctor);

        //混合党支部
        $mix = self::where('partybranch_ishidden', 0)
            ->where('partybranch_isdeleted', 0)
            ->where('partybranch_type', 1)
            ->get();
        $num_mix = count($mix);

        return [
            'undergraduate' => $num_undergraduate,
            'master' => $num_master,
            'doctor' => $num_doctor,
            'mix' => $num_mix
        ];
    }

    /**
     * 获取所有学院每个学院的党支部数
     * @param $college
     * @return array
     */
    public static function getAllCount($college){
        $res = [];
        foreach ($college as $i => $v){
            $every = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_academy', $v['id'])
                ->orderBy('partybranch_id', 'desc')
                ->get();
            $res[$i]['id'] = $v['id'];
            $res[$i]['academyName'] = $v['collegename'];
            $res[$i]['count'] = count($every);
        }
        return $res;
    }

    /**
     * 获取所有的党支部
     * @param $academy_id
     * @return array
     */
    public static function getAll($academy_id){
        $res = self::where('partybranch_academy', $academy_id)
            ->where('partybranch_isdeleted', 0)
            ->where('partybranch_ishidden', 0)
            ->orderBy('partybranch_id', 'desc')
            ->get()->all();
        return array_map(function ($partyBranch){
            return Resources::PartyBranch($partyBranch);
        }, $res);
    }

    /**
     * 根据id获取一个党支部的信息
     * @param $branch_id
     * @return array
     */
    public static function getById($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->get()->all();
        return array_map(function ($partyBranch){
            return Resources::PartyBranch($partyBranch);
        }, $res);
    }

    /**
     * 更新支部书记
     * @param $branch_id
     * @param $sno
     * @return bool
     */
    public static function updateSecretary($branch_id, $sno){
        $res = self::where('partybranch_id', $branch_id)
            ->update(['partybranch_secretary' => $sno]);
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 更新组织委员
     * @param $branch_id
     * @param $sno
     * @return bool
     */
    public static function updateOrganizer($branch_id, $sno){
        $res = self::where('partybranch_id', $branch_id)
            ->update(['partybranch_organizer' => $sno]);
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 判断支部名称是否重名
     * @param $branch_id
     * @param $branch_name
     * @return bool
     */
    public static function ifNameExist($branch_id, $branch_name){
        $res = self::where('partybranch_name', $branch_name)
            ->where('partybranch_id', '<>', $branch_id)
            ->get()->toArray();
        return $res ? true : false;
    }

    /**
     * 更新支部名称
     * @param $branch_id
     * @param $branch_name
     * @return bool
     */
    public static function updateBranchName($branch_id, $branch_name){
        $res = self::where('partybranch_id', $branch_id)
            ->update(['partybranch_name' => $branch_name]);
        return $res ? true : false;
    }

    /**
     * 更新宣传委员
     * @param $branch_id
     * @param $sno
     * @return bool
     */
    public static function updatePropagator($branch_id, $sno){
        $res = self::where('partybranch_id', $branch_id)
            ->update(['partybranch_propagator' => $sno]);
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 删除支部
     * @param $branch_id
     * @return bool
     */
    public static function deleteBranch($branch_id){
        $res = self::where('partybranch_id', $branch_id)
            ->update(['partybranch_isdeleted' => 1]);
        return $res ? true : false;
    }

    /**
     * 支部查询
     * @param $academyId
     * @param $schoolYear
     * @param $type
     * @return array
     */
    public static function searchBranch($academyId, $schoolYear, $type){
        $res = [];
        if ($academyId && $schoolYear && $type){
            $res = self::where('partybranch_academy', $academyId)
                ->where('partybranch_schoolyear', $schoolYear)
                ->where('partybranch_type', $type)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_ishidden', 0)
                ->get()->all();
        }elseif ($academyId && $schoolYear && !$type){
            $res = self::where('partybranch_academy', $academyId)
                ->where('partybranch_schoolyear', $schoolYear)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_ishidden', 0)
                ->get()->all();
        }elseif ($academyId && !$schoolYear && $type){
            $res = self::where('partybranch_academy', $academyId)
                ->where('partybranch_type', $type)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_ishidden', 0)
                ->get()->all();
        }elseif (!$academyId && $schoolYear && $type){
            $res = self::where('partybranch_schoolyear', $schoolYear)
                ->where('partybranch_type', $type)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_ishidden', 0)
                ->get()->all();
        }elseif ($academyId && !$schoolYear && !$type){
            $res = self::where('partybranch_academy', $academyId)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_ishidden', 0)
                ->get()->all();
        }elseif (!$academyId && $schoolYear && !$type){
            $res = self::where('partybranch_schoolyear', $schoolYear)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_ishidden', 0)
                ->get()->all();
        }elseif (!$academyId && !$schoolYear && $type){
            $res = self::where('partybranch_type', $type)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_ishidden', 0)
                ->get()->all();
        }elseif (!$academyId && !$schoolYear && !$type){
            $res = self::where('partybranch_isdeleted', 0)
                ->where('partybranch_ishidden', 0)
                ->get()->all();
        }
        return array_map(function ($partyBranch){
            return Resources::PartyBranch($partyBranch);
        }, $res);
    }

    /**
     * 组建混合党支部
     * @param $data
     * @param $branchName
     * @return bool
     */
    public static function addMixBranch($data, $branchName){
        $res = self::create([
            'partybranch_name'	=>	$branchName ,
            'partybranch_academy'	=>	$data['academyId'] ,
            'partybranch_schoolyear' => '',
            'partybranch_type'	=>	4,
        ]);
        return $res ? true : false;
    }

    /**
     * 组建支部(本科，硕士，博士)
     * @param $data
     * @param $branchName
     * @return bool
     */
    public static function addBranch($data, $branchName){
        $res = self::create([
            'partybranch_name'	=>	$branchName ,
            'partybranch_academy'	=>	$data['academyId'] ,
            'partybranch_schoolyear' => $data['schoolYear'],
            'partybranch_type'	=>	$data['type'],
        ]);
        return $res ? true : false;
    }

    /**
     * 获取所有已隐藏的支部
     * @return array
     */
    public static function getAllHidedBranch(){
        $res = self::where('partybranch_ishidden', 1)
            ->where('partybranch_isdeleted', 0)
            ->orderBy('partybranch_id', 'desc')
            ->get()->all();
        return array_map(function ($partyBranch){
            return Resources::PartyBranch($partyBranch);
        }, $res);
    }

    /**
     * 按学院获取已隐藏的支部
     * @param $academyId
     * @return array
     */
    public static function getHidedBranchByAcademy($academyId){
        $res = self::where('partybranch_ishidden', 1)
            ->where('partybranch_academy', $academyId)
            ->where('partybranch_isdeleted', 0)
            ->orderBy('partybranch_id', 'desc')
            ->get()->all();
        return array_map(function ($partyBranch){
            return Resources::PartyBranch($partyBranch);
        }, $res);
    }

    //以下就是前台模块了！！！

    /**
     * 前台首页--支部风采，取出6条数据
     * @return array
     */
    public static function getIndexData(){
        $res = self::where('partybranch_isdeleted', 0)
            ->where('partybranch_ishidden', 0)
            ->orderBy('partybranch_id', 'desc')
            ->limit(6)
            ->get()->all();
        return array_map(function ($partyBranch){
            return Resources::PartyBranch($partyBranch);
        }, $res);
    }

    /**
     * 判断一个老师是不是支部干部
     * @param $usernumb
     * @return array
     */
    public static function isProbationary($usernumb){
        $res = self::where('partybranch_secretary', $usernumb)
            ->orWhere('partybranch_organizer', $usernumb)
            ->orWhere('partybranch_propagator', $usernumb)
            ->get()->all();
        return array_map(function ($partyBranch){
            return Resources::PartyBranch($partyBranch);
        }, $res)[0];
    }
}
