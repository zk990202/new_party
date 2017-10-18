<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 18/07/2017
 * Time: 4:05 PM
 */

namespace App\Http\Helpers;

use App\Models\RouteGroups;
use App\Models\Routes as Route;

class Routes {

    public static function generate(){

        $routes = self::getGroups();

        self::createRouteFile($routes, 'webs');

    }

    public static function createRouteFile($routes, $name){
        $file = fopen(storage_path().'/../routes/'.$name.'.php', 'w');

        fwrite($file, "<?php\n\n");

        self::writeGroup($file, $routes);

        fclose($file);
    }

    public static function writeGroup($file, $group){

        // write description

        fwrite($file, '// ' . ($group['desc'] ?? '') . "\n");

        fwrite($file, "Route::group(");

        $options = $group['options'] ?? [];
        $op_str = self::optionStr($options);
        fwrite($file, $op_str);
        fwrite($file, ", function(){\n\n");
//        dd(1);
        // write subgroups
        $subGroups = $group['subGroups'] ?? [];

        foreach($subGroups as $subGroup){
            self::writeGroup($file, $subGroup);
        }

        // write sub routes

        $subRoutes = $group['subRoutes'] ?? [];
        foreach($subRoutes as $route){
            fwrite($file, '// ' . ($route['desc'] ?? '') . "\n");

            fwrite($file, "Route::".$route['method']."(");

            fwrite($file, "'".$route['action']."', ");

            $url = $route['url'] ?? [];
            $op_str = self::optionStr($url);
            fwrite($file, $op_str);

            fwrite($file, ");\n\n");

        }

        fwrite($file, "});\n\n");
    }

    public static function optionStr ($options){
        $op_str = '[';
        $comma = '';
        foreach($options as $i => $v){

            if(is_array($v)){
                $op_str .= $comma. "'" . $i . "' => ";
                $op_str .= "[";
                $t_comma = '';
                foreach($v as $item){
                    $op_str .= $t_comma. "'" . $item . "'";
                }
                $op_str .= "]";
            }
            else{
                $op_str .= $comma. "'" . $i . "' => '" . $v . "'";
            }

            $comma = ',';
        }
        $op_str .= ']';

        return $op_str;
    }

    public static function getGroup($group, $map){
        if(isset($map[$group['id']])){
            foreach($map[$group['id']] as $i => $v){
                $group['subGroups'][] = self::getGroup($v, $map);
            }
        }
        return $group;
    }

    public static function getGroups(){
        $groups = RouteGroups::get()->all();
        $groups = array_map(function($group){
            return Resources::RouteGroups($group);
        }, $groups);

        $groupsMap = [];
        $root = [
            'id'        =>  0,
            'subGroups' =>  null,
            'subRoutes' =>  null,
            'options' =>  null,
            'desc'      =>  ''
        ];
        $groupsParentMap = [];
        foreach($groups as $group){
            $groupsParentMap[$group['parentId']][] = $group;
        }
        $res = self::getGroup($root, $groupsParentMap);
        return $res;
    }

    /**
     * @param $routeId
     * @return string
     * 通过路由id，递归查找父节点，生成对应url
     */
    public static function getRouteAction($routeId){
//        dd($routeId);
        $path = "";
        $route = Route::findOrFail($routeId);
        $route = Resources::Routes($route);
        $path = $route['action'];
        $path = self::getGroupPrefix($route['groupId']) . $path;
        return $path;
    }

    /**
     * @param $groupId
     * @return string
     * 递归查找路由组的前缀
     */
    public static function getGroupPrefix($groupId){
        if($groupId == 0)
            return "/";
        $routeGroup = RouteGroups::findOrFail($groupId);
        $routeGroup = Resources::RouteGroups($routeGroup);
        $prefix = self::getGroupPrefix($routeGroup['parentId']);
        return $prefix . $routeGroup['options']->prefix . "/";
    }

}