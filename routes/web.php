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

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Front', 'middleware' => 'auth'], function(){
    // 首页
    Route::get('/', 'HomeController@index');

    // 入党申请人党校相关
    Route::group(['prefix' => 'applicant'], function(){
        // 20课列表
        Route::get('courseStudy', 'ApplicantController@courseStudy');
        Route::get('courseStudy/{id}', 'ApplicantController@courseDetail');

        Route::get('signUp', 'ApplicantController@signUpPage');
        Route::post('signUp', 'ApplicantController@signUp');

        Route::get('signResult', 'ApplicantController@signUpResult');
        Route::get('signExit', 'ApplicantController@signExit');

        Route::get('grade', 'ApplicantController@grade');
        Route::get('complain', 'ApplicantController@complainPage');
        Route::post('complain', 'ApplicantController@complain');

        Route::get('status', 'ApplicantController@userStatus');

    });

    //院级积极分子党校学习
    Route::group(['prefix' => 'academy'], function(){
        // 课程学习列表
        Route::get('courseStudy', 'AcademyController@courseStudy');
        Route::get('courseStudy/{id}', 'AcademyController@courseDetail');

        Route::get('signUp', 'AcademyController@signUpPage');
        Route::get('signResult', 'AcademyController@signUpResult');
        Route::post('signUp', 'AcademyController@signUp');

        Route::get('signExit', 'AcademyController@signExit');

        Route::get('grade', 'AcademyController@grade');
        Route::get('complain', 'AcademyController@complainPage');
        Route::post('complain', 'AcademyController@complain');

    });
    // 通知公告
    Route::group(['prefix' => 'notification'], function(){
        Route::get('applicant', 'NotificationController@applicant');
        Route::get('academy', 'NotificationController@academy');
        Route::get('probationary', 'NotificationController@probationary');
        Route::get('secretary', 'NotificationController@secretary');
        Route::get('activity', 'NotificationController@activity');
    });

    // 新闻板块
    Route::group(['prefix' => 'news'], function(){
        Route::get('partySchool', 'NewsController@partySchool');

    });

    // 重要文件
    Route::group(['prefix' => 'commonFiles'], function(){
        Route::get('regulation', 'FilesController@regulation');
        Route::get('instrument', 'FilesController@instrument');
        Route::get('mustRead', 'FilesController@mustRead');
        Route::get('manual', 'FilesController@manual');
    });

    // 个人支部
    Route::group(['prefix' => 'personal'], function(){
        Route::get('status', 'PersonalController@status');
        Route::get('partyBranch', 'PersonalController@partyBranch');
        Route::get('doc', 'PersonalController@docPage');
        Route::post('doc', 'PersonalController@docStore');
    });
});

Route::get('test', function() {
    $a = new \App\Http\Service\PartyStatus\ApplicantPartySchool();
    $a->setUserNumber('3014218099');
    $a->to();
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

Route::get('changeSql', function(){
    $colleges = DB::select("SELECT * FROM b_college WHERE `state` = 'ok'");
    foreach($colleges as $v){
        $map[$v->id] = $v->code;
    }
    $table = [
        'b_userinfo'           => 'college_id',
        'twt_academy_testlist' => 'test_of_academy',
        'twt_complain'         => 'collegeid',
        'twt_manager'          => 'manager_academy',
        'twt_partybranch'      => 'partybranch_academy',
        'twt_student_info'     => 'academy_id',
    ];

    foreach($table as $key => $v){
        echo "processing $key ...<br/>";
        foreach($map as $pre => $cur){
            if(!$pre || !$cur )
                continue;
            echo "UPDATE $key SET `$v` = $cur WHERE `$v` = $pre ";
            echo "<br/>";
            $flag = DB::update("UPDATE $key SET `$v` = $cur WHERE `$v` = $pre");
            echo $flag ? 'success' : 'false';
            echo "<br/>";
        }
    }
});