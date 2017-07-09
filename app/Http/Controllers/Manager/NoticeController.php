<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use App\Models\Notification;

class NoticeController extends Controller
{

    /**
     * @param $type [70|71|72]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function partySchool($type){
        if(!in_array($type, [70, 71, 72])){
            throw new InvalidParameterException();
        }
        $notice_arr = Notification::getAllNotice($type);
        return view('Manager/Notice/partySchool', ['notices' => $notice_arr]);
    }

}
