<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2017/7/9
 * Time: 下午12:18
 */
namespace App\Http\Helpers;

use App\Models\Academy\EntryForm as AcademyEntryForm;
use App\Models\Academy\TestList as AcademyTestList;
use App\Models\Applicant\ArticleList;
use App\Models\Applicant\CourseList;
use App\Models\Applicant\ExerciseList;
use App\Models\CommonFiles;
use App\Models\Notification;
use App\Models\SpecialNews;


class Resources {
    public static function Notification(Notification $notification){
//        dd($notification->column);
//        exit;
        return [
            'id'        =>  $notification->notice_id,
            'columnId'  =>  $notification->column_id,
            'columnName'=>  $notification->column->column_name,
            'title'     =>  $notification->notice_title,
            'content'   =>  $notification->notice_content,
            'time'      =>  $notification->notice_time,
            'fileName'  =>  $notification->notice_filename,
            'filePath'  =>  $notification->notice_filepath,
            'isTop'     =>  $notification->notice_istop,
            'authorName'=>  $notification->owner->username ?? '',
            'isHidden'  =>  $notification->notice_ishidden,
            'isDeleted' =>  $notification->notice_isdeleted
        ];
    }

    public static function SpecialNews(SpecialNews $partyBuild){
        return [
            'id' => $partyBuild->id,
            'title' => $partyBuild->title,
            'summary' => $partyBuild->summary,
            'content' => $partyBuild->content,
            'time' => $partyBuild->inserttime,
            'authorName' => $partyBuild->owner->username ?? '',
            'type' => $partyBuild->type,
            'typeName' => $partyBuild->column->column_name,
            'isTop' => $partyBuild->isrecommand,
            'imgPath' => $partyBuild->img_path,
            'isHidden' => $partyBuild->isdeleted
        ];
    }

    public static function CommonFiles(CommonFiles $commonFiles){
        return [
            'id' => $commonFiles->file_id,
            'title' => $commonFiles->file_title,
            'content' => $commonFiles->file_content,
            'time' => $commonFiles->file_addtime,
            'type' => $commonFiles->file_type,
            'filePath' => $commonFiles->file_img,
            'isHidden' => $commonFiles->file_isdeleted
        ];
    }

    public static function CourseList(CourseList $courseList){
       // dd($courseList);
        return [
            'id' => $courseList->course_id,
            'courseName' => $courseList->course_name,
            'detail' => $courseList->course_detail,
            'priority' => $courseList->course_priority,
            'time' => $courseList->course_inserttime,
            'isHidden' => $courseList->course_ishidden,
            'isDeleted' => $courseList->course_isdeleted
        ];
    }

    public static function ArticleList(ArticleList $articleList){
//        dd($articleList->courseList->course_name) ;
//        exit;
        return [
            'id' => $articleList->article_id,
            'courseId' => $articleList->course_id,
            'articleName' => $articleList->article_name,
            'courseName' =>$articleList->courseList->course_name ?? "",
            'content' => $articleList->article_content,
            'isHidden' => $articleList->article_ishidden,
            'isDeleted' => $articleList->article_isdeleted
        ];
    }

    public static function ExerciseList(ExerciseList $exerciseList){
        return [
            'id' => $exerciseList->exercise_id,
            'courseId' => $exerciseList->course_id,
            'courseName' => $exerciseList->courseList->course_name ?? "",
            'type' => $exerciseList->exercise_type,
            'content' => $exerciseList->exercise_content,
            'optionA' => $exerciseList->exercise_optionA,
            'optionB' => $exerciseList->exercise_optionB,
            'optionC' => $exerciseList->exercise_optionC,
            'optionD' => $exerciseList->exercise_optionD,
            'optionE' => $exerciseList->exercise_optionE,
            'answer' => $exerciseList->exercise_answer,
            'isHidden' => $exerciseList->exercise_ishidden,
            'isDeleted' => $exerciseList->exercise_isdeleted
        ];
    }

    public static function File($file){
        return [
            'id'    => $file->id,
            'path'  => $file->file_path,
            'name'  => $file->file_name,
            'size'  => $file->file_size,
            'extension' => $file->file_extension,
            'usage' => $file->file_usage
        ];
    }

    public static function Column($column){
        return [
            'id'    => $column->column_id,
            'pid'   => $column->column_pid,
            'name'  => $column->column_name
        ];
    }
    public static function Module($module){
        return [
            'id'        =>  $module->self_id,
            'parent_id' =>  $module->parent_id,
            'name'      =>  $module->name,
            'url'       =>  $module->url,
            'icon'      =>  $module->icon,
            'is_show'   =>  $module->is_show,
            'auth'      =>  $module->auth
        ];
    }
}