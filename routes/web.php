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
use App\Models\Module;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function(){
    return view('index');
});

/**
 * 管理员后台模块，路由为 /manager/{module}, 命名空间 \App\Http\Controllers\Manager
 */
Route::group(['namespace' => 'Manager', 'prefix' => 'manager'], function (){

    /**
     * 用户管理模块，路由为 /manager/user/{action}
     */
    Route::group(['prefix' => 'user'], function(){

        /**
         * 获取全部管理用户列表，可选参数有limit，offset，page，manager_type_id
         */
        Route::get('/', 'UserController@lists');

        /**
         * 管理用户列表展示页
         */
        Route::get('/view', 'UserController@showListsView');

    });

    /**
     * 党建专项模块， 路由为 /manager/party-build/{action}, 命名空间 \App\Http\Controllers\Manager\
     */
    Route::group(['prefix' => 'party-build'], function (){
        //党建专项新闻列表
        Route::get('list', 'PartyBuildController@lists');

        //隐藏(显示)、置顶(取消置顶)新闻
        Route::patch('{id}/hide', 'PartyBuildController@hide');
        Route::patch('{id}/topUp', 'PartyBuildController@topUp');

        //编辑新闻
        Route::get('{id}/edit', 'PartyBuildController@editPage');
        Route::post('{id}/edit', 'PartyBuildController@edit');

        //添加新闻
        Route::get('add', 'PartyBuildController@addPage');
        Route::post('add', 'PartyBuildController@add');
    });

    /**
     * 学习小组模块， 路由为 /manager/study-group/{action}, 命名空间 App\Http\Controllers\Manager\
     */
    Route::group(['prefix' => 'study-group'], function (){
        //新闻列表
        Route::get('list', 'StudyGroupController@lists');

        //隐藏(显示)、置顶(取消置顶)新闻
        Route::patch('{id}/hide', 'StudyGroupController@hide');
        Route::patch('{id}/topUp', 'StudyGroupController@topUp');

        //编辑新闻
        Route::get('{id}/edit', 'StudyGroupController@editPage');
        Route::post('{id}/edit', 'StudyGroupController@edit');

        //添加新闻
        Route::get('add', 'StudyGroupController@addPage');
        Route::post('add', 'StudyGroupController@add');
    });

    /**
     * 党校培训模块， 路由为 /manager/party-school/{action}, 命名空间 App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'party-school'], function (){
        //新闻列表
        Route::get('list', 'PartySchoolController@lists');

        //隐藏(显示)、置顶(取消置顶)新闻
        Route::patch('{id}/hide', 'PartySchoolController@hide');
        Route::patch('{id}/topUp', 'PartySchoolController@topUp');

        //编辑新闻
        Route::get('{id}/edit', 'PartySchoolController@editPage');
        Route::post('{id}/edit', 'PartySchoolController@edit');

        //添加新闻
        Route::get('add', 'PartySchoolController@addPage');
        Route::post('add', 'PartySchoolController@add'); 
    });

    /**
     * 申请人管理模块，路由为 /manager/applicant/{action}, 命名空间 \App\Http\Controllers\Manager\Applicant
     */
    Route::group(['namespace' => 'Applicant', 'prefix' => 'applicant'], function(){

        // 课程控制
        Route::group(['prefix' => 'course'], function(){

        });

        // 考试管理
        Route::group(['prefix' => 'train'], function(){

        });

        // 申诉管理
        Route::group(['prefix' => 'train'], function(){

        });
    });

    /**
    * 院级积极分子管理模块，路由为 /manager/academy/{action}, 命名空间 \App\Http\Controllers\Manager\Academy
    */
    Route::group(['namespace' => 'Academy', 'prefix' => 'academy'], function(){

        // 培训控制
        Route::group(['prefix' => 'train'], function(){

        });

        // 考试管理
        Route::group(['prefix' => 'exam'], function(){

        });

        // 申诉管理
        Route::group(['prefix' => 'appeal'], function(){

        });
    });

    /**
     * 预备党员管理模块，路由为 /manager/probationary/{action}, 命名空间 \App\Http\Controllers\Manager\Probationary
     */
    Route::group(['namespace' => 'Probationary', 'prefix' => 'probationary'], function(){

        // 培训控制
        Route::group(['prefix' => 'train'], function(){

        });

        // 考试管理
        Route::group(['prefix' => 'exam'], function(){

        });

        // 申诉管理
        Route::group(['prefix' => 'appeal'], function(){

        });
    });

    /**
     * 党支部管理模块，路由为 /manager/party-branch/{action}, 命名空间 \App\Http\Controllers\Manager\PartyBranch
     */
    Route::group(['namespace' => 'PartyBranch', 'prefix' => 'party-branch'], function(){

        //
        Route::group([], function(){

        });

    });

    /**
     * 数据统计模块，路由为 /manager/statistics/{action}, 命名空间 \App\Http\Controllers\Manager\
     */
    Route::group(['prefix' => 'statistics'], function(){

        // 登陆统计
        Route::get('loginPage', 'StatisticsController@loginPage');
        Route::get('login', 'StatisticsController@login');

        // 20课统计
        Route::get('twentyLessonsPage', 'StatisticsController@twentyLessonsPage');
        Route::get('twentyLessons', 'StatisticsController@twentyLessons');

        //申请人结业统计
        Route::get('applicantTestListPage', 'StatisticsController@applicantTestListPage');
        Route::get('applicantTestList', 'StatisticsController@applicantTestList');

        //积极分子结业统计
        Route::get('academyTestListPage', 'StatisticsController@academyTestListPage');
        Route::get('academyTestList/{type?}', 'StatisticsController@academyTestList');

        //支部统计
        Route::get('partyBranchPage/{type}', 'StatisticsController@partyBranchPage');
        Route::get('partyBranch/{type}', 'StatisticsController@partyBranch');

    });

    /**
     * 通知公告管理模块，路由为 /manager/notice/{action},命名空间 \App\Http\Controllers\Manager\
     */
    Route::group(['prefix' => 'notice'], function(){

        /**
         * 党校管理子模块，路由为 /manager/notice/party-school/{action}, 命名空间 \App\Http\Controllers\Manager\
         */
        Route::group(['prefix' => 'party-school'], function(){
            Route::get('list/{type}', 'NoticeController@partySchool');
            Route::patch('{notice_id}/hide', 'NoticeController@hide');
            Route::patch('{notice_id}/topUp', 'NoticeController@topUp');

            Route::get('{notice_id}/edit', 'NoticeController@editPage');
            Route::post('{notice_id}/edit', 'NoticeController@edit');

            Route::get('{notice_id}', 'NoticeController@getNoticeById');

        });
        /**
         * 添加公告子模块，路由为 /manager/notice/add/{action}, 命名空间 \App\Http\Controllers\Manager\
         */
        Route::group(['prefix' => 'add'], function(){
            Route::get('/', 'NoticeController@addPage');
            Route::post('/', 'NoticeController@add');
        });

        /**
         * 活动通知子模块，路由为 /manager/notice/activity/{action}, 命名空间 \App\Http\Controllers\Manager\
         */
        Route::group(['prefix' => 'activity'], function (){
            Route::get('list', 'NoticeController@activity');
            Route::patch('{activity_id}/hide', 'NoticeController@hide');
            Route::patch('{activity_id}/topUp', 'NoticeController@topUp');

            Route::get('{activity_id}/edit', 'NoticeController@activityEditPage');
            Route::post('{activity_id}/edit', 'NoticeController@activityEdit');

            Route::get('add', 'NoticeController@activityAddPage');
            Route::post('add', 'NoticeController@activityAdd');

        });
    });

    /**
     * 文件上传下载控制
     */
    Route::group(['prefix' => 'file'], function(){
        Route::post('/', 'FileController@upload');
    });

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
        Route::get('logout', 'LoginController@logout')->name('logout');
    });

});

Route::group(['prefix' => 'manager/auth', 'namespace' => 'Manager\Auth'], function(){
    Route::get('login', 'LoginController@loginPage')->name('login');
    Route::post('login', 'LoginController@login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function(){
    Auth::guard('admin')->logout();
});