<?php

namespace App\Models;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $table = 'twt_files';
    protected $fillable = ['file_name', 'file_extension', 'file_path', 'file_size', 'file_usage'];

    public static function createFile($file){
        $file = self::create([
            'file_name'        => $file['name'],
            'file_path'        => $file['path'],
            'file_extension'   => $file['extension'],
            'file_size'        => $file['size'],
            'file_usage'       => $file['usage']
        ]);
        return Resources::File($file);
    }
}
