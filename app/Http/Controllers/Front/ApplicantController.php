<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:16 AM
 */
namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Service\AlertService;
use App\Http\Service\ApplicantService;
use App\Models\Applicant\ArticleList;
use App\Models\Applicant\EntryForm;
use App\Models\Applicant\TestList;
use App\Models\Cert;
use App\Models\Complain;
use App\Models\StudentInfo;
use Illuminate\Http\Request;

class ApplicantController extends FrontBaseController{
    protected $applicantService;

    public $module;
    public function __construct()
    {
        parent::__construct();
        $this->applicantService = new ApplicantService();
    }

    /**
     * 20课学习列表
     */
    public function courseStudy(){
        // 20 课列表
        $courseList = $this->applicantService->courseList(true);
        $data = [
            'courseList' => $courseList
        ];
//        return view('front.applicant.courseList', ['data' => $data, 'course' => 'nav1']);
        return response()->json([
            'code' => 0,
            'msg' => '',
            'data' => $data
        ]);
    }

    /**
     * 20课详情
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function courseDetail($id){
        $course = $this->applicantService->getCourseById($id);
        if(!$course){
//            return $this->alertService->alertAndBackByConfig([
//                'type'    => AlertService::ALERT_TYPE['ERROR'],
//                'title'   => '错误',
//                'content' => '课程不存在'
//            ]);
            return response()->json([
                'code' => 1,
                'msg'  => '错误，课程不存在',
            ]);
        }
        $articles = ArticleList::getArticleByCourseId($id);
        $data = [
            'articles' => $articles,
            'course'   => $course
        ];
//        return view('front.applicant.courseDetail', ['data' => $data]);
        return response()->json([
            'code' => 0,
            'msg'  => '',
            'data' => $data
        ]);
    }

    /**
     * 申请人党校报名界面
     */
    public function signUpPage(){
        $user = $this->userService->getCurrentUser();

        $can = $this->applicantService->canEntryTest($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);

        $data = [
            'user' => $user,
            'test' => $can['test'],
        ];
        return view('front.applicant.signUp', ['data' => $data]);
    }

    public function signUp(Request $request){
        $data = $request->only(['school']);
        if(count($data) != 1){
            return $this->alertService->alertAndBack('提示', '请选择考试校区');
        }

        $user = $this->userService->getCurrentUser();
        $can = $this->applicantService->canEntryTest($user['userNumber']);
        if(!$can['status'])
            return $this->alertService->alertAndBack('提示', $can['msg']);

        $form = EntryForm::create([
            'sno'	=>	$user['userNumber'],
            'test_id'	=>	$can['test']['id'],
            'entry_time'	=>	date("Y-m-d H:i:s"),
            'campus'    => $data['school'] == 'new' ? '新校区' : '老校区'
        ]);
        if(! $form){
            return $this->alertService->alertAndBackWithError('遇到了一个错误');
        }
        return $this->alertService->alertAndBackWithSuccess('请查看报名结果以确保报名信息无误', $url = url('applicant/signResult'));
    }

    /**
     * 报名结果界面
     */
    public function signUpResult(){
        $user = $this->userService->getCurrentUser();

        $entryForm = EntryForm::getSignResult($user['userNumber']);

        if(!$entryForm)
            return $this->alertService->alertAndBack('提示', '您没有报名考试');
        $entryForm = $entryForm[0];
        TestList::warpStatus($entryForm);
        EntryForm::warpStatus($entryForm);
        //dd($entryForm);
        $data = [
            'user' => $user,
            'form' => $entryForm
        ];

        return view('front.applicant.signUpResult', ['data' => $data]);
    }

