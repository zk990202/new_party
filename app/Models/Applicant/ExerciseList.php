<?php

namespace App\Models\Applicant;

use App\Http\Helpers\Resources;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Model;


/**
 * Class ExerciseList
 * 入党申请人习题
 * @package App\Models\Applicant
 */
class ExerciseList extends Model
{
    //
    protected $table = "twt_applicant_exerciselist";
    protected $primaryKey = 'exercise_id';

    //创建时间字段
    const CREATED_AT = 'created_at';

    protected $fillable = ['course_id', 'exercise_type', 'exercise_content', 'exercise_optionA', 'exercise_optionB',
        'exercise_optionC', 'exercise_optionC', 'exercise_optionD', 'exercise_optionE', 'exercise_answer',
        'exercise_ishidden', 'exercise_isdeleted'];

    public function courseList(){
        return $this->belongsTo('App\Models\Applicant\CourseList', 'course_id', 'course_id');
    }

    public function exerciseAnswerTransform(){
        return $this->belongsTo('App\Models\Applicant\ExerciseAnswerTransform', 'exercise_answer', 'exercise_answer_number');
    }

    /**
     * 获取所有题目
     * @return array
     */
    public static function getAll(){
        $res_all = self::where('exercise_isdeleted', 0)
            ->orderBy('course_id', 'ASC')
            ->orderBy('exercise_type', 'DESC')
            ->get()->all();

        return array_map(function ($exerciseList){
            return Resources::ExerciseList($exerciseList);
        }, $res_all);
    }

    /**
     * 根据课程id获取题目
     * @param $id
     * @return array
     */
    public static function getExerciseById($id){
        $exercises = self::where('course_id', $id)
            ->where('exercise_isdeleted', 0)
            ->get()->all();
        return array_map(function ($exercise){
            return Resources::ExerciseList($exercise);
        }, $exercises);
    }

    /**
     * 更新题目
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateById($id, $data){
        $exercise = self::findOrFail($id);
        $exercise->course_id = $data['courseId'];
        $exercise->exercise_type = $data['type'];
        $exercise->exercise_content = $data['content'];
        $exercise->exercise_optionA = $data['optionA'];
        $exercise->exercise_optionB = $data['optionB'];
        $exercise->exercise_optionC = $data['optionC'];
        $exercise->exercise_optionD = $data['optionD'];
        $exercise->exercise_optionE = $data['optionE'];
        $exercise->exercise_answer = $data['answerNumber'];

        $res = $exercise->save();
        return $res ? Resources::ExerciseList($exercise) : false;
    }

    /**
     * 根据课程id添加题目
     * @param $course_id
     * @param $data
     * @return array|bool
     */
    public static function add($course_id, $data){
        $exercise = self::create([
            'course_id' => $course_id,
            'exercise_type' => $data['type'],
            'exercise_content' => $data['content'],
            'exercise_optionA' => $data['optionA'],
            'exercise_optionB' => $data['optionB'],
            'exercise_optionC' => $data['optionC'],
            'exercise_optionD' => $data['optionD'],
            'exercise_optionE' => $data['optionE'],
            'exercise_answer' => $data['answerNumber'],
            'exercise_ishidden' => 0,
            'exercise_isdeleted' => 0
        ]);
        return $exercise ? Resources::ExerciseList($exercise) : false;
    }
}
