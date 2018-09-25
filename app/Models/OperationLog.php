<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/9/25
 * Time: 16:07
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{

    protected $table = 'twt_operation_log';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ['user_id', 'path', 'method', 'ip', 'input'];

}