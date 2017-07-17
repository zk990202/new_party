<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends \Illuminate\Foundation\Auth\User
{

    use EntrustUserTrait;
    //
    protected $table = 'twt_admin';

    protected $fillable = ['username', 'real_name', 'password', 'type', 'is_deleted', 'remember_token'];


}
