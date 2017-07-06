<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @param Request $request [offset, limit, page, manager_type_id]
     * @return array $user_lists
     */
    public function lists(Request $request){

        $user_lists = array();
        return $user_lists;
    }

    /**
     * 返回用户列表页
     */
    public function showListsView(){

    }
}
