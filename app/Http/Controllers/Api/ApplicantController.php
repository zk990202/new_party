<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/11/16
 * Time: 18:41
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Applicant\ArticleList;
use App\Models\Applicant\CourseList;
use App\Models\Applicant\ExerciseList;
use Illuminate\Http\Request;

class ApplicantController extends Controller {

    /**
     * 课程学习
     * @return \Illuminate\Http\JsonResponse
     */
    public function allCourse(){
        $course = CourseList::getAll();
        if ($course){
            return response()->json([
                'success' => 1,
                'course' => $course
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 一个课程对应的几篇文章
     * @param $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function course($course_id){
        //得到课程对应的文章
        $article = ArticleList::getArticleById($course_id);
        if ($article){
            return response()->json([
                'success' => 1,
                'article' => $article
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 文章详情
     * @param $article_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function article($article_id){
        $article = ArticleList::getOneArticle($article_id);
        if ($article){
            return response()->json([
                'success' => 1,
                'article' => $article
            ]);
        }else{
            return response()->json([
                'message' => 'Data Error'
            ]);
        }
    }

    /**
     * 根据课程id获取题目
     * @param $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function exercisePage($course_id){

        //这里还要判断以下用户能否进入答题

        $exercise = ExerciseList::getExerciseById($course_id);
        return response()->json([
            'success' => 1,
            'exercise' => $exercise
        ]);
    }

    public function exercise(Request $request, $course_id){
//        $exercise = ExerciseList::getExerciseById($course_id);
//        //前端传过来的answer数组
//        $answer = $request->input('answer');
//        if (count($answer) < )
//        for ($i = 0; $i < count($exercise); $i++){
//
//        }
//        return response()->json([
//            'answer' => $answer
//        ]);
    }
}