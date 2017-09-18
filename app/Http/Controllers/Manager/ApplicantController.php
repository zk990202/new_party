<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/8/22
 * Time: 9:48
 */

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Resources;
use App\Models\Applicant\ArticleList;
use App\Models\Applicant\CourseList;
use App\Models\Applicant\EntryForm;
use App\Models\Applicant\ExerciseAnswerTransform;
use App\Models\Applicant\ExerciseList;
use App\Models\Applicant\TestList;
use App\Models\Cert;
use App\Models\CertLost;
use App\Models\College;
use App\Models\Complain;
use App\Models\ScoresTwenty;
use App\Models\StudentInfo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ApplicantController extends Controller{

    protected $fileExtensions;
    protected $fileUsage = "applicantFile";

    public function __construct()
    {
        $this->fileExtensions = config('fileUpload');
    }

    //----------------------以下是课程设置部分--------------------------------------------------------------
    /**
     * 课程列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseList(){
        $course_arr = CourseList::getAll();
        return view('Manager.Applicant.Course.list', ['courses' => $course_arr]);
    }

    /**
     * 隐藏(显示)课程
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseHide($id){
        $courseList = CourseList::findOrFail($id);
        $courseList->course_ishidden = $courseList->course_ishidden ^ 1;
        $courseList->save();
        return response()->json([
           'status' => 'success'
        ]);
    }

    public function courseDetail($id){
        $course = CourseList::getCourseById($id);
//        dd($course);
        $article = ArticleList::getArticleById($id);
//        dd($article);
        $exercise = ExerciseList::getExerciseById($id);
        return view('Manager.Applicant.Course.detail', ['courses' => $course, 'articles' => $article, 'exercises' => $exercise]);
    }

    /**
     * 修改课程名称和简介
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseEdit(Request $request, $id){
        $name = $request->input('courseName');
        $detail = $request->input('detail');
        try{
            $res = CourseList::updateById($id, [
                'courseName' => $name,
                'detail' => $detail
            ]);
            if($res){
                return response()->json([
                    'info' => $res,
                    'success' => true
                ]);
            }else {
                return response()->json([
                    'message' => '更新失败，请联系后台管理员',
                ]);
            }
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'id有误，未找到'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseEditPage($id){
        $course = CourseList::findOrFail($id);
        $course = Resources::CourseList($course);
        return view('Manager.Applicant.Course.edit', ['courses' => $course]);
    }

    public function getCourseById($id){
        try{
            $course = CourseList::findOrFail($id);
            return response()->json([
                'success' => true,
                'info' => Resources::CourseList($course)
            ]);
        }catch (ModelNotFoundException $e){
            return response()->json(['message' => 'Course not found']);
        }
    }

    //---------------以下是文章设置部分----------------------------------------------------------------

    /**
     * 文章列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articleList(){
        $article_arr = ArticleList::getAll();

        return view('Manager.Applicant.Article.list', ['articles' => $article_arr]);
    }

    /**
     * 隐藏(显示)文章
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function articleHide($id){
        $articleList = articleList::findOrFail($id);
        $articleList->article_ishidden = $articleList->article_ishidden ^ 1;
        $articleList->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 删除文章
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
   public function articleDelete($id){
        $articleList = articleList::findOrFail($id);
        $articleList->article_isdeleted = 1;
        $articleList->save();
        return response()->json([
            'status' => 'success'
        ]);
   }

    /**
     * 更新文章
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function articleEdit(Request $request, $id){
        $articleName = $request->input('articleName');
        $courseId = $request->input('courseId');
        $content = $request->input('content');
        try{
            $res = ArticleList::updateById($id, [
                'articleName' => $articleName,
                'courseId' => $courseId,
                'content' => $content
            ]);
            if($res){
                return response()->json([
                    'info' => $res,
                    'success' => true
                ]);
            }else{
                return response()->json([
                    'message' => '更新失败，请联系后台管理员'
                ]);
            }
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'id有误，未找到'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articleEditPage($id){
        $article = ArticleList::findOrFail($id);
        $article = Resources::ArticleList($article);
        $course = CourseList::getCourse();
        return view('Manager.Applicant.Article.edit', ['articles' => $article, 'courses' => $course]);
    }

    /**
     * 根据课程id添加文章
     * @param Request $request
     * @param $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function articleAdd(Request $request, $course_id){
        $articleName = $request->input('articleName');
        $content = $request->input('content');
        if(!$articleName || !$content || !$course_id){
            return response()->json([
                'message' => '参数丢失'
            ]);
        }
        $res = ArticleList::add($course_id, [
            'articleName' => $articleName,
            'content' => $content,
        ]);
        if($res){
            return response()->json([
                'success' => true,
                'info' => $res
            ]);
        }
        return response()->json([
            'message' => '添加失败，请联系后台管理员'
        ]);
    }

    /**
     * @param $course_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articleAddPage($course_id){
        $course = CourseList::getCourseById($course_id);
        return view('Manager.Applicant.Article.add', ['courses' => $course]);
    }

    public function getArticleById($id){
        try{
            $article = ArticleList::findOrFail($id);
            return response()->json([
                'success' => true,
                'info' => Resources::ArticleList($article)
            ]);
        }catch (ModelNotFoundException $e){
            return response()->json(['message' => 'Article not found']);
        }

    }

    //--------------------以下是题目控制部分-----------------------------------------------------------

    /**
     * 题目列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function exerciseList(){
        $exercise_arr = ExerciseList::getAll();
        return view('Manager.Applicant.Exercise.list', ['exercises' => $exercise_arr]);
    }

    /**
     * 隐藏(显示)题目
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function exerciseHide($id){
        $exerciseList = ExerciseList::findOrFail($id);
        $exerciseList->exercise_ishidden = $exerciseList->exercise_ishidden ^ 1;
        $exerciseList->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 删除题目
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function exerciseDelete($id){
        $exerciseList = ExerciseList::findOrFail($id);
        $exerciseList->isdeleted = 1;
        $exerciseList->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 更新题目
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function exerciseEdit(Request $request, $id){
        $courseId = $request->input('courseId');
        $type = $request->input('type');
        $content = $request->input('content');
        $optionA = $request->input('optionA');
        $optionB = $request->input('optionB');
        $optionC = $request->input('optionC');
        $optionD = $request->input('optionD');
        $optionE = $request->input('optionE');
        $answerNumber = $request->input('answerNumber');
        try{
            $res = ExerciseList::updateById($id, [
                'courseId' => $courseId,
                'type' => $type,
                'content' => $content,
                'optionA' => $optionA,
                'optionB' => $optionB,
                'optionC' => $optionC,
                'optionD' => $optionD,
                'optionE' => $optionE,
                'answerNumber' => $answerNumber
            ]);
            if($res){
                return response()->json([
                    'info' => $res,
                    'success' => true
                ]);
            }
            else{
                return response()->json([
                    'message' => '更新失败，请联系后台管理员'
                ]);
            }
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'id有误，未找到'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function exerciseEditPage($id){
        $exercise = ExerciseList::findOrFail($id);
        $exercise = Resources::ExerciseList($exercise);
        $course = CourseList::getCourse();
        $answer = ExerciseAnswerTransform::getAnswer();
        return view('Manager.Applicant.Exercise.edit', ['exercises' => $exercise, 'courses' => $course, 'answers' => $answer]);
    }

    /**
     * 添加题目
     * @param Request $request
     * @param $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function exerciseAdd(Request $request, $course_id){
        $type = $request->input('type');
        $content = $request->input('content');
        $optionA = $request->input('optionA');
        $optionB = $request->input('optionB');
        $optionC = $request->input('optionC');
        $optionD = $request->input('optionD');
        $optionE = $request->input('optionE');
        $answerNumber = $request->input('answerNumber');
        if(!$type || !$content || !$optionA || !$optionB|| !$optionC || !$optionD){
            return response()->json([
                'message' => '参数丢失(注意：A、B、C、D选项不可为空，E选项可为空)'
            ]);
        }
        $res = ExerciseList::add($course_id, [
            'type' => $type,
            'content' => $content,
            'optionA' => $optionA,
            'optionB' => $optionB,
            'optionC' => $optionC,
            'optionD' => $optionD,
            'optionE' => $optionE,
            'answerNumber' => $answerNumber
        ]);
        if($res){
            return response()->json([
                'success' => true,
                'info' => $res
            ]);
        }
        return response()->json([
            'message' => '添加失败，请联系后台管理员'
        ]);
    }

    /**
     * @param $course_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function exerciseAddPage($course_id){
        $course = CourseList::getCourseById($course_id);
        $answer = ExerciseAnswerTransform::getAnswer();
        return view('Manager.Applicant.Exercise.add', ['courses' => $course, 'answers' => $answer]);
    }

    public function getExerciseById($id)
    {
        try {
            $exercise = ExerciseList::findOrFail($id);
            return response()->json([
                'success' => true,
                'info' => Resources::ExerciseList($exercise)
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Exercise not found']);
        }
    }

    //---------------------以下是考试控制部分--------------------------------------------------------------

    /**
     * 考试列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function examList(){
        $exams = TestList::getAll();
        return view('Manager.Applicant.Exam.list', ['exams' => $exams]);
    }

    /**
     * 考试详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function examDetail($id){
        $exam = TestList::getExamById($id);
        return view('Manager.Applicant.Exam.detail', ['exam' => $exam]);
    }

    /**
     * 删除考试
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function examDelete($id){
        $testList = TestList::findOrFail($id);
        $testList->test_isdeleted = 1;
        $testList->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 附件下载
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function examDownload($id){
        $exam = TestList::getExamById($id);
        $fileName = $exam[0]['fileName'];
        $filePath = $exam[0]['filePath'];
//        $res = base_path($filePath);
//        $res = realpath(base_path($filePath));
        $res = $filePath;
        dd(base_path($filePath));
        dd(realpath(base_path('public/js')));
        return response()->download($res, $fileName);
}

    /**
     * 修改考试
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function examEdit(Request $request, $id){
        $name = $request->input('name');
        $time = $request->input('time');
        $attention = $request->input('attention');
        $fileName = $request->input('fileName');
        $filePath = $request->input('filePath');
        try{
            $res = TestList::updateById($id, [
                'name' => $name,
                'time' => $time,
                'attention' => $attention,
                'fileName' => $fileName,
                'filePath' => $filePath
            ]);
            if($res){
                return response()->json([
                    'info' => $res,
                    'success' => true
                ]);
            }
            else{
                return response()->json([
                    'message' => '更新失败，请联系后台管理员'
                ]);
            }
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'id有误，未找到'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function examEditPage($id){
        $exam = TestList::findOrFail($id);
        $exam = Resources::TestList($exam);
        return view('Manager.Applicant.Exam.edit', ['exam' => $exam]);
    }

    /**
     * 添加考试
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function examAdd(Request $request){
        $name = $request->input('name');
        $time = $request->input('time');
        $attention = $request->input('attention');
        $fileName = $request->input('fileName') ?? '';
        $filePath = $request->input('filePath') ?? '';
        if(!$name || !$time){
            return response()->json([
                'message' => '参数丢失'
            ]);
        }
        $res = TestList::add([
            'name' => $name,
            'time' => $time,
            'attention' => $attention,
            'fileName' => $fileName,
            'filePath' => $filePath
        ]);
        if($res){
            return response()->json([
                'success' => true,
                'info' => $res
            ]);
        }
        return response()->json([
            'message' => '添加失败，请了联系后台管理员'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function examAddPage(){
        return view('Manager.Applicant.Exam.add');
    }

    public function getExamById($id){
        try{
            $exam = TestList::findOrFail($id);
            return response()->json([
                'success' => true,
                'info' => Resources::TestList($exam)
            ]);
        }catch (ModelNotFoundException $e){
            return response()->json(['message' => 'Exam not found']);
        }

    }

    //-------------------------------以下是报名情况模块-----------------------------------------------------
    /**
     * 报名列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signList(){
        $signs = EntryForm::getAllSign();
        return view('Manager.Applicant.Sign.list', ['signs' => $signs]);
    }

    /**
     * 退考列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signExit(){
        $signs = EntryForm::getSignExit();
        return view('Manager.Applicant.Sign.exit', ['signs' => $signs]);
    }

    /**
     * 补考报名页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signMakeupPage(){
        $signs = EntryForm::getAllSign();
        return view('Manager.Applicant.Sign.makeup', ['signs' => $signs]);
    }

    /**
     * 补考报名后台逻辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signMakeup(Request $request){
        $id = $request->input('id');
        $testId = $request->input('testId');
        $sno = $request->input('sno');
        if($testId && $sno){
            //这里看一下是否已经通过了申请人结业考试
            $isPass = EntryForm::makeupIsPass($sno);
            if(!$isPass){
                //这里再看一下是否已经参加过本次考试
                $isEntry = EntryForm::makeupIsEntry($sno, $testId);
                if(!$isEntry){
                    //这里还要再看一下20课是否已经通过了
                    $isPass20 = StudentInfo::makeupIsPass20($sno);
                    if($isPass20){
                        $res = EntryForm::makeup($id, $sno, $testId);
                        if($res){
                            return response()->json([
                                'success' => true,
                            ]);
                        }
                        else{
                            return response()->json([
                                'message' => '补考报名失败，请联系后台管理员'
                            ]);
                        }
                    }
                    else{
                        return response()->json([
                            'message' => '该学生还没有通过20课的学习,不可报名申请人党校结业考试!'
                        ]);
                    }
                }
                else{
                    return response()->json([
                        'message' => '不好意思，该同学已经参加过本期考试的报名了！'
                    ]);
                }
            }
            else{
                return response()->json([
                    'message' => '不好意思，该同学已经通过了申请人结业考试！无需再补考报名！'
                ]);
            }
        }
        else{
            return response()->json([
                'message' => '不好意思，请录入学号'
            ]);
        }
    }

    //--------------------以下是结业成绩统计模块--------------------------------------------------
    /**
     * 成绩筛选界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gradeListPage(){
        $exams = TestList::getAll();
        $colleges = College::getAll();
        return view('Manager.Applicant.Grade.listPage', ['exams' => $exams, 'colleges' => $colleges]);
    }

    /**
     * 筛选结果
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gradeList(Request $request){
        $testId = $request->input('testId');
        $college = $request->input('college');
//        dd($college);
        $res = EntryForm::getGrade($testId, $college);
//        dd($res);
        return view('Manager.Applicant.Grade.list', ['grades' => $res]);
    }

    //------------------------以下是成绩录入页面---------------------------------------------------------
    public function gradeInputPage(){
        $test = TestList::gradeInput();
        $testId = $test[0]['id'];
        $entries = EntryForm::gradeInput($testId);
        return view('Manager.Applicant.gradeInput.GradeInput', ['test' => $test, 'entries' => $entries]);
    }

    public function gradeInput(Request $request){
        $id = $request->input('id');
        $sno = $request->input('sno');
        $practiceGrade = $request->input('practiceGrade');
        $articleGrade = $request->input('articleGrade');
        $testId = $request->input('testId');
        $status = $request->input('status');
        for ($i = 0; $i < count($id); $i++){
            EntryForm::gradeInputUpdate($i, $id, $practiceGrade, $articleGrade, $status);
        }
        return view('Manager.Applicant.GradeInput.result');
    }

    //------------------------证书管理------------------------------------------------------------------
    /**
     * 证书筛选界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function certificateListPage(){
        $exams = TestList::getAll();
        $colleges = College::getAll();
        return view('Manager.Applicant.Certificate.listPage', ['exams' => $exams, 'colleges' => $colleges]);
    }

    /**
     * 证书筛选结果
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function certificateList(Request $request){
        $testId = $request->input('testId');
        $college = $request->input('college');
        $max = EntryForm::getMaxEntryId($testId);
        $min = EntryForm::getMinEntryId($testId);
        $res = Cert::getCert($max, $min, $college);
//        dd($res);
        return view('Manager.Applicant.Certificate.list', ['certificates' => $res]);
    }

    /**
     * 筛选考试合格但未发放证书的学生
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function certificateGrantPage(){
        $exams = TestList::getAll();
        $colleges = College::getAll();
        return view('Manager.Applicant.Certificate.grantPage', ['exams' => $exams, 'colleges' => $colleges]);
    }

    /**
     * 筛选结果
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function certificateGrant(Request $request){
        $testId = $request->input('testId');
        $college = $request->input('college');
        $res = EntryForm::getCert($testId, $college);
//        dd($res);
        return view('Manager.Applicant.Certificate.grant', ['certificates' => $res]);
    }

    /**
     * 进行证书发放的后台逻辑操作
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function certificateGrantResult(Request $request){
        $sno = $request->input('sno');
//        dd($sno);
        $entryId = array();
        for ($i = 0; $i < count($sno); $i++){
            $entryId[$i] = EntryForm::getEntryId($sno[$i]);
        }
//        dd($entryId[0]['entry_id']);
        $getPerson = $request->input('getPerson');
        $place = $request->input('place');

        //查询结果分类
        for($i = 0; $i < count($sno); $i++){
            Cert::addCert($sno, $entryId, $getPerson, $place, $i);
            $res = EntryForm::updateCert($sno, $i);
        }
        if(!$sno || !$getPerson || !$place){
            $res_type = 0;
        }
        else{
            $res_type = 1;
        }
        return view('Manager.Applicant.Certificate.grantResult', ['res_type' => $res_type]);
    }

    /**
     * 申请补办证书的列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function certificateLastGrant(){
        $certLost = CertLost::getCertLost();
        return view('Manager.Applicant.Certificate.lastGrant', ['certLosts' => $certLost]);
    }

    public function certificateLastGrantDetailPage($id){
        $certLost = CertLost::getCertLostById($id);
        return view('Manager.Applicant.Certificate.lastGrantDetail', ['certLost' => $certLost]);
    }

    /**
     * 通过补办
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function certificateLastGrantDetail(Request $request, $id){
        $dealWord = $request->input('dealWord');
        $sno = $request->input('sno');
        $entryId = EntryForm::getEntryId($sno);
        $getPerson = $request->input('getPerson');
        $place = $request->input('place');
        $certType = $request->input('certType');
        Cert::addLastCert($sno, $entryId, $getPerson, $place, $certType);
        $res = CertLost::updateCertLost($id, $dealWord);
        if($res){
            return response()->json([
                'success' => true,
                'info' => $res
            ]);
        }
        else{
            return response()->json([
                'message' => '补办失败'
            ]);
        }
    }

    /**
     * 驳回补办
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function certificateLastGrantReject(Request $request, $id){
        $dealWord = $request->input('dealWord');
        $res = CertLost::updateCertLostReject($id, $dealWord);
        if ($res){
            return response()->json([
                'success' => true,
                'info' => $res
            ]);
        }
        else{
            return response()->json([
                'message' => '驳回失败'
            ]);
        }
    }


    public function getCertificateById($id){
        try{
            $certLost = CertLost::findOrFail($id);
            return response()->json([
                'success' => true,
                'info' => Resources::CertLost($certLost)
            ]);
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'CertLost Not Found'
            ]);
        }
    }

    //--------------------以下是申诉管理部分--------------------------------------------------------------
    /**
     * 申诉列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function complainList(){
        $complains = Complain::getAll();
        return view('Manager.Applicant.Complain.list', ['complains' => $complains]);
    }
    /*
     * 新党建因为部分逻辑修改，可能会导致部分已回复的申诉显示为未回复，只需再提交一次即可解决
     * 新提交的回复内容不会覆盖原来回复的内容
     * 最终显示的回复内容仍然是之前所回复的
      */

    /**
     * 展示申诉还未回复的页面，含编辑器
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function complainDetailPage($id){
        $complain = Complain::getComplainById($id);
        $sno = $complain[0]['fromSno'];
        $testId = $complain[0]['testId'];
        $grade = EntryForm::getGradeBySnoAndTestId($sno, $testId);
//        dd($grade);
        return view('Manager.Applicant.Complain.detail', ['complain' => $complain, 'grade' => $grade]);
    }

    /**
     * 展示申诉已回复的页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function complainDetailPage_1($id){
        $complain = Complain::getComplainById($id);
        $sno = $complain[0]['fromSno'];
        $testId = $complain[0]['testId'];
        $grade = EntryForm::getGradeBySnoAndTestId($sno, $testId);
        $reply = Complain::getReply($id);
        return view('Manager.Applicant.Complain.detail_1', ['complain' => $complain, 'grade' => $grade, 'reply' => $reply]);
    }

    /**
     * 回复申诉
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function complainDetail(Request $request, $id){
        $title = $request->input('title');
        $content = $request->input('content');
        $sno = $request->input('sno');
        $type = $request->input('type');
        $res = Complain::addReply($id, $sno, $title, $content, $type);
        if($res){
            return response()->json([
                'success' => true,
                'info' => $res
            ]);
        }else{
            return response()->json([
                'message' => '回复失败'
            ]);
        }
    }

    public function getComplainById($id){
        try{
            $complain = Complain::findOrFail($id);
            return response()->json([
                'success' => true,
                'info' => Resources::Complain($complain)
            ]);
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'Complaint Not Found'
            ]);
        }
    }

    //---------------------------作弊+违纪--------------------------------------------------------------------------
    public function cheatListPage(){
        $exams = TestList::getAll();
        return view('Manager.Applicant.Cheat.listPage', ['exams' => $exams]);
    }

    public function cheatList(Request $request){
        $testId = $request->input('testId');
        $cheats = EntryForm::getInCheat($testId);
        return view('Manager.Applicant.Cheat.list', ['cheats' => $cheats]);
    }

    //----------------------------被锁人员---------------------------------------------------------------------
    /**
     * 被锁人员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lockedList(){
        $locks = StudentInfo::getLocked();
        return view('Manager.Applicant.Locked.list', ['locks' => $locks]);
    }

    /**
     * 解锁
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unlock($id){
        $studentInfo = StudentInfo::findOrFail($id);
        $studentInfo->applicant_islocked = 0;
        $studentInfo->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    //-----------------------------被清人员---------------------------------------------------------------------------
    public function clearList(){
        $clears = StudentInfo::getClear();
        return view('Manager.Applicant.Clear.list', ['clears' => $clears]);
    }

    public function unclear($id){
        $studentInfo = StudentInfo::findOrFail($id);
        $studentInfo->is_clear20 = 0;
        $studentInfo->is_pass20 = 1;
        $studentInfo->save();
//        ScoresTwenty::unclear20($sno);
        //对20scores表的操作还未完成
        return response()->json([
            'status' => 'success'
        ]);
    }
}