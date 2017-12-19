<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/12/19
 * Time: 20:10
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Helpers\Log;
use App\Models\Cert;
use App\Models\CertLost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CertController extends Controller{

    /**
     * 证书补办申诉
     * @param Request $request
     * @param $cert_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function makeupPage(Request $request, $cert_id){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        $cert = Cert::getByCertId($cert_id);
        if ($cert){
            return response()->json([
                'success' => 1,
                'basicInfo' => $userInfo,
                'cert' => $cert[0]
            ]);
        }else{
            return response()->json([
                'message' => '不好意思，没有找到你的证书信息'
            ]);
        }
    }

    /**
     * 证书补办申诉--提交
     * @param Request $request
     * @param $cert_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function makeup(Request $request, $cert_id){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        $title = $request->input('title');
        $content = $request->input('content');
        if (!$title){
            return response()->json([
                'message' => '不要这么懒,至少得填写标题才能提交申诉!'
            ]);
        }else{
            //这里我们要查看一下,关于该cert_id是否已经有一个在审批当中
            $isApply = CertLost::isApply($cert_id);
            if ($isApply){
                return response()->json([
                    'message' => '不好意思,您上一个关于本证书的丢失申请还没审批,请耐心等待管理员审批.或者直接发消息给管理员!'
                ]);
            }else{
                $certLost = CertLost::addCertLost($cert_id, $title, $content);
                if ($certLost){
                    $update = Cert::certLost($cert_id);
                    if ($update){
                        return response()->json([
                            'success' => 1,
                            'message' => '申请成功! 温馨提示,请耐心等待管理员审核您的申请书补办申请!'
                        ]);
                    }else{
                        return response()->json([
                            'message' => '申请失败，未知错误'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '申请失败'
                    ]);
                }
            }
        }
    }

}