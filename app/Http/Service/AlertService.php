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

    public function alertAndBackByConfig($msg, $url = null){
        $type = $msg['type'] ?? self::ALERT_TYPE['INFO'];

        if($type == self::ALERT_TYPE['INFO']){
            alert()->info($msg['title'], $msg['content']);
            return $url ? redirect($url) : back();
        }
        if($type == self::ALERT_TYPE['SUCCESS']){
            alert()->success($msg['title'], $msg['content']);
            return $url ? redirect($url) : back();
        }
        if($type == self::ALERT_TYPE['ERROR']){
            alert()->error($msg['title'], $msg['content']);
            return $url ? redirect($url) : back();
        }
        alert()->alert($msg['title'], $msg['content']);

        return $url ? redirect($url) : back();
    }

    public function alertAndBack($title, $content, $url = null){
        alert()->alert($title, $content);
        //dd(back());
        return $url ? redirect($url) : back();
    }

    public function alertAndBackWithError($content, $url = null){
        alert()->error('错误', $content);
        return $url ? redirect($url) : back();
    }
    public function alertAndBackWithSuccess($content, $url = null){
        alert()->success('成功', $content);
        return $url ? redirect($url) : back();
    }


}