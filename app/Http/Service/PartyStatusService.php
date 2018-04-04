<?php


/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:05 AM
 */
namespace App\Http\Service;
class PartyStatusService{

    /**
     * 获取个人入党状况 0 未完成 1 正在进行 2 已完成
     * @param $userNumber
     * @return array
     */
    public function getPersonalStatus($userNumber){
        $status = [];

        // 初始节点,根据依赖关系取得每个节点状态
        $determinationList = ['PartyApplication'];
        while(!empty($determinationList)){
            $tmp = [];
            foreach($determinationList as $v){
                if(isset($status[$v]))
                    continue;

                $obj = app()->make(config('party.namespace') . $v);
                $obj->setUserNumber($userNumber);

                //要保证当前节点父节点都已经完成了初始化，如果未完成，放进下一轮迭代数组进行初始化
                $flag = true;
                foreach($obj->dependenceList() as $item){
                    if(!isset($status[$item])){
                        $flag = false;
                        break;
                    }
                }
                if(!$flag){
                    $tmp[] = $v;
                    continue;
                }
                $status[$v] = $obj->isActive() ? 2 : 0;
                // 判断正在进行中的结点
                if($status[$v] == 0){
                    $flag = true;
                    foreach($obj->dependenceList() as $item){
                        if($status[$item] != 2){
                            //只要父节点有一没有通过，就判定为未通过
                            $flag = false;
                            break;
                        }
                    }
                    if($flag)
                        $status[$v] = 1;
                }

                $tmp = array_merge($tmp, $obj->determinationList());
            }
            $determinationList = array_unique($tmp);
        }

        return $status;
    }


}