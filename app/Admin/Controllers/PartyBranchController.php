<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/10/24
 * Time: 17:31
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Service\AdminMenuService;
use App\Models\Classes;
use App\Models\College;
use App\Models\PartyBranch\PartyBranch;
use App\Models\StudentInfo;
use App\Models\UserInfo;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PartyBranchController extends Controller {

    protected $titles;

    public function __construct()
    {
        $this->titles = AdminMenuService::getMenuName();
    }

    /**
     * 支部列表--显示学院及每个学院的支部数
     * @return Content
     */
    public function pList(){
        $college = College::getAll();
        $branches = PartyBranch::getAllCount($college);
        return Admin::content(function (Content $content) use ($branches){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.pList', ['branches' => $branches]));
        });
        //return view('Manager.PartyBranch.pList', ['branches' => $branches]);
    }

    /**
     * 支部列表--每个学院下的所有党支部
     * @param $academy_id
     * @return Content
     */
    public function cList($academy_id){
        $branches = PartyBranch::getAll($academy_id);
        return Admin::content(function (Content $content) use ($branches){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.cList', ['branches' => $branches]));
        });
    }

    /**
     * 支部管理--主页面
     * @param $branch_id
     * @return Content
     */
    public function manager($branch_id){
        $branch = PartyBranch::getById($branch_id);
        //支部总人数
        $all = StudentInfo::allMembers($branch_id);
        $allNum = count($all);
        //正式党员
        $real = StudentInfo::real($branch_id);
        $realNum = count($real);
        //预备党员
        $ready = StudentInfo::ready($branch_id);
        $readyNum = count($ready);
        //发展对象
        $develop = StudentInfo::develop($branch_id);
        $developNum = count($develop);
        //团推优+积极分子
        $excellentAndAcademy = StudentInfo::excellent($branch_id);
        $excellentAndAcademyNum = count($excellentAndAcademy);
        //积极分子
        $academy = StudentInfo::academy($branch_id);
        $academyNum = count($academy);
        //团推优
        $excellent = StudentInfo::excellent($branch_id);
        $excellentNum = count($excellent);
        //申请人+非申请人
        $apply = StudentInfo::apply($branch_id);
        $applyNum = count($apply);
        $viewData = [
            'branch' => $branch[0],
            'allNum' => $allNum,
            'realNum' => $realNum,
            'readyNum' => $readyNum,
            'developNum' => $developNum,
            'excellentAndAcademyNum' => $excellentAndAcademyNum,
            'academyNum' => $academyNum,
            'excellentNum' => $excellentNum,
            'applyNum' => $applyNum
        ];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.manager', $viewData));
        });
    }

    /**
     * 支部管理--添加支部干部--显示页面
     * @param $branch_id
     * @param $type
     * @return Content
     */
    public function addCadrePage($branch_id, $type){
        $branch = PartyBranch::getById($branch_id);
        $res = null;
        $cadre = null;
        if ($branch){
            if ($type){
                if ($type == 1){
                    $cadre = '支部书记';
                }elseif ($type == 2){
                    $cadre = '组织委员';
                }elseif ($type == 3){
                    $cadre = '宣传委员';
                }else{
                    $res = '未找到要添加的支部委员类型';
                }
            }else{
                $res = '未找到要添加的支部委员类型';
            }
        }else{
            $res = '未找到支部相关信息';
        }
        $viewData = [
            'cadre' => $cadre,
            'type' => $type,
            'res' => $res,
            'branch' => $branch[0]
        ];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.addCadre', $viewData));
        });
    }

    /**
     * 支部管理--添加支部干部--后台逻辑
     * @param Request $request
     * @param $branch_id
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCadre(Request $request, $branch_id, $type){
        $sno = $request->input('sno');
        if (!$sno){
            return response()->json([
                'message' => '请输入学号'
            ]);
        }
        // 此处还需介入基础库，还未实现
        if ($type){
            if ($type == 1){
                $res = PartyBranch::updateSecretary($branch_id, $sno);
                if ($res){
                    return response()->json([
                        'success' => true
                    ]);
                }else{
                    return response()->json([
                        'message' => '更新失败，未知错误'
                    ]);
                }
            }elseif ($type == 2){
                $res = PartyBranch::updateOrganizer($branch_id, $sno);
                if ($res){
                    return response()->json([
                        'success' => true
                    ]);
                }else{
                    return response()->json([
                        'message' => '更新失败，未知错误'
                    ]);
                }
            }elseif ($type == 3){
                $res = PartyBranch::updatePropagator($branch_id, $sno);
                if ($res){
                    return response()->json([
                        'success' => true
                    ]);
                }else{
                    return response()->json([
                        'message' => '更新失败，未知错误'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '未找到要添加的支部委员类型'
                ]);
            }
        }else{
            return response()->json([
                'message' => '未找到要添加的支部委员类型'
            ]);
        }
    }

    /**
     * 支部管理--支部干部卸任
     * @param $branch_id
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCadre($branch_id, $type){
        $branch = PartyBranch::findOrFail($branch_id);
        if ($type){
            if ($type == 1){
                $branch->partybranch_secretary = null;
            }elseif ($type == 2){
                $branch->partybranch_organizer = null;
            }elseif ($type == 3){
                $branch->partybranch_propagator = null;
            }else{
                return response()->json([
                    'message' => '未找到要删除的支部委员类型'
                ]);
            }
        }else{
            return response()->json([
                'message' => '未找到要删除的支部委员类型'
            ]);
        }
        $res = $branch->save();
        if ($res){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => '删除失败，未知错误'
            ]);
        }
    }

    /**
     * 支部管理--成员列表
     * @param $branch_id
     * @return Content
     */
    public function memberList($branch_id){
        $branch = PartyBranch::getById($branch_id);
        //支部总人数
        $all = StudentInfo::allMembers($branch_id);
        $allNum = count($all);
        //正式党员
        $real = StudentInfo::real($branch_id);
        $realNum = count($real);
        //预备党员
        $ready = StudentInfo::ready($branch_id);
        $readyNum = count($ready);
        //发展对象
        $develop = StudentInfo::develop($branch_id);
        $developNum = count($develop);
        //团推优+积极分子
        $excellentAndAcademy = StudentInfo::excellent($branch_id);
        $excellentAndAcademyNum = count($excellentAndAcademy);
        //积极分子
        $academy = StudentInfo::academy($branch_id);
        $academyNum = count($academy);
        //团推优
        $excellent = StudentInfo::excellent($branch_id);
        $excellentNum = count($excellent);
        //申请人+非申请人
        $apply = StudentInfo::apply($branch_id);
        $applyNum = count($apply);
        $viewData = [
            'branch' => $branch[0],
            'allNum' => $allNum,
            'realNum' => $realNum,
            'readyNum' => $readyNum,
            'developNum' => $developNum,
            'excellentAndAcademyNum' => $excellentAndAcademyNum,
            'academyNum' => $academyNum,
            'excellentNum' => $excellentNum,
            'applyNum' => $applyNum,
            'all' => $all,
            'real' => $real,
            'ready' => $ready,
            'develop' => $develop,
            'excellentAndAcademy' => $excellentAndAcademy,
            'academy' => $academy,
            'excellent' => $excellent,
            'apply' => $apply
        ];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.memberList', $viewData));
        });
    }

    /**
     * 支部管理--成员添加(本科，硕士，博士)--页面
     * @param $branch_id
     * @return Content
     */
    public function memberAddPage($branch_id){
        $branch = PartyBranch::getById($branch_id);
        $branchType = $branch[0]['type'];
        $schoolYear = substr($branch[0]['schoolYear'], 2, 2);
//        $schoolYear = '06';
        $academyId = $branch[0]['academy'];
        $members = [];
        if ($branchType == 1){
            $members = StudentInfo::noneMembersUndergraduate($academyId, $schoolYear);
        } elseif ($branchType == 2){
            $members = StudentInfo::noneMembersMaster($academyId, $schoolYear);
        }elseif ($branchType == 3){
            $members = StudentInfo::noneMembersDoctor($academyId, $schoolYear);
        }
//        dd($members);
        return Admin::content(function (Content $content) use ($members, $branch){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.memberAdd', ['members' => $members, 'branch' => $branch]));
        });
    }

    /**
     * 支部管理--成员添加(本科，硕士，博士)--逻辑
     * @param Request $request
     * @param $branch_id
     * @return Content
     */
    public function memberAdd(Request $request, $branch_id){
        $branch = PartyBranch::getById($branch_id);
        $sno = $request->input('sno');
        $updateStudentInfo = StudentInfo::updatePartyBranch($sno, $branch_id);
        if ($updateStudentInfo){
            $updateUserInfo = UserInfo::updatePartyBranch($sno, $branch_id);
            if ($updateUserInfo){
                $res = '添加成功';
            }else{
                $res = '添加成功,但是基础库没有得到更新!!';
            }
        }else{
            $res = '添加失败';
        }
        $viewData = ['res' => $res, 'branch' => $branch];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.memberAddResult', $viewData));
        });
    }

    /**
     * 支部管理--成员添加(混合党支部)--筛选学生
     * @param $branch_id
     * @return Content
     */
    public function memberAddMixPreviewPage($branch_id){
        $branch = PartyBranch::getById($branch_id);
        $grades1 = Classes::getGrades();
        $grades = [];
        for ($i = 0; $i < count($grades1); $i++){
            $grades[$i] = $grades1[$i]['grade'];
        }
        $viewData = ['branch' => $branch[0], 'grades' => $grades];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.memberAddMixPreview', $viewData));
        });
    }

    /**
     * 支部管理--成员添加(混合党支部)--添加页面
     * @param Request $request
     * @param $branch_id
     * @return Content
     */
    public function memberAddMixPage(Request $request, $branch_id){
        $branch = PartyBranch::getById($branch_id);
        $academyId = $branch[0]['academy'];
        $schoolYear = $request->input('schoolYear');
        $studentType = $request->input('studentType');
        $members = [];
        if ($schoolYear){
            //选择了年级信息
            $schoolYear1 = substr($schoolYear, 2, 2);
            if ($studentType){
                //选择了学历
                if ($studentType == 1){
                    $members = StudentInfo::noneMembersUndergraduate($academyId, $schoolYear1);
                }elseif($studentType == 2){
                    $members = StudentInfo::noneMembersMaster($academyId, $schoolYear1);
                }elseif($studentType == 3) {
                    $members = StudentInfo::noneMembersDoctor($academyId, $schoolYear1);
                }
            }else{
                //未选择学历
                $members = StudentInfo::noneMemberAll($academyId, $schoolYear1);
            }
        }else{
            //未选择年级信息
            if ($studentType){
                //选择了学历
                if ($studentType == 1){
                    $members = StudentInfo::noneMembersUndergraduateNotYear($academyId);
                }elseif ($studentType == 2){
                    $members = StudentInfo::noneMembersMasterNotYear($academyId);
                }elseif ($studentType == 3){
                    $members = StudentInfo::noneMembersDoctorNotYear($academyId);
                }
            }else{
                //未选择学历
                $members = StudentInfo::noneMemberAllNotYear($academyId);
            }
        }
        $viewData = [
            'members' => $members,
            'branch' => $branch,
            'schoolYear' => $schoolYear,
            'studentType' => $studentType
        ];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.memberAddMix', $viewData));
        });
    }

    /**
     * 支部管理--成员添加(混合)--逻辑
     * @param Request $request
     * @param $branch_id
     * @return Content
     */
    public function memberAddMix(Request $request, $branch_id){
        $branch = PartyBranch::getById($branch_id);
        $sno = $request->input('sno');
        $schoolYear = $request->input('schoolYear');
        $studentType = $request->input('studentType');
        $updateStudentInfo = StudentInfo::updatePartyBranch($sno, $branch_id);
        if ($updateStudentInfo){
            $updateUserInfo = UserInfo::updatePartyBranch($sno, $branch_id);
            if ($updateUserInfo){
                $res = '添加成功';
            }else{
                $res = '添加成功,但是基础库没有得到更新!!';
            }
        }else{
            $res = '添加失败';
        }
        $viewData = [
            'res' => $res,
            'branch' => $branch,
            'schoolYear' => $schoolYear,
            'studentType' => $studentType
        ];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.memberAddMixResult', $viewData));
        });
    }

    /**
     * 支部管理--成员删除--选择学生
     * @param $branch_id
     * @return Content
     */
    public function memberDeletePage($branch_id){
        $branch = PartyBranch::getById($branch_id);
        //支部总人数
        $all = StudentInfo::allMembers($branch_id);
        $allNum = count($all);
        //正式党员
        $real = StudentInfo::real($branch_id);
        $realNum = count($real);
        //预备党员
        $ready = StudentInfo::ready($branch_id);
        $readyNum = count($ready);
        //发展对象
        $develop = StudentInfo::develop($branch_id);
        $developNum = count($develop);
        //团推优+积极分子
        $excellentAndAcademy = StudentInfo::excellent($branch_id);
        $excellentAndAcademyNum = count($excellentAndAcademy);
        //积极分子
        $academy = StudentInfo::academy($branch_id);
        $academyNum = count($academy);
        //团推优
        $excellent = StudentInfo::excellent($branch_id);
        $excellentNum = count($excellent);
        //申请人+非申请人
        $apply = StudentInfo::apply($branch_id);
        $applyNum = count($apply);

        $viewData = [
            'branch' => $branch[0],
            'allNum' => $allNum,
            'realNum' => $realNum,
            'readyNum' => $readyNum,
            'developNum' => $developNum,
            'excellentAndAcademyNum' => $excellentAndAcademyNum,
            'academyNum' => $academyNum,
            'excellentNum' => $excellentNum,
            'applyNum' => $applyNum,
            'all' => $all,
            'real' => $real,
            'ready' => $ready,
            'develop' => $develop,
            'excellentAndAcademy' => $excellentAndAcademy,
            'academy' => $academy,
            'excellent' => $excellent,
            'apply' => $apply
        ];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.memberDelete', $viewData));
        });
    }

    /**
     * 支部管理--成员删除--逻辑
     * @param Request $request
     * @param $branch_id
     * @return Content
     */
    public function memberDelete(Request $request, $branch_id){
        $branch = PartyBranch::getById($branch_id);
        $data = $request->all();
        if (array_key_exists('sno', $data)){
            $sno = $data['sno'];
            //计数器--如果循环之后count1，count2的值等于count($sno)，则删除成功
            $count1 = 0;
            $count2 = 0;
            for ($i = 0; $i < count($sno); $i++){
                $deleteStudentInfo = StudentInfo::deletePartyBranch($sno[$i], $branch_id);
                if ($deleteStudentInfo){
                    $count1++;
                    $deleteUserInfo = UserInfo::deletePartyBranch($sno[$i], $branch_id);
                    if ($deleteUserInfo){
                        $count2++;
                    }
                }
            }
//            dd($count1.'+'.$count2);
            if ($count1 == count($sno) && $count2 == count($sno)){
                $res = '删除成功';
            }elseif ($count1 == count($sno) && $count2 < count($sno)){
                $res = '删除成功，但基础库未更新';
            }else{
                $res = '删除失败';
            }
        }else{
            $res = '请勾选要删除的成员';
        }
        $viewData = ['res' => $res, 'branch' => $branch];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.memberDeleteResult', $viewData));
        });
    }

    /**
     * 编辑党支部--页面
     * @param $branch_id
     * @return Content
     */
    public function editPage($branch_id){
        $branch = PartyBranch::getById($branch_id);
        if(count($branch) < 1)
            throw new NotFoundHttpException("未找到相关支部");
        $viewData = ['branch' => $branch[0]];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.edit', $viewData));
        });
    }

    /**
     * 编辑党支部--逻辑
     * @param Request $request
     * @param $branch_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $branch_id){
        $branch = PartyBranch::getById($branch_id);
        $data = $request->all();
        // 先根据子名称拼接出新的支部名称
        $academyShortName = $branch[0]['academyShortName'];
        $type = '';
        if ($data['type'] == 1){
            $type = '本科生';
        }elseif ($data['type'] == 2){
            $type = '硕士生';
        }elseif ($data['type'] == 3) {
            $type = '博士生';
        }elseif ($data['type'] == 4){
            $type = '混合';
        }
        if ($data['childName']){
            $branchName = $academyShortName.$data['schoolYear'].'级'.$type.$data['childName'].'党支部';
            //判断是否重名
            $ifExist = PartyBranch::ifNameExist($branch_id, $branchName);
            if (!$ifExist){
                $res = PartyBranch::updateBranchName($branch_id, $branchName);
                if ($res){
                    return response()->json([
                        'success' => true
                    ]);
                }else{
                    return response()->json([
                        'message' => '更新失败，请联系管理员'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '该支部名称已经存在!'
                ]);
            }
        }else{
            return response()->json([
                'message' => '未修改请勿提交！'
            ]);
        }
//        dd($branchName);

    }

    /**
     * 删除党支部
     * @param $branch_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteBranch($branch_id){
        //判断支部是否还有成员
        $members = StudentInfo::getByBranchId($branch_id);
        if (!$members){
            $deleteBranch = PartyBranch::deleteBranch($branch_id);
            if ($deleteBranch){
                //这里还要接入对基础库的操作
//                $res =
//                if ($res){
                    return response()->json([
                        'success' => true
                    ]);
//                }else{
//                    return response()->json([
//                        'message' => '支部删除部分成功,基础库没有得到及时的更新!'
//                    ]);
//                }
            }else{
                return response()->json([
                    'message' => '支部删除失败！'
                ]);
            }
        }else{
            return response()->json([
                'message' => '该支部还有成员没有删除,请删除支部成员之后再进行支部删除操作!'
            ]);
        }
    }

    /**
     * 支部查询前的筛选条件
     * @return Content
     */
    public function searchPreview(){
        $colleges = College::getAll();
        $grades1 = Classes::getGrades();
        $grades = [];
        for ($i = 0; $i < count($grades1); $i++){
            $grades[$i] = $grades1[$i]['grade'];
        }
        $viewData = [
            'colleges' => $colleges,
            'grades' => $grades,
        ];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.searchPreview', $viewData));
        });
    }

    /**
     * 支部查询
     * @param Request $request
     * @return Content
     */
    public function search(Request $request){
        $data = $request->all();
        $branches = PartyBranch::searchBranch($data['academyId'], $data['schoolYear'], $data['type']);
        $viewData =  ['branches' => $branches];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.cList', $viewData));
        });
    }

    /**
     * 支部组建--页面
     * @return Content
     */
    public function addPage(){
        $colleges = College::getAll();
        $grades1 = Classes::getGrades();
        $grades = [];
        for ($i = 0; $i < count($grades1); $i++){
            $grades[$i] = $grades1[$i]['grade'];
        }
        $viewData =  ['colleges' => $colleges, 'grades' => $grades];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.add', $viewData));
        });
    }

    /**
     * 支部组建--逻辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request){
        $data = $request->all();
        if (!$data['academyId']){
            return response()->json([
                'message' => '请选择学院'
            ]);
        }
        if (!$data['type']){
            return response()->json([
                'message' => '请选择类型'
            ]);
        }
        if ($data['type'] != 4 && !$data['schoolYear']){
            return response()->json([
                'message' => '请选择年级'
            ]);
        }
        $college = College::getById($data['academyId']);
        // 先根据子名称拼接出新的支部名称
        $academyShortName = $college[0]['shortname'];
        $type = '';
        if ($data['type'] == 1){
            $type = '本科生';
        }elseif ($data['type'] == 2){
            $type = '硕士生';
        }elseif ($data['type'] == 3) {
            $type = '博士生';
        }elseif ($data['type'] == 4){
            $type = '混合';
        }
        if ($data['childName']){
            $branchName = $academyShortName.$data['schoolYear'].'级'.$type.$data['childName'].'党支部';
            //判断是否重名
            //添加的支部id一定不会与之前相同，所以判断时就和0比了
            $branch_id = 0;
            $ifExist = PartyBranch::ifNameExist($branch_id, $branchName);
            if (!$ifExist){
                if ($data['type'] == 4){
                    $res = PartyBranch::addMixBranch($data, $branchName);
                }else{
                    $res = PartyBranch::addBranch($data, $branchName);
                }
                if ($res){
                    return response()->json([
                        'success' => true
                    ]);
                }else{
                    return response()->json([
                        'message' => '更新失败，请联系管理员'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '该支部名称已经存在!'
                ]);
            }
        }else{
            return response()->json([
                'message' => '未修改请勿提交！'
            ]);
        }
    }

    /**
     * 支部隐藏--筛选条件
     * @return Content
     */
    public function hidePreview(){
        $colleges = College::getAll();
        $grades1 = Classes::getGrades();
        $grades = [];
        for ($i = 0; $i < count($grades1); $i++){
            $grades[$i] = $grades1[$i]['grade'];
        }
        $viewData =  [
            'colleges' => $colleges,
            'grades' => $grades,
        ];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.hidePreview', $viewData));
        });
    }

    /**
     * 支部隐藏--列表
     * @param Request $request
     * @return Content
     */
    public function hidePage(Request $request){
        $data = $request->all();
        $branches = PartyBranch::searchBranch($data['academyId'], $data['schoolYear'], $data['type']);
        $viewData =  ['branches' => $branches];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.canHideList', $viewData));
        });
    }

    /**
     * 支部隐藏--隐藏操作
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function hide($id){
        $branch = PartyBranch::findOrFail($id);
        $branch->partybranch_ishidden = 1;
        $res = $branch->save();
        if ($res){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => '隐藏失败！'
            ]);
        }
    }

    /**
     * 查看已隐藏的支部--筛选
     * @return Content
     */
    public function hidedListPreview(){
        $colleges = College::getAll();
        $viewData =  ['colleges' => $colleges];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.hidedListPreview', $viewData));
        });
    }

    public function hidedList(Request $request){
        $academyId = $request->input('academyId');
        if (!$academyId){
            $branches = PartyBranch::getAllHidedBranch();
        }else{
            $branches = PartyBranch::getHidedBranchByAcademy($academyId);
        }
        $viewData =  ['branches' => $branches];
        return Admin::content(function (Content $content) use ($viewData){
            // 选填
            $content->header($this->titles[0] ?? '管理后台');
            // 选填
            $content->description($this->titles[1] ?? '');
            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.PartyBranch.hidedList', $viewData));
        });
    }
}