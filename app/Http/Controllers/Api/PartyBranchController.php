<?php
/**
 * 我的支部 模块
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/1/28
 * Time: 20:09
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Helpers\Log;
use App\Models\PartyBranch\PartyBranch;
use App\Models\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PartyBranchController extends Controller {

    public function personalStatus(Request $request){
        //获取用户信息
        if (Cache::has('userInfo')){
            $userInfo = Cache::get('userInfo');
        }else{
            $token = $request->input('token');
            $userInfo = Log::userInfo($token);
            // 缓存10分钟
            Cache::put('userInfo', $userInfo, 10);
        }
        if ($userInfo['is_teacher']){
            return response()->json([
                'message' => '老师，不好意思，您不能查看个人状态'
            ]);
        }else{
            $partyBranchId = $userInfo['party_branch_id'];
            //获取该党支部的详细信息
            $partyBranch = PartyBranch::getById($partyBranchId);
            if (!$partyBranch){
                return response()->json([
                    'message' => '获取支部信息失败'
                ]);
            }else{
                //分别获取支部的支部书记、组织委员、宣传委员
                $secretary = $partyBranch[0]['secretary'];
                $organizer = $partyBranch[0]['organizer'];
                $propagator = $partyBranch[0]['propagator'];
                $secretaryName = $partyBranch[0]['secretaryName'];
                $organizerName = $partyBranch[0]['organizerName'];
                $propagatorName = $partyBranch[0]['propagatorName'];

                //这里先获取到该同学的入党状态
                $sno = $userInfo['user_number'];
                $studentInfo = StudentInfo::getBySno($sno);
                if (!$studentInfo){
                    return response()->json([
                        'message' => '学生信息获取失败'
                    ]);
                }else{
                    $mainStatus = $studentInfo[0]['main_status'];

                    //下面要获取到该同学所属支部的支部正式党员,预备党员的信息
                    if (!$partyBranchId){
                        return response()->json([
                            'message' => '不好意思，你没有所属支部，请联系管理员'
                        ]);
                    }else{
                        //总人数
                        $allMembers = StudentInfo::allMembers($partyBranchId);
                        $allMemnersCount = count($allMembers);
                        //正式党员
                        $real = StudentInfo::real($partyBranchId);
                        $realCount = count($real);
                        //预备党员
                        $ready = StudentInfo::ready($partyBranchId);
                        $readyCount = count($ready);
                        //正在发展公示的对象及其名单
                        $develop = StudentInfo::developSee($partyBranchId);
                        $developCount = count($develop);
                    }
                }
            }
        }
    }

}