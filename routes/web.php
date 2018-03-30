<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Front'], function(){
    // 首页
    Route::get('/', 'HomeController@index');
    Route::group(['prefix' => 'applicant'], function(){
        // 20课列表
        Route::get('courseStudy', 'ApplicantController@courseStudy');


    });

    Route::group(['prefix' => 'notification'], function(){
        Route::get('applicant', 'NotificationController@applicant');
        Route::get('academy', 'NotificationController@academy');
        Route::get('probationary', 'NotificationController@probationary');
        Route::get('secretary', 'NotificationController@secretary');
        Route::get('activity', 'NotificationController@activity');
    });

    Route::group(['prefix' => 'news'], function(){
        Route::get('partySchool', 'NewsController@partySchool');

    });

    Route::group(['prefix' => 'commonFiles'], function(){
        Route::get('regulation', 'FilesController@regulation');
        Route::get('instrument', 'FilesController@instrument');
        Route::get('mustRead', 'FilesController@mustRead');
        Route::get('manual', 'FilesController@manual');
    });
});

Route::get('test', function() {
    Auth::logout();
    $sso = new \TwT\SSO\Api(config('sso.app_id'), config('sso.app_key'));
    $token = "5Q2jc5HWk0s4tsv5dtmReIXD5AmulvNqY8pOiaNrGnkn6owyUgHmfAVIOFdw6I5Ev2CyXCa4Ld7ioX3BWohAszU6soZS7BaaYnOp";
    $user = $sso->fetchUserInfo($token);
    dd($user) ;
//    $sno = $user->result->user_number;
//    $user = \App\Models\UserInfo::where('user_number', $sno)->first();
//    Auth::login($user);
//    return Auth::user();
});
//})->middleware('auth');


Route::get('mig', function(){
    $a = DB::select("SELECT * FROM twt_manager_modules");

    $m = [];
    foreach($a as $v){
        $m[$v->self_id] = $v->id + 12;
    }


    foreach($a as $i => $v){
        if($v->parent_id > 0)
            $v->parent_id = $m[$v->parent_id];
        $c = $i + 13;

        $uri = str_replace("manager/", "", $v->url);
        $uri = str_replace("#", "", $uri);

        DB::insert("INSERT INTO admin_menu (parent_id, `order`, title, icon, uri) VALUES ($v->parent_id, $c, '$v->name', '$v->icon','$uri')");
        echo "success : $v->name</br>";
    }
    return "success";

});