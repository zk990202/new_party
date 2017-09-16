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

        Route::get('{id}', 'PartyBuildController@getNewsById');
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

        Route::get('{id}', 'StudyGroupController@getNewsById');
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

        Route::get('{id}', 'PartySchoolController@getNewsById');
    });

    /**
     * 重要文件模块， 路由为 /manager/important-files/{action}, 命名空间 App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'important-files'], function (){
        //新闻列表
        Route::get('list', 'ImportantFilesController@lists');

        //隐藏(显示)
        Route::patch('{id}/hide', 'ImportantFilesController@hide');

        //编辑新闻
        Route::get('{id}/edit', 'ImportantFilesController@editPage');
        Route::post('{id}/edit', 'ImportantFilesController@edit');

        //添加新闻
        Route::get('add', 'ImportantFilesController@addPage');
        Route::post('add', 'ImportantFilesController@add');

        Route::get('{id}', 'ImportantFilesController@getFilesById');
    });

    /**
     * 理论学习模块， 路由为 /manger/theory-study/{action}, 命名空间 App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'theory-study'], function (){
        //内容列表
        Route::get('list', 'TheoryStudyController@lists');

        //隐藏(显示)
        Route::patch('{id}/hide', 'TheoryStudyController@hide');

        //编辑
        Route::group(['prefix' => 'edit'], function (){
            //视频编辑
            Route::get('video/{id}', 'TheoryStudyController@editVideoPage');
            Route::post('video/{id}', 'TheoryStudyController@editVideo');

            //文章编辑
            Route::get('article/{id}', 'TheoryStudyController@editArticlePage');
            Route::post('article/{id}', 'TheoryStudyController@editArticle');

            //电子书编辑
            Route::get('eBook/{id}', 'TheoryStudyController@editEBookPage');
            Route::post('eBook/{id}', 'TheoryStudyController@editEBook');
        });

        //添加
        Route::group(['prefix' => 'add'], function (){
            //视频添加
            Route::get('video', 'TheoryStudyController@addVideoPage');
            Route::post('video', 'TheoryStudyController@addVideo');

            //文章添加
            Route::get('article', 'TheoryStudyController@addArticlePage');
            Route::post('article', 'TheoryStudyController@addArticle');

            //电子书添加
            Route::get('eBook', 'TheoryStudyController@addEBookPage');
            Route::post('eBook', 'TheoryStudyController@addEBook');
        });

        Route::get('{id}', 'TheoryStudyController@getContentsById');

    });

    /**
     * 消息管理模块， 路由为 /manager/message/{action}, 命名空间 App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'message'], function (){
        //收信箱
       Route::get('receive', 'MessageController@receive');

       //发信箱
       Route::get('send', 'MessageController@send');

       //查看信件详情
       Route::get('watch/{id}', 'MessageController@watch');

       //写信
       Route::get('write', 'MessageController@writePage');
       Route::post('write', 'MessageController@write');
    });

    /**
     * 申请人管理模块，路由为 /manager/applicant/{action}, 命名空间 \App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'applicant'], function(){
        // 课程设置
        Route::group(['prefix' => 'course'], function(){
            //课程列表
            Route::get('/', 'ApplicantController@courseList');
            //课程详情
            Route::get('{id}/detail', 'ApplicantController@courseDetail');
            //课程编辑
            Route::get('{id}/edit', 'ApplicantController@courseEditPage');
            Route::post('{id}/edit', 'ApplicantController@courseEdit');
            //隐藏(显示)
            Route::patch('{id}/hide', 'ApplicantController@courseHide');

            Route::get('{id}', 'ApplicantController@getCourseById');
        });

        //文章设置
        Route::group(['prefix' => 'article'], function (){
            //文章列表
            Route::get('/', 'ApplicantController@articleList');
            //文章添加
            Route::get('{course_id}/add', 'ApplicantController@articleAddPage');
            Route::post('{course_id}/add', 'ApplicantController@articleAdd');
            //文章编辑
            Route::get('{id}/edit', 'ApplicantController@articleEditPage');
            Route::post('{id}/edit', 'ApplicantController@articleEdit');
            //隐藏(显示)
            Route::patch('{id}/hide', 'ApplicantController@articleHide');
            //删除
            Route::post('{id}/delete', 'ApplicantController@articleDelete');

            Route::get('{id}', 'ApplicantController@getArticleById');
        });

        //题目管理
        Route::group(['prefix' => 'exercise'], function (){
            //题目列表
            Route::get('/', 'ApplicantController@exerciseList');
            //题目添加
            Route::get('{course_id}/add', 'ApplicantController@exerciseAddPage');
            Route::post('{course_id}/add', 'ApplicantController@exerciseAdd');
            //题目编辑
            Route::get('{id}/edit', 'ApplicantController@exerciseEditPage');
            Route::post('{id}/edit', 'ApplicantController@exerciseEdit');
            //隐藏(显示)
            Route::patch('{id}/hide', 'ApplicantController@exerciseHide');
            //删除
            Route::post('{id}/delete', 'ApplicantController@exerciseDelete');

            Route::get('{id}', 'ApplicantController@getExerciseById');
        });

        // 考试控制
        Route::group(['prefix' => 'exam'], function(){
            //考试列表
            Route::get('/', 'ApplicantController@examList');
            //考试详情
            Route::get('{id}/detail', 'ApplicantController@examDetail');
            //考试修改
            Route::get('{id}/edit', 'ApplicantController@examEditPage');
            Route::post('{id}/edit', 'ApplicantController@examEdit');
            //添加考试
            Route::get('add', 'ApplicantController@examAddPage');
            Route::post('add', 'ApplicantController@examAdd');
            //删除考试
            Route::post('{id}/delete', 'ApplicantController@examDelete');
            //附件下载
            Route::get('{id}/download', 'ApplicantController@examDownload');

            Route::get('{id}', 'ApplicantController@getExamById');
        });

        //报名情况
        Route::group(['prefix' => 'sign'], function (){
            //报名列表
            Route::get('/list', 'ApplicantController@signList');
            //退考人员
            Route::get('/exit', 'ApplicantController@signExit');
            //补考报名
            Route::get('/makeup', 'ApplicantController@signMakeupPage');
            Route::post('/makeup', 'ApplicantController@signMakeup');
        });

        //成绩录入
        Route::group(['prefix' => 'grade-input'], function (){
            Route::get('/', 'ApplicantController@gradeInputPage');
            Route::post('/', 'ApplicantController@gradeInput');
        });

        //结业成绩查询
        Route::group(['prefix' => 'grade-list'], function (){
            Route::get('/', 'ApplicantController@gradeListPage');
            Route::post('/', 'ApplicantController@gradeList');
        });

        //证书管理
        Route::group(['prefix' => 'certificate'], function (){
            //证书列表
            Route::get('list', 'ApplicantController@certificateListPage');
            Route::post('list', 'ApplicantController@certificateList');
            //证书发放
            Route::get('grant', 'ApplicantController@certificateGrantPage');
            Route::post('grant', 'ApplicantController@certificateGrant');
            Route::post('grant-result', 'ApplicantController@certificateGrantResult');
            //证书补办
            Route::get('last-grant', 'ApplicantController@certificateLastGrant');
            Route::get('last-grant/{id}/detail', 'ApplicantController@certificateLastGrantDetailPage');
            Route::post('last-grant/{id}/detail', 'ApplicantController@certificateLastGrantDetail');
            Route::post('last-grant/{id}/reject', 'ApplicantController@certificateLastGrantReject');
            
            Route::get('last-grant/{id}', 'ApplicantController@getCertificateById');
        });

        // 申诉管理
        Route::group(['prefix' => 'complain'], function(){
            //证书列表
            Route::get('/', 'ApplicantController@complainList');
            //申诉回复
            Route::get('{id}/detail', 'ApplicantController@complainDetailPage');
            Route::get('{id}/detail_1', 'ApplicantController@complainDetailPage_1');
            Route::post('{id}/detail', 'ApplicantController@complainDetail');
            Route::get('{id}', 'ApplicantController@getComplainById');
        });

        // 作弊+违纪
        Route::group(['prefix' => 'cheat'], function (){
            Route::get('/', 'ApplicantController@cheatListPage');
            Route::post('/', 'ApplicantController@cheatList');
        });

        // 被锁人员名单
        Route::get('locked', 'ApplicantController@lockedList');
        // 解锁
        Route::post('locked/{id}/unlock', 'ApplicantController@unlock');

        // 被清人员名单
        Route::get('clear20', 'ApplicantController@clearList');
        // 解除清除
        Route::post('clear20/{id}/unclear', 'ApplicantController@unclear');
    });

    /**
    * 院级积极分子管理模块，路由为 /manager/academy/{action}, 命名空间 \App\Http\Controllers\Manager
    */
    Route::group(['prefix' => 'academy'], function(){
        // 总培训控制
        Route::group(['prefix' => 'train-list'], function(){
            //总培训列表
            Route::get('/', 'AcademyController@trainList');
            //关闭总培训
            Route::patch('{id}/close', 'AcademyController@trainClose');
            //添加总培训
            Route::get('add', 'AcademyController@trainAddPage');
            Route::post('add', 'AcademyController@trainAdd');
        });

        // 子培训控制
        Route::group(['prefix' => 'test-list'], function (){
            //子培训列表
            Route::get('/', 'AcademyController@testList');
            //子培训详情
            Route::get('{id}/detail', 'AcademyController@testDetail');
            //添加子培训
            Route::get('add', 'AcademyController@testAddPage');
            Route::post('add', 'AcademyController@testAdd');
            //编辑子培训
            Route::get('{id}/edit', 'AcademyController@testEditPage');
            Route::post('{id}/edit', 'AcademyController@testEdit');
            //删除
            Route::patch('{id}/delete', 'AcademyController@testDelete');
            //状态改变
            Route::patch('{id}/change/{status}', 'AcademyController@testChange');

            Route::get('{id}', 'AcademyController@getTestById');
        });

        // 报名情况
        Route::group(['prefix' => 'sign'], function (){
            //报名列表
            Route::get('/', 'AcademyController@signList');
            //院级补报名
            Route::get('makeup', 'AcademyController@signMakeupPage');
            Route::post('makeup', 'AcademyController@signMakeup');
        });

        // 成绩录入
        Route::group(['prefix' => 'grade-input'], function (){
            Route::get('/', 'AcademyController@gradeInputPage');
            Route::post('/', 'AcademyController@gradeInput');
        });

        // 结业成绩
        Route::group(['prefix' => 'grade-list'], function (){
            Route::get('/', 'AcademyController@gradeListPage');
            Route::post('/', 'AcademyController@gradeList');
        });

        // 证书管理
        Route::group(['prefix' => 'certificate'], function (){
            //发放详情
            Route::get('list', 'AcademyController@certificateListPage');
            Route::post('list', 'AcademyController@certificateList');
            //证书发放
            Route::get('grant', 'AcademyController@certificateGrantPage');
            Route::post('grant', 'AcademyController@certificateGrant');
            Route::post('grant-result', 'AcademyController@certificateGrantResult');
            //证书补办
            Route::get('last-grant', 'AcademyController@certificateLastGrant');
            Route::get('last-grant/{id}/detail', 'AcademyController@certificateLastGrantDetailPage');
            Route::post('last-grant/{id}/detail', 'AcademyController@certificateLastGrantDetail');
            Route::post('last-grant/{id}/reject', 'AcademyController@certificateLastGrantReject');

            Route::get('last-grant/{id}', 'AcademyController@getCertificateById');
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

            Route::get('{notice_id}', 'NoticeController@getNoticeById');

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

});