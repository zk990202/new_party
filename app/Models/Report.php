<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $table = "twt_report";

    const CREATED_AT = 'file_addtime';
    const UPDATED_AT = null;

    const FILE_TYPE = [
        'REPORT_1'  => 2,
        'REPORT_2'  => 3,
        'REPORT_3'  => 4,
        'REPORT_4'  => 5,
    ];
}
