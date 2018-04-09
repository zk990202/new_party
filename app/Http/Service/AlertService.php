<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2018/4/9
 * Time: 11:33 AM
 */
namespace App\Http\Service;

class AlertService{
    const ALERT_TYPE = [
        'INFO'    => 0,
        'SUCCESS' => 1,
        'ERROR'   => 2
    ];

    public function alertAndBackByConfig($msg){
        $type = $msg['type'] ?? self::ALERT_TYPE['INFO'];

        if($type == self::ALERT_TYPE['INFO']){
            alert()->info($msg['title'], $msg['content']);
            return back();
        }
        if($type == self::ALERT_TYPE['SUCCESS']){
            alert()->success($msg['title'], $msg['content']);
            return back();
        }
        if($type == self::ALERT_TYPE['ERROR']){
            alert()->error($msg['title'], $msg['content']);
            return back();
        }
        alert()->alert($msg['title'], $msg['content']);
        return back();
    }

    public function alertAndBack($title, $content){
        alert()->alert($title, $content);
        return back();
    }

    public function alertAndBackWithError($content){
        alert()->error('错误', $content);
        return back();
    }
    public function alertAndBackWithSuccess($content){
        alert()->success('成功', $content);
        return back();
    }


}