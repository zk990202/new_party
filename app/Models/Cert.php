<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Cert extends Model
{
    //
    protected $table = "twt_cert";
    protected $primaryKey = 'cert_id';

    const CREATED_AT = 'cert_time';
    const UPDATED_AT = 'updated_at';

    //1表示申请人的。2表示院级的3表示预备党员的
    const CERT_APPLICANT = 1;
    const CERT_ACADEMY = 2;
    const CERT_PROBATIONARY = 3;


    protected $fillable = ['sno', 'entry_id', 'cert_no', 'cert_type', 'cert_time', 'cert_getperson', 'cert_place',
        'cert_islost', 'isdeleted'];

    /**
     * 模型的「启动」方法
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notDeleted', function(Builder $builder) {
            $builder->where('isdeleted', 0);
        });
    }

    public function studentInfo(){
        return $this->belongsTo('App\Models\StudentInfo', 'sno','sno');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\UserInfo','sno','user_number');
    }

    public function user(){
        return $this->belongsTo('App\Models\UserInfo', 'sno', 'user_number');
    }

    public function entryForm(){
        return $this->belongsTo('App\Models\Applicant\EntryForm', 'entry_id', 'entry_id');
    }

    public function entryFormAcademy(){
        return $this->belongsTo('App\Models\Academy\EntryForm', 'entry_id', 'entry_id');
    }

    public function entryFormProbationary(){
        return $this->belongsTo('App\Models\Probationary\EntryForm', 'entry_id', 'entry_id');
    }

    /**
     * 申请人结业考试--获取证书
     * @param $max
     * @param $min
     * @param $college
     * @return array
     */
    public static function getCert($max, $min, $college){
        $res_all = self::whereBetween('entry_id', [$min, $max])
            ->where('cert_type', 1)
            ->leftJoin('twt_student_info', 'twt_cert.sno', '=', 'twt_student_info.sno')
            ->where('academy_id', $college)
            ->get()->all();
        return array_map(function ($cert){
            return Resources::Cert($cert);
        }, $res_all);
    }

    /**
     * 批量发放证书
     * @param $sno
     * @param $entryId
     * @param $getPerson
     * @param $place
     * @param $i
     * @return array|bool
     */
    public static function addCert($sno, $entryId, $getPerson, $place, $i){
        $cert = self::create([
            'sno' => $sno[$i],
            'entry_id' => $entryId[$i]['entry_id'],
            'cert_no' => date('ymdHis') + $i,
            'cert_type' => 1,
            'cert_time' => date('Y-m-d H:i:s'),
            'cert_getperson' => $getPerson,
            'cert_place' => $place,
            'cert_islost' => 0,
            'isdeleted' => 0
        ]);

        return $cert ? Resources::Cert($cert) : false;
    }

    /**
     * 补办证书 (此方法为所有证书类型共用)
     * @param $sno
     * @param $entryId
     * @param $getPerson
     * @param $place
     * @param $certType
     * @return array|bool
     */
    public static function addLastCert($sno, $entryId, $getPerson, $place, $certType){
        $cert = self::create([
            'sno' => $sno,
            'entry_id' => $entryId['entry_id'],
            'cert_no' => date('ymdHis'),
            'cert_type' => $certType,
            'cert_time' => date('Y-m-d H:i:s'),
            'cert_getperson' => $getPerson,
            'cert_place' => $place,
            'isdeleted' => 0
        ]);
        return $cert ? Resources::Cert($cert) : false;
    }

    //-----------------院级积极分子培训-----------------------
    /**
     * 院级积极分子培训--获取证书
     * @param $max
     * @param $min
     * @return array
     */
    public static function getCertAcademy($max, $min){
        $res_all = self::whereBetween('entry_id', [$min, $max])
            ->where('cert_type', 2)
            ->get()->all();
        return array_map(function ($cert){
            return Resources::ProbationaryCert($cert);
        }, $res_all);
    }

    /**
     * 批量发放证书
     * @param $sno
     * @param $entryId
     * @param $getPerson
     * @param $place
     * @param $i
     * @return array|bool
     */
    public static function addCertAcademy($sno, $entryId, $getPerson, $place, $i){
        $cert = self::create([
            'sno' => $sno[$i],
            'entry_id' => $entryId[$i]['entry_id'],
            'cert_no' => date('ymdHis') + $i,
            'cert_type' => 2,
            'cert_time' => date('Y-m-d H:i:s'),
            'cert_getperson' => $getPerson,
            'cert_place' => $place,
            'cert_islost' => 0,
            'isdeleted' => 0
        ]);

        return $cert ? Resources::AcademyCert($cert) : false;
    }

    //------------------预备党员培训------------------------------------
    /**
     * 预备党员培训--获取证书
     * @param $max
     * @param $min
     * @param $academyId
     * @return array
     */
    public static function getCertProbationary($max, $min, $academyId){
        $res_all = self::whereBetween('entry_id', [$min, $max])
            ->leftJoin('twt_student_info', 'twt_cert.sno', '=', 'twt_student_info.sno')
            ->where('academy_id', $academyId)
            ->where('cert_type', 3)
            ->get()->all();
        return array_map(function ($cert){
            return Resources::ProbationaryCert($cert);
        }, $res_all);
    }

    /**
     * 批量发放证书
     * @param $data
     * @param $i
     * @return array|bool
     */
    public static function addCertProbationary($data, $i){
        $cert = self::create([
            'sno' => $data['sno'][$i],
            'entry_id' => $data['entryId'][$i]['entry_id'],
            'cert_no' => date('ymdHis') + $i,
            'cert_type' => 2,
            'cert_time' => date('Y-m-d H:i:s'),
            'cert_getperson' => $data['getPerson'],
            'cert_place' => $data['place'],
            'cert_islost' => 0,
            'isdeleted' => 0
        ]);
        return $cert ? Resources::ProbationaryCert($cert) : false;
    }


    //--------------------------下面就是前台的了------------------------

    /**
     * 申请人培训--证书查看
     * @param $entry_id
     * @return array
     */
    public static function certCheckApplicant($entry_id){
        $res = self::leftJoin('twt_applicant_entryform', 'twt_cert.entry_id', '=', 'twt_applicant_entryform.entry_id')
            ->where('twt_cert.entry_id', $entry_id)
            ->where('twt_cert.cert_type', 1)
            ->get()->all();
        return array_map(function ($cert){
            return Resources::Cert($cert);
        }, $res);
    }

    /**
     * 院级积极分子--证书查看
     * @param $entry_id
     * @return array
     */
    public static function certCheckAcademy($entry_id){
        $res = self::leftJoin('twt_academy_entryform', 'twt_cert.entry_id', '=', 'twt_academy_entryform.entry_id')
            ->where('twt_cert.entry_id', $entry_id)
            ->where('twt_cert.cert_type', 2)
            ->get()->all();
        return array_map(function ($cert){
            return Resources::Cert($cert);
        }, $res);
    }

    /**
     * 预备党员培训--证书查看
     * @param $entry_id
     * @return array
     */
    public static function certCheckProbationary($entry_id){
        $res = self::leftJoin('twt_probationary_entryform', 'twt_cert.entry_id', '=', 'twt_probationary_entryform.entry_id')
            ->where('twt_cert.entry_id', $entry_id)
            ->where('twt_cert.cert_type', 3)
            ->get()->all();
        return array_map(function ($cert){
            return Resources::Cert($cert);
        }, $res);
    }

    /**
     * @param $cert_id
     * @return array
     */
    public static function getByCertId($cert_id){
        $res = self::where('cert_id', $cert_id)
            ->get()->all();
        return array_map(function ($cert){
            return Resources::Cert($cert);
        }, $res);
    }

    /**
     * 证书丢失更新islost字段
     * @param $cert_id
     * @return bool
     */
    public static function certLost($cert_id){
        $res = self::where('cert_id', $cert_id)
            ->update(['cert_islost' => 1]);
        return $res ? true : false;
    }

    public static function getCertByTypeSno($type, $sno){
        $res = self::where([
            'cert_type' => $type,
            'sno'       => $sno,
            'isdeleted' => 0
        ])->get()->all();

        return array_map(function($res){
            return Resources::Cert($res);
        }, $res);
    }

    /**
     * 学生信息管理--申请人结业考试--系统添加证书
     * @param $sno
     * @param $entry_id
     * @param $j
     * @return bool
     */
    public static function systemAddCertInStudentInfoInit($sno, $entry_id, $j){
        $res = self::create([
            'sno' => $sno,
            'entry_id' => $entry_id,
            'cert_no' => date('hmdHis')+ $j,
            'cert_type' => 1,
            'cert_getperson' => '系统初始化设置',
            'cert_place' => '系统初始化设置',
        ]);
        return $res ? true : false;
    }

}
