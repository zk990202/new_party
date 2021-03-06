<?php
/**
 * 处理api返回状态码及状态信息
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/10/24
 * Time: 18:17
 */

namespace App\Http\Helpers;


class CodeAndMessage
{
    protected static $indexTrans = [
         0  => 0,
         1  => 1,
         2  => 2,
         3  => 3,
        500 => 4,
        501 => 5
    ];

    protected static $codeMessage = [
        ['code' => 0, 'msg' => '操作成功'],
        ['code' => 1, 'msg' => '参数错误'],
        ['code' => 2, 'msg' => '状态不匹配'],
        ['code' => 3, 'msg' => '参数丢失'],
        ['code' => 500, 'msg' => '系统错误'],
        ['code' => 501, 'msg' => '未登录']
    ];

    public static function returnMsg($code, $msg='empty'){
        if ($msg == 'empty'){
            $msg = [
                'category' => self::$codeMessage[self::$indexTrans[$code]]['msg'],
                'detail'   => ''
            ];
        }
        else{
            $msg = [
                'category' => self::$codeMessage[self::$indexTrans[$code]]['msg'],
                'detail'   => $msg
            ];
        }
        return $msg;
    }
}