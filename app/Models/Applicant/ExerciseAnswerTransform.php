<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/8/25
 * Time: 15:54
 */

namespace App\Models\Applicant;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class ExerciseAnswerTransform extends Model{

    protected $table = "twt_applicant_exerciseanswertransform";

    public static function getAnswer(){
        $answers = self::get()->all();
        return array_map(function ($answer){
            return Resources::ExerciseAnswerTransform($answer);
        }, $answers);
    }
}