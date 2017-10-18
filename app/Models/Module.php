<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    protected $table = 'twt_manager_modules';
    protected $fillable = ['parent_id', 'icon', 'name', 'url', 'is_show', 'auth'];
    public $timestamps = false;

    public function route()
    {
        return $this->belongsTo('App\Models\Routes', 'route_id');
    }
    
}
