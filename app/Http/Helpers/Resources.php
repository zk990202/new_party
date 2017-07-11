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
use App\Models\Notification;


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
}