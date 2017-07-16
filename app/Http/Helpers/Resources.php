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
use App\Models\CommonFiles;
use App\Models\Notification;
use App\Models\SpecialNews;


class Resources {
    public static function Notification(Notification $notification){
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