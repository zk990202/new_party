<?php

//
Route::group([], function(){

// 管理员后台模块，路由为 /manager/{module}, 命名空间 \App\Http\Controllers\Manager
    Route::group(['prefix' => 'manager','namespace' => 'Manager','middleware' => ['web']], function(){

// 党建专项模块， 路由为 /manager/party-build/{action}, 命名空间 \App\Http\Controllers\Manager
        Route::group(['prefix' => 'party-build'], function(){

// 党建专项新闻列表
            Route::get('list', ['as' => 'manager-party-build-list','uses' => 'PartyBuildController@lists']);

// 隐藏(显示)新闻
            Route::patch('{id}/hide', ['as' => 'manager-party-build-hide','uses' => 'PartyBuildController@hide']);

// 置顶(取消置顶)新闻
            Route::patch('{id}/top-up', ['as' => 'manager-party-build-top-up','uses' => 'PartyBuildController@topUp']);

// 编辑新闻展示页
            Route::get('{id}/edit', ['as' => 'manager-party-build-edit-page','uses' => 'PartyBuildController@editPage']);

// 编辑新闻
            Route::post('{id}/edit', ['as' => 'manager-party-build-edit','uses' => 'PartyBuildController@edit']);

// 添加新闻页
            Route::get('add', ['as' => 'manager-party-build-add-page','uses' => 'PartyBuildController@addPage']);

// 添加新闻
            Route::post('add', ['as' => 'manager-party-build-add','uses' => 'PartyBuildController@add']);

        });

// 学习小组模块， 路由为 /manager/study-group/{action}, 命名空间 App\Http\Controllers\Manager
        Route::group(['prefix' => 'study-group'], function(){

// 新闻列表
            Route::get('list', ['as' => 'manager-study-group-list','uses' => 'StudyGroupController@lists']);

// 隐藏(显示)新闻
            Route::patch('{id}/hide', ['as' => 'manager-study-group-hide','uses' => 'StudyGroupController@hide']);

// 置顶(取消置顶)新闻
            Route::patch('{id}/top-up', ['as' => 'manager-study-group-top-up','uses' => 'StudyGroupController@topUp']);

// 编辑新闻
            Route::get('{id}/edit', ['as' => 'manager-study-group-edit-page','uses' => 'StudyGroupController@editPage']);

// 编辑新闻
            Route::post('{id}/edit', ['as' => 'manager-study-group-edit','uses' => 'StudyGroupController@edit']);

// 添加新闻
            Route::get('add', ['as' => 'manager-study-group-add-page','uses' => 'StudyGroupController@addPage']);

// 添加新闻
            Route::post('add', ['as' => 'manager-study-group-add','uses' => 'StudyGroupController@add']);

        });

// 党校培训模块， 路由为 /manager/party-school/{action}, 命名空间 App\Http\Controllers\Manager
        Route::group(['prefix' => 'party-school'], function(){

// 新闻列表
            Route::get('list', ['as' => 'manager-party-school-list','uses' => 'PartySchoolController@lists']);

// 隐藏(显示)新闻
            Route::patch('{id}/hide', ['as' => 'manager-party-school-hide','uses' => 'PartySchoolController@hide']);

// 置顶(取消置顶)新闻
            Route::patch('{id}/top-up', ['as' => 'manager-party-school-top-up','uses' => 'PartySchoolController@topUp']);

// 编辑新闻
            Route::get('{id}/edit', ['as' => 'manager-party-school-edit-page','uses' => 'PartySchoolController@editPage']);

// 编辑新闻
            Route::post('{id}/edit', ['as' => 'manager-party-school-edit','uses' => 'PartySchoolController@edit']);

// 添加新闻
            Route::get('add', ['as' => 'manager-party-school-add-page','uses' => 'PartySchoolController@addPage']);

// 添加新闻
            Route::post('add', ['as' => 'manager-party-school-add','uses' => 'PartySchoolController@add']);

        });

// 重要文件模块， 路由为 /manager/important-files/{action}, 命名空间 App\Http\Controllers\Manager
        Route::group(['prefix' => 'important-files'], function(){

// 新闻列表
            Route::get('list', ['as' => 'manager-important-files-list','uses' => 'ImportantFilesController@lists']);

// 隐藏(显示)
            Route::patch('{id}/hide', ['as' => 'manager-important-files-hide','uses' => 'ImportantFilesController@hide']);

// 编辑新闻
            Route::get('{id}/edit', ['as' => 'manager-important-files-edit-page','uses' => 'ImportantFilesController@editPage']);

// 编辑新闻
            Route::post('{id}/edit', ['as' => 'manager-important-files-edit','uses' => 'ImportantFilesController@edit']);

// 添加新闻
            Route::GET('add', ['as' => 'manager-important-files-add-page','uses' => 'ImportantFilesController@addPage']);

// 添加新闻
            Route::post('add', ['as' => 'manager-important-files-add','uses' => 'ImportantFilesController@add']);

        });

// 数据统计模块，路由为 /manager/statistics/{action}, 命名空间 \App\Http\Controllers\Manager
        Route::group(['prefix' => 'statistics'], function(){

// 登陆统计
            Route::get('login-page', ['as' => 'manager-statistics-login-page','uses' => 'StatisticsController@loginPage']);

// 登陆统计
            Route::get('login', ['as' => 'manager-statistics-login','uses' => 'StatisticsController@login']);

// 20课统计
            Route::get('twenty-lessons-page', ['as' => 'manager-statistics-twenty-lessons-page','uses' => 'StatisticsController@twentyLessonsPage']);

// 20课统计
            Route::get('twenty-lessons', ['as' => 'manager-statistics-twenty-lessons','uses' => 'StatisticsController@twentyLessons']);

// 申请人结业统计
            Route::get('applicant-test-list-page', ['as' => 'manager-statistics-applicant-test-list-page','uses' => 'StatisticsController@applicantTestListPage']);

// 申请人结业统计
            Route::get('applicant-test-list', ['as' => 'manager-statistics-applicant-test-list','uses' => 'StatisticsController@applicantTestList']);

// 积极分子结业统计
            Route::get('academy-test-list-page', ['as' => 'manager-statistics-academy-test-list-page','uses' => 'StatisticsController@academyTestList']);

// 积极分子结业统计
            Route::get('academy-test-list/{type?}', ['as' => 'manager-statistics-academy-test-list','uses' => 'StatisticsController@academyTestList']);

// 支部统计
            Route::get('party-branch-page/{type}', ['as' => 'manager-statistics-party-branch-page','uses' => 'StatisticsController@partyBranchPage']);

// 支部统计
            Route::get('party-branch/{type}', ['as' => 'manager-statistics-party-branch','uses' => 'StatisticsController@partyBranch']);

        });

// 通知公告管理模块，路由为 /manager/notice/{action},命名空间 \App\Http\Controllers\Manager
        Route::group(['prefix' => 'notice'], function(){

// 通知公告管理模块，路由为 /manager/notice/{action},命名空间 \App\Http\Controllers\Manager
            Route::group(['prefix' => 'party-school'], function(){

// 党校新闻列表
                Route::get('list/{type}', ['as' => 'manager-notice-party-school','uses' => 'NoticeController@partySchool']);

// 隐藏新闻
                Route::patch('{notice_id}/hide', ['as' => 'manager-notice-hide','uses' => 'NoticeController@hide']);

// 置顶新闻
                Route::patch('{notice_id}/top-up', ['as' => 'manager-notice-top-up','uses' => 'NoticeController@topUp']);

// 编辑新闻
                Route::get('{notice_id}/edit', ['as' => 'manager-notice-edit-page','uses' => 'NoticeController@editPage']);

// 编辑新闻
                Route::post('{notice_id}/edit', ['as' => 'manager-notice-edit','uses' => 'NoticeController@edit']);

// 单个公告详情
                Route::get('{notice_id}', ['as' => 'manager-notice-get','uses' => 'NoticeController@getNoticeById']);

            });

// 添加公告子模块，路由为 /manager/notice/add/{action}, 命名空间 \App\Http\Controllers\Manager
            Route::group(['prefix' => 'add'], function(){

// 添加公告
                Route::get('/', ['as' => 'manager-notice-add-page','uses' => 'NoticeController@addPage']);

// 添加公告
                Route::post('/', ['as' => 'manager-notice-add','uses' => 'NoticeController@add']);

            });

// 活动通知子模块，路由为 /manager/notice/activity/{action}, 命名空间 \App\Http\Controllers\Manager
            Route::group(['prefix' => 'activity'], function(){

// 活动通知列表
                Route::get('list', ['as' => 'manager-notice-activity-list','uses' => 'NoticeController@activity']);

// 隐藏活动通知
                Route::patch('{activity_id}/hide', ['as' => 'manager-notice-activity-hide','uses' => 'NoticeController@hide']);

// 置顶活动通知
                Route::patch('{activity_id}/top-up', ['as' => 'manager-notice-activity-top-up','uses' => 'NoticeController@topUp']);

// 编辑活动通知
                Route::get('{activity_id}/edit', ['as' => 'manager-notice-activity-edit-page','uses' => 'NoticeController@activityEditPage']);

// 编辑活动通知
                Route::post('{activity_id}/edit', ['as' => 'manager-notice-activity-edit','uses' => 'NoticeController@activityEdit']);

// 编辑活动通知
                Route::get('add', ['as' => 'manager-notice-activity-add-page','uses' => 'NoticeController@activityAddPage']);

// 编辑活动通知
                Route::post('add', ['as' => 'manager-notice-activity-add','uses' => 'NoticeController@activityAdd']);

            });

        });

// 文件上传下载控制
        Route::group(['prefix' => 'file'], function(){

// 文件上传
            Route::post('/', ['as' => 'manager-file-upload','uses' => 'FileController@upload']);

        });

// 用户权限管理
        Route::group(['prefix' => 'auth','namespace' => 'Auth'], function(){

// 用户退出
            Route::get('logout', ['as' => 'manager-auth-logout','uses' => 'LoginController@logout']);

// 用户角色列表
            Route::get('role', ['as' => 'manager-auth-role','uses' => 'RoleController@rolePage']);

        });

    });

//
    Route::group(['prefix' => 'manager/auth','namespace' => 'Manager\Auth'], function(){

// 登录
        Route::get('login', ['as' => 'manager-auth-login-page','uses' => 'LoginController@loginPage']);

// 登录
        Route::post('login', ['as' => 'manager-auth-login','uses' => 'LoginController@login']);

    });

});

Route::get('test', function(){

    $res = DB::table('job_gonggao')->limit(10)->select()->first();
    $title = $res->title;
//    dd($title);
    $title = mb_convert_encoding($title, 'ISO-8859-1', 'UTF-8');
    echo $title;
});

