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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function(){
    return view('index');
});

/**
 * 管理员后台模块，路由为 /manager/{module}, 命名空间 \App\Http|Controllers\Manager
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
     * 申请人管理模块，路由为 /manager/applicant/{action}, 命名空间 \App\Http|Controllers\Manager\Applicant
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
    * 院级积极分子管理模块，路由为 /manager/academy/{action}, 命名空间 \App\Http|Controllers\Manager\Academy
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
     * 预备党员管理模块，路由为 /manager/probationary/{action}, 命名空间 \App\Http|Controllers\Manager\Probationary
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
     * 党支部管理模块，路由为 /manager/party-branch/{action}, 命名空间 \App\Http|Controllers\Manager\PartyBranch
     */
    Route::group(['namespace' => 'PartyBranch', 'prefix' => 'party-branch'], function(){

        //
        Route::group([], function(){

        });

    });

    /**
     * 数据统计模块，路由为 /manager/statistics/{action}, 命名空间 \App\Http|Controllers\Manager\
     */
    Route::group(['prefix' => 'statistics'], function(){

        // 登陆统计
        Route::get('loginPage', 'StatisticsController@loginPage');
        Route::get('login', 'StatisticsController@login');

        // 20课统计
        Route::get('twentyLessonsPage', 'StatisticsController@twentyLessonsPage');
        Route::get('twentyLessons', 'StatisticsController@twentyLessons');
    });

    /**
     * 通知公告管理模块，路由为 /manager/notice/{action},命名空间 \App\Http|Controllers\Manager\
     */
    Route::group(['prefix' => 'notice'], function(){
        Route::group(['prefix' => 'party-school'], function(){
            Route::get('{type}', 'NoticeController@partySchool');
            Route::patch('{notice_id}/hide', 'NoticeController@hide');
            Route::patch('{notice_id}/topUp', 'NoticeController@topUp');

            Route::get('{notice_id}/edit', 'NoticeController@editPage');
            Route::post('{notice_id}/edit', 'NoticeController@edit');
        });
    });

    Route::post('file', 'FileController@upload');
});

