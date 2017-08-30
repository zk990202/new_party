<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    //
    protected $table = "twt_student_info";
    protected $primaryKey = 'info_id';

    public function college(){
        return $this->belongsTo('App\Models\College', 'academy_id', 'id');
    }
}
