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
use App\Models\RouteGroups;
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

//        dd($module);
        $route = $module->route_id ? self::Routes($module->route) : null;
        return [
            'id'        =>  $module->self_id,
            'parent_id' =>  $module->parent_id,
            'name'      =>  $module->name,
            'url'       =>  $module->url,
            'route'     =>  $route,
            'icon'      =>  $module->icon,
            'is_show'   =>  $module->is_show,
            'auth'      =>  $module->auth
        ];
    }

    public static  function RouteGroups($group){
        $subRoutes = $group->subRoutes->all();
        return [
            'id'        =>  $group->id,
            'parentId'  =>  $group->parent_id,
            'options'   => json_decode($group->options),
            'desc'      =>  $group->desc,
            'subRoutes' =>  empty($subRoutes) ? null : array_map(function($route){
//                dd($route);
                return self::Routes($route);
            }, $subRoutes),
            'subGroups' =>  null
        ];
    }

    public static function Routes($route){
//        dd($route);
        return [
            'id'        =>  $route->id,
            'groupId'   =>  $route->group_id,
            'url'       =>  json_decode($route->url),
            'method'    =>  $route->method,
            'action'    =>  $route->action,
            'desc'      =>  $route->desc,
        ];
    }
}