<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CertLost extends Model
{
    //
    protected $table = "twt_certlost";
    protected $primaryKey = 'lost_id';

    const CREATED_AT = 'updated_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ['cert_id', 'title', 'content', 'time', 'deal_status', 'deal_word', 'isdeleted'];

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

    public function cert(){
        return $this->belongsTo('App\Models\Cert', 'cert_id', 'cert_id');
    }


    //---------------------------入党申请人相关-----------------------------------------------
    /**
     * 获取申请补办证书的列表
     * @return array
     */
    public static function getCertLost(){
        $res = self::where('twt_certlost.isdeleted', 0)
            ->leftJoin('twt_cert', 'twt_certlost.cert_id', '=', 'twt_cert.cert_id')
            ->where('cert_type', 1)
            ->get()->all();
        return array_map(function ($certLost){
            return Resources::CertLost($certLost);
        }, $res);
    }

    /**
     * 根据id取出指定的数据
     * @param $id
     * @return array
     */
    public static function getCertLostById($id){
        $res = self::where('twt_certlost.isdeleted', 0)
            ->where('lost_id', $id)
            ->leftJoin('twt_cert', 'twt_certlost.cert_id', '=', 'twt_cert.cert_id')
            ->where('cert_type', 1)
            ->get()->all();
        return array_map(function ($certLost){
            return Resources::CertLost($certLost);
        }, $res);
    }

    /**
     * 通过补办后的更新操作
     * @param $id
     * @param $dealWord
     * @return array|bool
     */
    public static function updateCertLost($id, $dealWord){
        $certLost = CertLost::findOrFail($id);
        $certLost->deal_word = $dealWord;
        $certLost->deal_status = 1;
        $res = $certLost->save();
        return $res ? Resources::CertLost($certLost) : false;
    }

    /**
     * 驳回补办后的更新操作
     * @param $id
     * @param $dealWord
     * @return array|bool
     */
    public static function updateCertLostReject($id, $dealWord){
        $certLost = CertLost::findOrFail($id);
        $certLost->deal_word = $dealWord;
        $certLost->deal_status = 2;
        $res = $certLost->save();
        return $res ? Resources::CertLost($certLost) : false;
    }

    //---------------------院级积极分子相关------------------------------------------
    /**
     * 获取申请补办证书的列表
     * @return array
     */
    public static function getCertLostAcademy(){
        $res = self::where('twt_certlost.isdeleted', 0)
            ->leftJoin('twt_cert', 'twt_certlost.cert_id', '=', 'twt_cert.cert_id')
            ->where('cert_type', 2)
            ->get()->all();
        return array_map(function ($certLost){
            return Resources::CertLost($certLost);
        }, $res);
    }

    /**
     * 根据id取出指定的数据
     * @param $id
     * @return array
     */
    public static function getCertLostByIdAcademy($id){
        $res = self::where('twt_certlost.isdeleted', 0)
            ->where('lost_id', $id)
            ->leftJoin('twt_cert', 'twt_certlost.cert_id', '=', 'twt_cert.cert_id')
            ->where('cert_type', 2)
            ->get()->all();
        return array_map(function ($certLost){
            return Resources::CertLost($certLost);
        }, $res);
    }

    //--------------------------预备党员相关--------------------------------------
    /**
     * 获取申请补办证书的列表
     * @return array
     */
    public static function getCertLostProbationary(){
        $res = self::where('twt_certlost.isdeleted', 0)
            ->leftJoin('twt_cert', 'twt_certlost.cert_id', '=', 'twt_cert.cert_id')
            ->where('cert_type', 3)
            ->get()->all();
        return array_map(function ($certLost){
            return Resources::CertLost($certLost);
        }, $res);
    }

    /**
     * 根据id取出指定的数据
     * @param $id
     * @return array
     */
    public static function getCertLostByIdProbationary($id){
        $res = self::where('twt_certlost.isdeleted', 0)
            ->where('lost_id', $id)
            ->leftJoin('twt_cert', 'twt_certlost.cert_id', '=', 'twt_cert.cert_id')
            ->where('cert_type', 3)
            ->get()->all();
        return array_map(function ($certLost){
            return Resources::CertLost($certLost);
        }, $res);
    }

    //下面就是前台的了

    /**
     * 判断是否已经有一个在审批当中
     * @param $cert_id
     * @return bool
     */
    public static function isApply($cert_id){
        $res = self::where('cert_id', $cert_id)
            ->where('deal_status', 0)
            ->get()->toArray();
        return $res ? true : false;
    }

    /**
     * 添加证书丢失信息
     * @param $cert_id
     * @param $title
     * @param $content
     * @return bool
     */
    public static function addCertLost($cert_id, $title, $content){
        $res = self::create([
            'cert_id' => $cert_id,
            'title' => $title,
            'content' => $content
        ]);
        return $res ? true : false;
    }
}