    /**
     * 退出报名
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signExit(){
        $user = $this->userService->getCurrentUser();
        $entryForm = EntryForm::getSignResult($user['userNumber']);
        if(!$entryForm)
            return $this->alertService->alertAndBack('提示', '您没有报名考试');
        $entryForm = $entryForm[0];
        if($entryForm['isExit'])
            return $this->alertService->alertAndBack('提示', '您已经退出考试了！');

        $flag = EntryForm::exitEntryByUserNumber($user['userNumber'], $entryForm['id']);

        if(!$flag)
            return $this->alertService->alertAndBackWithError('遇到了一个错误');
        return $this->alertService->alertAndBackWithSuccess('退出成功');
    }

    /**
     * 成绩查询界面
     */
    public function grade(){
        $user = $this->userService->getCurrentUser();

        $entryList = EntryForm::gradeCheck($user['userNumber']);
        foreach($entryList as &$v){
            TestList::warpStatus($v);
            EntryForm::warpStatus($v);
            EntryForm::warpIsPassed($v);
        }
        $data = [
            'user' => $user,
            'list' => $entryList
        ];
        //dd($entryList);
        return view('front.applicant.grade', ['data' => $data]);
    }

    /**
     * 申请人党校成绩申诉界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function complainPage(){
        return view('front.applicant.complain');
    }

    /**
     * 申请人党校成绩申诉
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complain(Request $request){
        $data = $request->only(['title', 'content', 'testId']);
        if(count($data) != 2){
            return $this->alertService->alertAndBackWithError('请确认标题与内容填写无误');
        }
        $user = $this->userService->getCurrentUser();

        $entryList = EntryForm::getGradeBySnoAndTestId($user['userNumber'], $data['testId']);
        if(!$entryList)
            return $this->alertService->alertAndBackWithError('您没有参加这场考试，无法申诉');
        $flag = Complain::create([
            'from_sno' => $user['userNumber'],
            'to_sno' => '',
            'collegeid' => $user['collegeId'],
            'test_id' => $data['testId'],
            'title' => $data['title'],
            'content' => $data['content'],
            'type' => Complain::TYPE['APPLICANT'],
            'isread' => 0
        ]);

        if(!$flag){
            return $this->alertService->alertAndBackWithError('系统发生了错误，请稍后重试，或联系管理员解决');
        }

        // TODO 加一个申诉界面吧，还有需要控制申诉期，申诉期过了就不能申诉了

    }

    /**
     * 证书查询
     */
    public function certificate(){
        $user = $this->userService->getCurrentUser();
        $entry = EntryForm::certificateCheck($user['userNumber']);
        if (!$entry){
            return $this->alertService->alertAndBack('提示：没有证书结果' ,'如果你没有参加过或者未通过申请人结业考试,或者通过,
            但是结业证书还未发放,这些情况您都无法看到自己的证书.如果长时间查看不到自己的结业证书而[成绩查询]中显示您的考试状态
            为通过.那么请联系管理员核实并解决此问题');
        }
        else{
            $entry_id = $entry[0]['id'];
            $cert = Cert::certCheckApplicant($entry_id);
            if (!$cert){
                return $this->alertService->alertAndBackWithError('不好意思,没有找到相应的证书,请联系管理员!');
            }
            else{
                dd($cert);
                return view('front.applicant.certificate', ['cert' => $cert]);
            }
        }
    }

    /**
     * 账号状态
     */
    public function userStatus(){
        $user = $this->userService->getCurrentUser();

        $isPass20 = StudentInfo::isPass20($user['userNumber']) ? '通过' : '未通过';
        $isClear20 = StudentInfo::isClear20($user['userNumber']) ? '被清' : '正常';
        $isLocked = StudentInfo::applicantIsLocked($user['userNumber']) ? '被锁' : '正常';
        $isPassed = EntryForm::isPass($user['userNumber']) ? '通过' : '未通过';
        $data = [
            'user' => $user,
            'info' => [
                'isPass20' => $isPass20,
                'isClear20' => $isClear20,
                'isLocked' => $isLocked,
                'isPassed' => $isPassed,
            ]
        ];
        return view('front.applicant.status', ['data' => $data]);
    }
}