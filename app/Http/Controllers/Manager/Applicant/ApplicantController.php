<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/8/22
 * Time: 9:48
 */

namespace App\Http\Controllers\Manager\Applicant;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Resources;
use App\Models\Applicant\ArticleList;
use App\Models\Applicant\CourseList;
use App\Models\Applicant\ExerciseAnswerTransform;
use App\Models\Applicant\ExerciseList;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Mockery\Exception;

class ApplicantController extends Controller{

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
            'message' => '添加失败，请练习后台管理员'
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
}