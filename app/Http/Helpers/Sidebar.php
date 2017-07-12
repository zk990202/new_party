<?php

namespace App\Http\Helpers;

use App\Http\Helpers\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Module;

class Sidebar
{
    protected static $html = "";
    public static function init(){
        self::$html = "";
        $modules = Module::where('is_show', 1)->get()->all();
        $modules = array_map(function($module){
            return Resources::Module($module);
        }, $modules);

        $map = [];

        foreach($modules as $module){
            $map[$module['parent_id']][] = $module;
        }
        $modules = self::getNode($map, ['id' => 0]);
        foreach($modules['children'] as $module){
            self::$html .= self::renderHtml($module, '');
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

    protected static function renderHtml($node, $active = ""){
//    dd($node);
        if(isset($node['children'])){
            $beforeStr = "<a href=\"#\"><i class=\"".
                $node['icon'] .
                "\"></i><span>" .
                $node['name'] .
                "</span><span class=\"pull-right-container\"><i class=\"fa fa-angle-left pull-right\"></i></span></a>";
            $contain = "<li class=\"treeview\">__ITEM__</li>";
            $afterStr = "<ul class=\"treeview-menu\">__ITEM__</ul>";
            $childStr = '';
            foreach($node['children'] as $child){
                $childStr .= self::renderHtml($child, $active);
            }
            $afterStr = str_replace('__ITEM__', $childStr, $afterStr);
            $contain = str_replace('__ITEM__', $beforeStr.$afterStr, $contain);
            return $contain;
        }
        else{
            return "<li><a href=\" " . url( $node['url'] ) . " \"><i class=\"". $node['icon'] ."\"></i> " . $node['name'] . "</a></li>";
        }
    }
}
