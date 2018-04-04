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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Front', 'middleware' => 'auth'], function(){
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

    Route::group(['prefix' => 'personal'], function(){
        Route::get('status', 'PersonalController@status');
    });
});

Route::get('test', function() {
    $a = new \App\Http\Service\PartyStatus\ProbationaryMember();
    $a->setUserNumber('3014218099');
    $a->cancel();
    dd($a->isActive());
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