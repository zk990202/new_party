<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:16 AM
 */
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontBaseController;
use App\Http\Helpers\CodeAndMessage;
use App\Http\Service\AcademyService;
use App\Http\Service\ApplicantService;
use App\Models\Academy\EntryForm;
use App\Models\Academy\TestList;
use App\Models\Cert;
use http\Env\Request;

class AcademyController extends FrontBaseController {
    protected $academyService;

    public $module;

    public function __construct(AcademyService $academyService)
    {
        parent::__construct();
        $this->academyService = $academyService;
    }

    /**
     * 积极分子课程显示界面
     */
    public function courseStudy(){
        $user = $this->userService->getCurrentUser();
        $collegeId = $user['collegeId'];

        $list = TestList::getListByCollegeIdWithPage($collegeId, $numPerPage = 6);

//        return view('front.academy.courseList', ['list' => $list]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $list
        ]);
    }

    public function courseDetail($id){
        $detail = TestList::getTestById($id);
        if(!$detail){
//            return $this->alertService->alertAndBackWithError("课程不存在");
            return response()->json([
                'code' => 1,
                'msg'  => CodeAndMessage::returnMsg(1, '课程不存在')
            ]);
        }

//        return view('front.academy.courseDetail', ['detail' => $detail]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $detail
        ]);
    }

    /**
     * 报名界面
     */
    public function signUpPage(){
        $user = $this->userService->getCurrentUser();

        $can = $this->academyService->canEntryTest($user['userNumber']);
        if(!$can['status']){
//            return $this->alertService->alertAndBack('提示', $can['msg']);
            return response()->json([
                'code' => 2,
                'msg'  => CodeAndMessage::returnMsg(2, $can['msg'])
            ]);
        }

        $data = [
            'user' => $user,
            'test' => $can['test'],
        ];
//        return view('front.academy.signUp', ['data' => $data]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }


    /**
     * 报名
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function signUp(){
        $user = $this->userService->getCurrentUser();
        $can = $this->academyService->canEntryTest($user['userNumber']);
        if(!$can['status']){
//            return $this->alertService->alertAndBack('提示', $can['msg']);
            return response()->json([
                'code' => 2,
                'msg'  => CodeAndMessage::returnMsg(2, $can['msg'])
            ]);
        }
        $form = EntryForm::create([
            'sno'	=>	$user['userNumber'],
            'test_id'	=>	$can['test']['id'],
        ]);
        if(! $form){
//            return $this->alertService->alertAndBackWithError('遇到了一个错误');
            return response()->json([
                'code' => 500,
                'msg'  => CodeAndMessage::returnMsg(500)
            ]);
        }
//        return $this->alertService->alertAndBackWithSuccess('请查看报名结果以确保报名信息无误', $url = url('academy/signResult'));
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0, '报名成功')
        ]);
    }

    /**
     * 报名结果界面
     */
    public function signUpResult(){
        $user = $this->userService->getCurrentUser();
        $entryForm = EntryForm::getSignResult($user['userNumber']);

        if(!$entryForm){
//            return $this->alertService->alertAndBack('提示', '您没有报名考试');
            return response()->json([
                'code' => 2,
                'msg'  => CodeAndMessage::returnMsg(2, '您没有报名考试')
            ]);
        }

        // 都是一样的逻辑，两种模型的 status 共用一套本地化方案
        \App\Models\Applicant\TestList::warpStatus($entryForm);
        \App\Models\Applicant\EntryForm::warpStatus($entryForm);
        $data = [
            'user' => $user,
            'form' => $entryForm
        ];
//        return view('front.academy.signUpResult', ['data' => $data]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 退出报名
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signExit(){
        $user = $this->userService->getCurrentUser();
        $entryForm = EntryForm::getSignResult($user['userNumber']);
        if(!$entryForm){
//            return $this->alertService->alertAndBack('提示', '您没有报名考试');
            return response()->json([
                'code' => 2,
                'msg'  => CodeAndMessage::returnMsg(2, '您没有报名考试')
            ]);
        }

        if($entryForm['isExit']){
//            return $this->alertService->alertAndBack('提示', '您已经退出考试了！');
            return response()->json([
                'code' => 2,
                'msg'  => CodeAndMessage::returnMsg(2, '您已经退出考试了！')
            ]);
        }

        $flag = EntryForm::exitEntryByUserNumber($user['userNumber'], $entryForm['id']);

        if(!$flag){
//            return $this->alertService->alertAndBackWithError('遇到了一个错误');
            return response()->json([
                'code' => 500,
                'msg'  => CodeAndMessage::returnMsg(500)
            ]);
        }
//        return $this->alertService->alertAndBackWithSuccess('退出成功');
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0, '退出成功')
        ]);
    }


    /**
     * 成绩查询界面
     */
    public function grade(){
        $user = $this->userService->getCurrentUser();

        $entryList = EntryForm::gradeCheck($user['userNumber']);
        foreach($entryList as &$v){
            \App\Models\Applicant\TestList::warpStatus($v);
            \App\Models\Applicant\EntryForm::warpStatus($v);
            \App\Models\Applicant\EntryForm::warpIsPassed($v);
        }
        $data = [
            'user' => $user,
            'list' => $entryList
        ];
        //dd($entryList);
//        return view('front.academy.grade', ['data' => $data]);
        return response()->json([
            'code' => 0,
            'msg'  => CodeAndMessage::returnMsg(0),
            'data' => $data
        ]);
    }

    /**
     * 证书查询
     */
    public function certificate(){
        $user = $this->userService->getCurrentUser();
        $entry = EntryForm::certGetEntry($user['userNumber']);
        if (!$entry){
//            return $this->alertService->alertAndBack('提示：没有证书结果', '如果你没有参加过或者未通过院级积极
//            分子结业考试,或者通过,但是结业证书还未发放,这些情况您都无法看到自己的证书.如果长时间查看不到自己的结业证书而[成绩查询]
//            中显示您的考试状态为通过.那么请联系管理员核实并解决此问题.');
            return response()->json([
                'code' => 500,
                'msg'  => CodeAndMessage::returnMsg(500, '没有证书结果：如果你没有参加过或者未通过院级积极
                    分子结业考试,或者通过,但是结业证书还未发放,这些情况您都无法看到自己的证书.如果长时间查看不到自己的结业证书而[成绩查询]
                    中显示您的考试状态为通过.那么请联系管理员核实并解决此问题.')
            ]);
        }
        else{
            $entry_id = $entry[0]['id'];
            $cert = Cert::certCheckAcademy($entry_id);
            if (!$cert){
//                return $this->alertService->alertAndBackWithError('不好意思,没有找到相应的证书,请联系管理员!');
                return response()->json([
                    'code' => 500,
                    'msg'  => CodeAndMessage::returnMsg(500, '不好意思,没有找到相应的证书,请联系管理员!')
                ]);
            }
            else{
//                return view('front.academy.certificate', ['cert' => $cert]);
                $data = [
                    'user' => $user,
                    'cert' => $cert[0]
                ];
                return response()->json([
                    'code' => 0,
                    'msg'  => CodeAndMessage::returnMsg(0),
                    'data' => $data
                ]);
            }
        }
    }

}