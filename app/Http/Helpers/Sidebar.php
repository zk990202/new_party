<?php

namespace App\Http\Helpers;

use App\Models\Module;
use Illuminate\Support\Facades\Request;

/**
 * Class Sidebar
 * @package App\Http\Helpers
 */
class Sidebar
{
    protected static $html = "";

    public static function init(){

        self::$html = "";
        $modules = Module::where('is_show', 1)->get()->all();
        $modules = array_map(function($module){
            return Resources::Module($module);
        }, $modules);
        $activeNodes = self::getActiveNodes($modules) ?? [];
        $map = [];

        foreach($modules as $module){
            $map[$module['parent_id']][] = $module;
        }
        $modules = self::getNode($map, ['id' => 0]);
        foreach($modules['children'] as $module){
            self::$html .= self::renderHtml($module, $activeNodes);
        }
    }

    public static function render(){
        self::init();
//        dd(self::$html);
        return self::$html;
    }

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

    protected static function renderHtml($node, $activeNodes){
//    dd($node);
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
            return "<li class='".$active."'><a href=\" " . url( $node['url'] ) . " \"><i class=\"". $node['icon'] ."\"></i> " . $node['name'] . "</a></li>";
        }
    }

    protected static function getActiveNodes($modules){
        $action = Request::path();
        $module = Module::where('url', $action)->first();
//        dd($module);
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

}
