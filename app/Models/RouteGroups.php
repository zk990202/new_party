<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteGroups extends Model
{
    //

    protected $table = 'route_groups';

    public function subRoutes()
    {
        return $this->hasMany('App\Models\Routes', 'group_id');
    }
}
