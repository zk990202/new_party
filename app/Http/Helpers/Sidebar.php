<?php

namespace App\Http\Helpers;

use App\Models\Module;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/**
 * 边栏管理类
 * Class Sidebar
 * @package App\Http\Helpers
 */
class Sidebar
{
    // 渲染出的html代码
    protected static $html = "";

    /**
     * 初始化
     */
    public static function init(){

        self::$html = "";

        // 当前可以展示的边栏
        $modules = Module::where('is_show', 1)->get()->all();
        $modules = array_map(function($module){
            return Resources::Module($module);
        }, $modules);

        // 需要active的边栏
//        $activeNodes = self::getActiveNodes($modules) ?? [];
        $activeNodes = [];
        $map = [];
        foreach($modules as $module){
            $map[$module['parent_id']][] = $module;
        }
        $modules = self::getNode($map, ['id' => 0]);

        // 生成html代码
        foreach($modules['children'] as $module){
            self::$html .= self::renderHtml($module, $activeNodes);
        }
    }

    public static function render(){
        self::init();
        return self::$html;
    }

    /**
     * @param $map
     * @param $node
     * @return mixed
     */
    protected static function getNode($map, $node){
        if(!isset($map[$node['id']]))
            return $node;
        else{
            foreach ($map[$node['id']] as $child_node){
                $node['children'][] = self::getNode($map, $child_node);
            }
            return $node;
        }
    }

    /**
     * @param $node
     * @param $activeNodes
     * @return mixed|string
     */
    protected static function renderHtml($node, $activeNodes){

        $active = in_array($node['id'], $activeNodes) ? " active" : "";
        if(isset($node['children'])){
            $beforeStr = "<a href=\"#\"><i class=\"".
                $node['icon'] .
                "\"></i><span>" .
                $node['name'] .
                "</span><span class=\"pull-right-container\"><i class=\"fa fa-angle-left pull-right\"></i></span></a>";
            $contain = "<li class=\"treeview". $active ."\">__ITEM__</li>";
            $afterStr = "<ul class=\"treeview-menu\">__ITEM__</ul>";
            $childStr = '';
            foreach($node['children'] as $child){
                $childStr .= self::renderHtml($child, $activeNodes);
            }

            $afterStr = str_replace('__ITEM__', $childStr, $afterStr);
            $contain = str_replace('__ITEM__', $beforeStr.$afterStr, $contain);
            return $contain;
        }
        else{
            if($node['url']){
                $url = url( $node['url'] );
            }
            else if(isset($node['route'])){
                $nodeId = $node['route']['id'];
                $url = Routes::getRouteAction($nodeId);
            }
            else{
                $url = "#";
            }
            return "<li class='".$active."'><a href=\" " . $url . " \"><i class=\"". $node['icon'] ."\"></i> " . $node['name'] . "</a></li>";
        }
    }

    /**
     * @param $modules
     * @return array|null
     */
    protected static function getActiveNodes($modules){
        $action = Request::path();
        $module = Module::where('url', $action)->first();

        if(!$module)
            return null;
        $module = Resources::Module($module);
        $father = [];
        foreach($modules as $i => $v){
            $father[$v['id']] = $v['parent_id'];
        }
        $moduleId = $module['id'];
        $res = [];
        while(isset($father[$moduleId])){
            $res[] = $moduleId;
            $moduleId = $father[$moduleId];
        }
        return $res;
    }

    /**
     * @return array
     */
    public static function currentNodes(){
        $modules = Module::where('is_show', 1)->get()->all();
        $modules = array_map(function($module){
            return Resources::Module($module);
        }, $modules);
//        dd($modules);
        $action = Request::path();
        $route_name = Route::current()->action['as'];
//        dd($route_name);
        $module = Module::where('url', $action)->first();

        if(!$module)
            return [];
        $map = [];
        foreach($modules as $i => $v){
            $map[$v['id']] = $v;
        }
        $module = Resources::Module($module);
        $moduleId = $module['id'];

        $res = [];
        while(isset($map[$moduleId])){
            $res[] = $map[$moduleId];
            $moduleId = $map[$moduleId]['parent_id'];
        }
        return array_reverse($res);
    }
}
