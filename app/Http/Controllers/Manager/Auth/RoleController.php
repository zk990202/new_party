<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;

class RoleController extends Controller{
    public function rolePage(){


        return view('Manager/Auth/role');
    }
}

