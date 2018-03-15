<?php
/**
 * Created by PhpStorm.
 * User: Liebes
 * Date: 2018/3/15
 * Time: 21:06
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{

    protected $table = 'admin_menu';

    public $timestamps = false;

    public function getMenuName($uri){
        $menu = $this->where('uri', $uri)->get();
        return $menu;
    }

    private function getMenuNameById(){

    }
}