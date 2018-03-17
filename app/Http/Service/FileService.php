<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 16/03/2018
 * Time: 3:05 PM
 */
namespace App\Http\Service;

class FileService{
    public static function allowedFileExtension($usage){
        $fileConfig = config('fileUpload.rules');

        if(!in_array($usage, array_keys($fileConfig)) || !isset($fileConfig[$usage]['extensions']))
            return '';
        $res = "";
        foreach($fileConfig[$usage]['extensions'] as $i => $item){
            $res .= $item;
            if($i < count($fileConfig[$usage]['extensions']) - 1){
                $res .= ', ';
            }
        }
        return $res;
    }

    public static function fileAccessUri($filePath){
        return $filePath ? config('app.url') . "/upload/" . str_replace("./upload/", "", $filePath) : '';
    }
}