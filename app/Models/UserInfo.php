<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $table = "b_userinfo";

    public function major(){
        return $this->belongsTo('App\Models\Major', 'major', 'majorid');
    }

    public function college(){
        return $this->belongsTo('App\Models\College', 'collegeid', 'id');
    }
}
