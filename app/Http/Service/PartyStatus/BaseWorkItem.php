<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:22 AM
 */

namespace App\Http\Service\PartyStatus;

use Illuminate\Support\Facades\App;

abstract class BaseWorkItem implements IWorkable{
    protected $dependenceList;
    protected $determinationList;
    protected $userNumber;
    protected $name;
    protected $actionUri;

    public function __construct()
    {
        $this->dependenceList = [];
        $this->determinationList = [];
        $className = get_called_class();

        $className = explode('\\', $className);
        $className = end($className);

        $this->dependenceList = config("party.nodes.$className.dependsOn");
        $this->determinationList = config("party.nodes.$className.determines");
        $this->name = config("party.nodes.$className.name");
        $this->actionUri = config("party.nodes.$className.actionUri");
    }

    public function to(){
        foreach($this->dependenceList as $v){
            $v = config('party.namespace') . $v;
            $a =  app()->make($v);
            $a->setUserNumber($this->userNumber);
            $a->to();
        }
    }

    public function cancel(){
        foreach($this->determinationList as $v){
            $v = config('party.namespace') . $v;
            $a = App::make($v);
            $a->setUserNumber($this->userNumber);
            $a->cancel();
        }
    }

    public function dependsOn(string $item)
    {
        $this->dependenceList[] = $item;
    }

    public function determines(string $item)
    {
        $this->determinationList[] = $item;
    }

    public function dependenceList()
    {
        return $this->dependenceList;
    }

    public function determinationList()
    {
        return $this->determinationList;
    }


    public function setUserNumber($userNumber){
        $this->userNumber = $userNumber;
    }

    public function isProcessing(){
        if($this->isActive())
            return false;
        $flag = true;
        foreach($this->dependenceList() as $item){
            $obj = app()->make(config('party.namespace') . $item);
            $obj->setUserNumber($this->userNumber);
            if(! $obj->isActive()){
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    public function getName(){
        return $this->name;
    }

    public function getActionUri(){
        return $this->getActionUri();
    }
}