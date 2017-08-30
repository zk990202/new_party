<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class Cert extends Model
{
    //
    protected $table = "twt_cert";
    protected $primaryKey = 'cert_id';

    const CREATED_AT = 'cert_time';

    protected $fillable = ['sno', 'entry_id', 'cert_no', 'cert_type', 'cert_time', 'cert_getperson', 'cert_place',
        'cert_islost', 'isdeleted'];

    public function studentInfo(){
        return $this->belongsTo('App\Models\StudentInfo', 'sno','sno');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\Userinfo','sno','usernumb');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'sno', 'usernumb');
    }

    public function entryForm(){
        return $this->belongsTo('App\Models\Applicant\EntryForm', 'entry_id', 'entry_id');
    }

    public static function getCert($max, $min, $college){
        $res_all = self::whereBetween('entry_id', [$min, $max])
            ->where('isdeleted', 0)
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

    public static function addLastCert($sno, $entryId, $getPerson, $place, $certType){
        $cert = self::create([
            'sno' => $sno,
            'entry_id' => $entryId[0]['entry_id'],
            'cert_no' => date('ymdHis'),
            'cert_type' => $certType,
            'cert_time' => date('Y-m-d H:i:s'),
            'cert_getperson' => $getPerson,
            'cert_place' => $place,
            'isdeleted' => 0
        ]);
        return $cert ? Resources::Cert($cert) : false;
    }
}
