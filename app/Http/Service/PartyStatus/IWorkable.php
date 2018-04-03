<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:15 AM
 */
namespace App\Http\Service\PartyStatus;

interface IWorkable{
    public function to();

    public function cancel();

    public function dependsOn(string $item);


    public function determines(string $item);

    /**
     * @return array
     */
    public function dependenceList();

    /**
     * @return array
     */
    public function determinationList();

    public function isActive();
}