<?php
/**
 * Created by PhpStorm.
 * User: Liebes
 * Date: 2018/3/15
 * Time: 21:11
 */
namespace App\Http\Service;
use App\Models\AdminMenu;
use Illuminate\Support\Facades\Request;
class AdminMenuService{
    public static function getMenuName(){
        $uri = Request::getRequestUri();
        $uri = str_replace("/admin/", "", $uri);
        $menu = AdminMenu::where('uri', $uri)->first();

        if(!$menu)
            return ['管理后台'];
        $res = [];
        while($menu->parent_id > 0){
            array_unshift($res, $menu->title);
            $res[] = $menu->name;
            $menu = AdminMenu::find($menu->parent_id);
        }
        return $res;
    }


}