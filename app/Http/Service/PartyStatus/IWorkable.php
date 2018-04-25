<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:15 AM
 */
namespace App\Http\Service\PartyStatus;

interface IWorkable{
    /**
     * 到达当前状态
     * @return void
     */
    public function to();

    /**
     * 取消当前状态
     * @return void
     */
    public function cancel();

    public function dependsOn(string $item);

    public function determines(string $item);

    /**
     * 获取依赖节点
     * @return array
     */
    public function dependenceList();

    /**
     * 获取下一层结点
     * @return array
     */
    public function determinationList();

    /**
     * 已经完成的结点
     * @return boolean
     */
    public function isActive();

    /**
     * 正在进行的节点
     * @return boolean
     */
    public function isProcessing();
}