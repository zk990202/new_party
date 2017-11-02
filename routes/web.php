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

/**
 * 管理员后台模块，路由为 /manager/{module}, 命名空间 \App\Http\Controllers\Manager
 */
Route::group(['namespace' => 'Manager', 'prefix' => 'manager'], function (){

    /**
     * 数据统计模块，路由为 /manager/statistics/{action}, 命名空间 \App\Http\Controllers\Manager\
     */
    Route::group(['prefix' => 'statistics'], function(){

        // 登陆统计
        Route::get('loginPage', ['as' => 'manager-statistics-login-page', 'uses' => 'StatisticsController@loginPage']);
        Route::get('login', ['as' => 'manager-statistics-login', 'uses' => 'StatisticsController@login']);

        // 20课统计
        Route::get('twentyLessonsPage', ['as' => 'manager-statistics-twenty-lessons-page', 'uses' => 'StatisticsController@twentyLessonsPage']);
        Route::get('twentyLessons', ['as' => 'manager-statistics-twenty-lessons', 'uses' => 'StatisticsController@twentyLessons']);

        //申请人结业统计
        Route::get('applicantTestListPage', ['as' => 'manager-statistics-applicant-test-list-page', 'uses' => 'StatisticsController@applicantTestListPage']);
        Route::get('applicantTestList', ['as' => 'manager-statistics-applicant-test-list', 'uses' => 'StatisticsController@applicantTestList']);

        //积极分子结业统计
        Route::get('academyTestListPage', ['as' => 'manager-statistics-academy-test-list-page', 'uses' => 'StatisticsController@academyTestListPage']);
        Route::get('academyTestList/{type?}', ['as' => 'manager-statistics-academy-test-list', 'uses' => 'StatisticsController@academyTestList']);

        //支部统计(类型为1/2/3)
        Route::get('partyBranchPage/1', ['as' => 'manager-statistics-party-branch-page-1', 'uses' => 'StatisticsController@partyBranchPage1']);
        Route::get('partyBranch/1', ['as' => 'manager-statistics-party-branch-1', 'uses' => 'StatisticsController@partyBranch1']);
        Route::get('partyBranchPage/2', ['as' => 'manager-statistics-party-branch-page-2', 'uses' => 'StatisticsController@partyBranchPage2']);
        Route::get('partyBranch/2', ['as' => 'manager-statistics-party-branch-2', 'uses' => 'StatisticsController@partyBranch2']);
        Route::get('partyBranchPage/3', ['as' => 'manager-statistics-party-branch-page-3', 'uses' => 'StatisticsController@partyBranchPage3']);
        Route::get('partyBranch/3', ['as' => 'manager-statistics-party-branch-3', 'uses' => 'StatisticsController@partyBranch3']);

    });

    /**
     * 通知公告管理模块，路由为 /manager/notice/{action},命名空间 \App\Http\Controllers\Manager\
     */
    Route::group(['prefix' => 'notice'], function(){

        /**
         * 党校管理子模块，路由为 /manager/notice/party-school/{action}, 命名空间 \App\Http\Controllers\Manager\
         */
        Route::group(['prefix' => 'party-school'], function(){
            //列表--申请人党校
            Route::get('list/70', ['as' => 'manager-notice-party-school-list-applicant', 'uses' => 'NoticeController@partySchool']);
            //列表--院级积极分子党校
            Route::get('list/71', ['as' => 'manager-notice-party-school-list-academy', 'uses' => 'NoticeController@partySchool']);
            //列表--预备党员党校
            Route::get('list/72', ['as' => 'manager-notice-party-school-list-probationary', 'uses' => 'NoticeController@partySchool']);
            //列表--党支部书记党校
            Route::get('list/73', ['as' => 'manager-notice-party-school-list-secretary', 'uses' => 'NoticeController@partySchool']);

            //隐藏(显示)
            Route::patch('{notice_id}/hide', ['as' => 'manager-notice-party-school-hide', 'uses' =>'NoticeController@hide']);
            //置顶(取消置顶)
            Route::patch('{notice_id}/topUp', ['as' => 'manager-notice-party-school-top-up', 'uses' => 'NoticeController@topUp']);

            //编辑
            Route::get('{notice_id}/edit', ['as' => 'manager-notice-party-school-edit-page', 'uses' => 'NoticeController@editPage']);
            Route::post('{notice_id}/edit', ['as' => 'manager-notice-party-school-edit', 'uses' => 'NoticeController@edit']);

            Route::get('{notice_id}', ['as' => 'manager-notice-party-school', 'uses' => 'NoticeController@getNoticeById']);

        });
        /**
         * 添加公告子模块，路由为 /manager/notice/add/{action}, 命名空间 \App\Http\Controllers\Manager\
         */
        Route::group(['prefix' => 'add'], function(){
            Route::get('/', ['as' => 'manager-notice-add-page', 'uses' => 'NoticeController@addPage']);
            Route::post('/', ['as' => 'manager-notice-add', 'uses' => 'NoticeController@add']);
        });

        /**
         * 活动通知子模块，路由为 /manager/notice/activity/{action}, 命名空间 \App\Http\Controllers\Manager\
         */
        Route::group(['prefix' => 'activity'], function (){
            Route::get('list', ['as' => 'manager-notice-activity-list', 'uses' => 'NoticeController@activity']);
            Route::patch('{activity_id}/hide', ['as' => 'manager-notice-activity-hide', 'uses' => 'NoticeController@hide']);
            Route::patch('{activity_id}/topUp', ['as' => 'manager-notice-activity-top-up', 'uses' => 'NoticeController@topUp']);

            Route::get('{activity_id}/edit', ['as' => 'manager-notice-activity-edit-page', 'uses' => 'NoticeController@activityEditPage']);
            Route::post('{activity_id}/edit', ['as' => 'manager-notice-activity-edit', 'uses' => 'NoticeController@activityEdit']);

            Route::get('add', ['as' => 'manager-notice-activity-add-page', 'uses' => 'NoticeController@activityAddPage']);
            Route::post('add', ['as' => 'manager-notice-activity-add', 'uses' => 'NoticeController@activityAdd']);

            Route::get('{notice_id}', ['as' => 'manager-notice-activity', 'uses' => 'NoticeController@getNoticeById']);

        });
    });

    /**
     * 党建专项模块， 路由为 /manager/party-build/{action}, 命名空间 \App\Http\Controllers\Manager\
     */
    Route::group(['prefix' => 'party-build'], function (){
        //党建专项新闻列表
        Route::get('list', ['as' => 'manager-party-build-list', 'uses' => 'PartyBuildController@lists']);

        //隐藏(显示)、置顶(取消置顶)新闻
        Route::patch('{id}/hide', ['as' => 'manager-party-build-hide', 'uses' => 'PartyBuildController@hide']);
        Route::patch('{id}/topUp',['as' => 'manager-party-build-top-up', 'uses' =>  'PartyBuildController@topUp']);

        //编辑新闻
        Route::get('{id}/edit', ['as' => 'manager-party-build-edit-page', 'uses' => 'PartyBuildController@editPage']);
        Route::post('{id}/edit', ['as' => 'manager-party-build-edit', 'uses' => 'PartyBuildController@edit']);

        //添加新闻
        Route::get('add', ['as' => 'manager-party-build-add-page', 'uses' => 'PartyBuildController@addPage']);
        Route::post('add', ['as' => 'manager-party-build-add', 'uses' => 'PartyBuildController@add']);

        Route::get('{id}', ['as' => 'manager-party-build', 'uses' => 'PartyBuildController@getNewsById']);
    });

    /**
     * 学习小组模块， 路由为 /manager/study-group/{action}, 命名空间 App\Http\Controllers\Manager\
     */
    Route::group(['prefix' => 'study-group'], function (){
        //新闻列表
        Route::get('list', ['as' => 'manager-study-group-list', 'uses' => 'StudyGroupController@lists']);

        //隐藏(显示)、置顶(取消置顶)新闻
        Route::patch('{id}/hide', ['as' => 'manager-study-group-hide', 'uses' => 'StudyGroupController@hide']);
        Route::patch('{id}/topUp', ['as' => 'manager-study-group-top-up', 'uses' => 'StudyGroupController@topUp']);

        //编辑新闻
        Route::get('{id}/edit', ['as' => 'manager-study-group-edit-page', 'uses' => 'StudyGroupController@editPage']);
        Route::post('{id}/edit', ['as' => 'manager-study-group-edit', 'uses' => 'StudyGroupController@edit']);

        //添加新闻
        Route::get('add', ['as' => 'manager-study-group-add-page', 'uses' => 'StudyGroupController@addPage']);
        Route::post('add', ['as' => 'manager-study-group-add', 'uses' => 'StudyGroupController@add']);

        Route::get('{id}', ['as' => 'manager-study-group', 'uses' => 'StudyGroupController@getNewsById']);
    });

    /**
     * 党校培训模块， 路由为 /manager/party-school/{action}, 命名空间 App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'party-school'], function (){
        //新闻列表
        Route::get('list', ['as' => 'manager-party-school-list', 'uses' => 'PartySchoolController@lists']);

        //隐藏(显示)、置顶(取消置顶)新闻
        Route::patch('{id}/hide', ['as' => 'manager-party-school-hide', 'uses' => 'PartySchoolController@hide']);
        Route::patch('{id}/topUp', ['as' => 'manager-party-school-top-up', 'uses' => 'PartySchoolController@topUp']);

        //编辑新闻
        Route::get('{id}/edit', ['as' => 'manager-party-school-edit-page', 'uses' => 'PartySchoolController@editPage']);
        Route::post('{id}/edit', ['as' => 'manager-party-school-edit', 'uses' => 'PartySchoolController@edit']);

        //添加新闻
        Route::get('add', ['as' => 'manager-party-school-add-page', 'uses' => 'PartySchoolController@addPage']);
        Route::post('add', ['as' => 'manager-party-school-add', 'uses' => 'PartySchoolController@add']);

        Route::get('{id}', ['as' => 'manager-party-school', 'uses' => 'PartySchoolController@getNewsById']);
    });

    /**
     * 重要文件模块， 路由为 /manager/important-files/{action}, 命名空间 App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'important-files'], function (){
        //新闻列表
        Route::get('list', ['as' => 'manager-important-files-list', 'uses' => 'ImportantFilesController@lists']);

        //隐藏(显示)
        Route::patch('{id}/hide', ['as' => 'manager-important-files-hide', 'uses' => 'ImportantFilesController@hide']);

        //编辑新闻
        Route::get('{id}/edit', ['as' => 'manager-important-files-edit-page', 'uses' => 'ImportantFilesController@editPage']);
        Route::post('{id}/edit', ['as' => 'manager-important-files-edit', 'uses' => 'ImportantFilesController@edit']);

        //添加新闻
        Route::get('add', ['as' => 'manager-important-files-add-page', 'uses' => 'ImportantFilesController@addPage']);
        Route::post('add', ['as' => 'manager-important-files-add', 'uses' => 'ImportantFilesController@add']);

        Route::get('{id}', ['as' => 'manager-important-files', 'uses' => 'ImportantFilesController@getFilesById']);
    });

    /**
     * 理论学习模块， 路由为 /manger/theory-study/{action}, 命名空间 App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'theory-study'], function (){
        //内容列表
        Route::get('list', ['as' => 'manager-theory-study-list', 'uses' => 'TheoryStudyController@lists']);

        //隐藏(显示)
        Route::patch('{id}/hide', ['as' => 'manager-theory-study-hide', 'uses' => 'TheoryStudyController@hide']);

        //编辑
        Route::group(['prefix' => 'edit'], function (){
            //视频编辑
            Route::get('video/{id}', ['as' => 'manager-theory-study-edit-video-page', 'uses' => 'TheoryStudyController@editVideoPage']);
            Route::post('video/{id}', ['as' => 'manager-theory-study-edit-video', 'uses' => 'TheoryStudyController@editVideo']);

            //文章编辑
            Route::get('article/{id}', ['as' => 'manager-theory-study-edit-article-page', 'uses' => 'TheoryStudyController@editArticlePage']);
            Route::post('article/{id}', ['as' => 'manager-theory-study-edit-article', 'uses' => 'TheoryStudyController@editArticle']);

            //电子书编辑
            Route::get('eBook/{id}', ['as' => 'manager-theory-study-edit-eBook-page', 'uses' => 'TheoryStudyController@editEBookPage']);
            Route::post('eBook/{id}', ['as' => 'manager-theory-study-edit-eBook', 'uses' => 'TheoryStudyController@editEBook']);
        });

        //添加
        Route::group(['prefix' => 'add'], function (){
            //视频添加
            Route::get('video', ['as' => 'manager-theory-study-add-video-page', 'uses' => 'TheoryStudyController@addVideoPage']);
            Route::post('video', ['as' => 'manager-theory-study-add-video', 'uses' => 'TheoryStudyController@addVideo']);

            //文章添加
            Route::get('article', ['as' => 'manager-theory-study-add-article-page', 'uses' => 'TheoryStudyController@addArticlePage']);
            Route::post('article', ['as' => 'manager-theory-study-add-article', 'uses' => 'TheoryStudyController@addArticle']);

            //电子书添加
            Route::get('eBook', ['as' => 'manager-theory-study-eBook-page', 'uses' => 'TheoryStudyController@addEBookPage']);
            Route::post('eBook', ['as' => 'manager-theory-study-eBook', 'uses' => 'TheoryStudyController@addEBook']);
        });

        Route::get('{id}', ['as' => 'manager-theory-study', 'uses' => 'TheoryStudyController@getContentsById']);

    });

    /**
     * 消息管理模块， 路由为 /manager/message/{action}, 命名空间 App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'message'], function (){
        //收信箱
        Route::get('receive', ['as' => 'manager-message-receive', 'uses' => 'MessageController@receive']);

        //发信箱
        Route::get('send', ['as' => 'manager-message-send', 'uses' => 'MessageController@send']);

        //查看信件详情
        Route::get('watch/{id}', ['as' => 'manager-message-watch', 'uses' => 'MessageController@watch']);

        //写信
        Route::get('write', ['as' => 'manager-message-write-page', 'uses' => 'MessageController@writePage']);
        Route::post('write', ['as' => 'manager-message-write', 'uses' => 'MessageController@write']);
    });

    /**
     * 申请人管理模块，路由为 /manager/applicant/{action}, 命名空间 \App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'applicant'], function(){
        // 课程设置
        Route::group(['prefix' => 'course'], function(){
            //课程列表
            Route::get('/', ['as' => 'manager-applicant-course-list', 'uses' => 'ApplicantController@courseList']);
            //课程详情
            Route::get('{id}/detail', ['as' => 'manager-applicant-course-detail', 'uses' => 'ApplicantController@courseDetail']);
            //课程编辑
            Route::get('{id}/edit', ['as' => 'manager-applicant-course-edit-page', 'uses' => 'ApplicantController@courseEditPage']);
            Route::post('{id}/edit', ['as' => 'manager-applicant-course-edit', 'uses' => 'ApplicantController@courseEdit']);
            //隐藏(显示)
            Route::patch('{id}/hide', ['as' => 'manager-applicant-course-hide', 'uses' => 'ApplicantController@courseHide']);

            Route::get('{id}', ['as' => 'manager-applicant-course', 'uses' => 'ApplicantController@getCourseById']);
        });

        //文章设置
        Route::group(['prefix' => 'article'], function (){
            //文章列表
            Route::get('/', ['as' => 'manager-applicant-article-list', 'uses' => 'ApplicantController@articleList']);
            //文章添加
            Route::get('{course_id}/add', ['as' => 'manager-applicant-article-add-page', 'uses' => 'ApplicantController@articleAddPage']);
            Route::post('{course_id}/add', ['as' => 'manager-applicant-article-add', 'uses' => 'ApplicantController@articleAdd']);
            //文章编辑
            Route::get('{id}/edit', ['as' => 'manager-applicant-article-edit-page', 'uses' => 'ApplicantController@articleEditPage']);
            Route::post('{id}/edit', ['as' => 'manager-applicant-article-edit', 'uses' => 'ApplicantController@articleEdit']);
            //隐藏(显示)
            Route::patch('{id}/hide', ['as' => 'manager-applicant-article-hide', 'uses' => 'ApplicantController@articleHide']);
            //删除
            Route::post('{id}/delete', ['as' => 'manager-applicant-article-delete', 'uses' => 'ApplicantController@articleDelete']);

            Route::get('{id}', ['as' => 'manager-applicant-article', 'uses' => 'ApplicantController@getArticleById']);
        });

        //题目管理
        Route::group(['prefix' => 'exercise'], function (){
            //题目列表
            Route::get('/', ['as' => 'manager-applicant-exercise-list', 'uses' => 'ApplicantController@exerciseList']);
            //题目添加
            Route::get('{course_id}/add', ['as' => 'manager-applicant-exercise-add-page', 'uses' => 'ApplicantController@exerciseAddPage']);
            Route::post('{course_id}/add', ['as' => 'manager-applicant-exercise-add', 'uses' => 'ApplicantController@exerciseAdd']);
            //题目编辑
            Route::get('{id}/edit', ['as' => 'manager-applicant-exercise-edit-page', 'uses' => 'ApplicantController@exerciseEditPage']);
            Route::post('{id}/edit', ['as' => 'manager-applicant-exercise-edit', 'uses' => 'ApplicantController@exerciseEdit']);
            //隐藏(显示)
            Route::patch('{id}/hide', ['as' => 'manager-applicant-exercise-hide', 'uses' => 'ApplicantController@exerciseHide']);
            //删除
            Route::post('{id}/delete', ['as' => 'manager-applicant-exercise-delete', 'uses' => 'ApplicantController@exerciseDelete']);

            Route::get('{id}', ['as' => 'manager-applicant-exercise', 'uses' => 'ApplicantController@getExerciseById']);
        });

        // 考试控制
        Route::group(['prefix' => 'exam'], function(){
            //考试列表
            Route::get('/', ['as' => 'manager-applicant-exam-list', 'uses' => 'ApplicantController@examList']);
            //考试详情
            Route::get('{id}/detail', ['as' => 'manager-applicant-exam-detail', 'uses' => 'ApplicantController@examDetail']);
            //考试修改
            Route::get('{id}/edit', ['as' => 'manager-applicant-exam-edit-page', 'uses' => 'ApplicantController@examEditPage']);
            Route::post('{id}/edit', ['as' => 'manager-applicant-exam-edit', 'uses' => 'ApplicantController@examEdit']);
            //添加考试
            Route::get('add', ['as' => 'manager-applicant-exam-add-page', 'uses' => 'ApplicantController@examAddPage']);
            Route::post('add', ['as' => 'manager-applicant-exam-add', 'uses' => 'ApplicantController@examAdd']);
            //删除考试
            Route::post('{id}/delete', ['as' => 'manager-applicant-exam-delete', 'uses' => 'ApplicantController@examDelete']);
            //附件下载
            Route::get('{id}/download', ['as' => 'manager-applicant-exam-download', 'uses' => 'ApplicantController@examDownload']);

            Route::get('{id}', ['as' => 'manager-applicant-exam-list', 'uses' => 'ApplicantController@getExamById']);
        });

        //报名情况
        Route::group(['prefix' => 'sign'], function (){
            //报名列表
            Route::get('/list', ['as' => 'manager-applicant-sign-list', 'uses' => 'ApplicantController@signList']);
            //退考人员
            Route::get('/exit', ['as' => 'manager-applicant-sign-exit', 'uses' => 'ApplicantController@signExit']);
            //补考报名
            Route::get('/makeup', ['as' => 'manager-applicant-sign-makeup-page', 'uses' => 'ApplicantController@signMakeupPage']);
            Route::post('/makeup', ['as' => 'manager-applicant-sign-makeup', 'uses' => 'ApplicantController@signMakeup']);
        });

        //成绩录入
        Route::group(['prefix' => 'grade-input'], function (){
            Route::get('/', ['as' => 'manager-applicant-grade-input-page', 'uses' => 'ApplicantController@gradeInputPage']);
            Route::post('/', ['as' => 'manager-applicant-grade-input', 'uses' => 'ApplicantController@gradeInput']);
        });

        //结业成绩查询
        Route::group(['prefix' => 'grade-list'], function (){
            Route::get('/', ['as' => 'manager-applicant-grade-list-page', 'uses' => 'ApplicantController@gradeListPage']);
            Route::post('/', ['as' => 'manager-applicant-grade-list', 'uses' => 'ApplicantController@gradeList']);
        });

        //证书管理
        Route::group(['prefix' => 'certificate'], function (){
            //证书列表
            Route::get('list', ['as' => 'manager-applicant-certificate-list-page', 'uses' => 'ApplicantController@certificateListPage']);
            Route::post('list', ['as' => 'manager-applicant-certificate-list', 'uses' => 'ApplicantController@certificateList']);
            //证书发放
            Route::get('grant', ['as' => 'manager-applicant-certificate-grant-page', 'uses' => 'ApplicantController@certificateGrantPage']);
            Route::post('grant', ['as' => 'manager-applicant-certificate-grant', 'uses' => 'ApplicantController@certificateGrant']);
            Route::post('grant-result', ['as' => 'manager-applicant-certificate-grant-result', 'uses' => 'ApplicantController@certificateGrantResult']);
            //证书补办
            Route::get('last-grant', ['as' => 'manager-applicant-certificate-last-grant', 'uses' => 'ApplicantController@certificateLastGrant']);
            Route::get('last-grant/{id}/detail', ['as' => 'manager-applicant-certificate-last-grant-detail-page', 'uses' => 'ApplicantController@certificateLastGrantDetailPage']);
            Route::post('last-grant/{id}/detail', ['as' => 'manager-applicant-certificate-last-grant-detail', 'uses' => 'ApplicantController@certificateLastGrantDetail']);
            Route::post('last-grant/{id}/reject', ['as' => 'manager-applicant-certificate-last-grant-reject', 'uses' => 'ApplicantController@certificateLastGrantReject']);

            Route::get('last-grant/{id}', ['as' => 'manager-applicant-certificate-last-grant', 'uses' => 'ApplicantController@getCertificateById']);
        });

        // 申诉管理
        Route::group(['prefix' => 'complain'], function(){
            //证书列表
            Route::get('/', ['as' => 'manager-applicant-complain-list', 'uses' => 'ApplicantController@complainList']);
            //申诉回复
            //展示申诉还未回复的页面,含编辑器
            Route::get('{id}/detail', ['as' => 'manager-applicant-complain-detail-page', 'uses' => 'ApplicantController@complainDetailPage']);
            //展示申诉已回复的页面
            Route::get('{id}/detail_1', ['as' => 'manager-applicant-complain-detail-1-page', 'uses' => 'ApplicantController@complainDetailPage_1']);
            Route::post('{id}/detail', ['as' => 'manager-applicant-complain-detail', 'uses' => 'ApplicantController@complainDetail']);
            Route::get('{id}', ['as' => 'manager-applicant-complain', 'uses' => 'ApplicantController@getComplainById']);
            /*
             * 新党建因为部分逻辑修改，可能会导致部分已回复的申诉显示为未回复，只需再提交一次即可解决
             * 新提交的回复内容不会覆盖原来回复的内容
             * 最终显示的回复内容仍然是之前所回复的
             */
        });

        // 作弊+违纪
        Route::group(['prefix' => 'cheat'], function (){
            Route::get('/', ['as' => 'manager-applicant-cheat-page', 'uses' => 'ApplicantController@cheatListPage']);
            Route::post('/', ['as' => 'manager-applicant-cheat', 'uses' => 'ApplicantController@cheatList']);
        });

        // 被锁人员名单
        Route::get('locked', ['as' => 'manager-applicant-locked', 'uses' => 'ApplicantController@lockedList']);
        // 解锁
        Route::post('locked/{id}/unlock', ['as' => 'manager-applicant-locked-unlock', 'uses' => 'ApplicantController@unlock']);

        // 被清人员名单
        Route::get('clear20', ['as' => 'manager-applicant-clear20-page', 'uses' => 'ApplicantController@clearList']);
        // 解除清除
        Route::post('clear20/{id}/unclear', ['as' => 'manager-applicant-clear20', 'uses' => 'ApplicantController@unclear']);
    });

    /**
     * 院级积极分子管理模块，路由为 /manager/academy/{action}, 命名空间 \App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'academy'], function(){
        // 总培训控制
        Route::group(['prefix' => 'train-list'], function(){
            //总培训列表
            Route::get('/', ['as' => 'manager-academy-train-list', 'uses' => 'AcademyController@trainList']);
            //关闭总培训
            Route::patch('{id}/close', ['as' => 'manager-academy-train-list-close', 'uses' => 'AcademyController@trainClose']);
            //添加总培训
            Route::get('add', ['as' => 'manager-academy-train-list-add-page', 'uses' => 'AcademyController@trainAddPage']);
            Route::post('add', ['as' => 'manager-academy-train-list-add', 'uses' => 'AcademyController@trainAdd']);
        });

        // 子培训控制
        Route::group(['prefix' => 'test-list'], function (){
            //子培训列表
            Route::get('list', ['as' => 'manager-academy-test-list', 'uses' => 'AcademyController@testList']);
            //子培训详情
            Route::get('{id}/detail', ['as' => 'manager-academy-test-list-detail', 'uses' => 'AcademyController@testDetail']);
            //添加子培训
            Route::get('add', ['as' => 'manager-academy-test-list-add-page', 'uses' => 'AcademyController@testAddPage']);
            Route::post('add', ['as' => 'manager-academy-test-list-add', 'uses' => 'AcademyController@testAdd']);
            //编辑子培训
            Route::get('{id}/edit', ['as' => 'manager-academy-test-list-edit-page', 'uses' => 'AcademyController@testEditPage']);
            Route::post('{id}/edit', ['as' => 'manager-academy-test-list-edit', 'uses' => 'AcademyController@testEdit']);
            //删除
            Route::patch('{id}/delete', ['as' => 'manager-academy-test-list-delete', 'uses' => 'AcademyController@testDelete']);
            //状态改变
            Route::patch('{id}/change/{status}', ['as' => 'manager-academy-test-list-change', 'uses' => 'AcademyController@testChange']);

            Route::get('{id}', ['as' => 'manager-academy-test-list', 'uses' => 'AcademyController@getTestById']);
        });

        // 报名情况
        Route::group(['prefix' => 'sign'], function (){
            //报名列表
            Route::get('/', ['as' => 'manager-academy-sign', 'uses' => 'AcademyController@signList']);
            //院级补报名
            Route::get('makeup', ['as' => 'manager-academy-sign-makeup-page', 'uses' => 'AcademyController@signMakeupPage']);
            Route::post('makeup', ['as' => 'manager-academy-sign-makeup', 'uses' => 'AcademyController@signMakeup']);
        });

        // 成绩录入
        Route::group(['prefix' => 'grade-input'], function (){
            Route::get('/', ['as' => 'manager-academy-grade-input-page', 'uses' => 'AcademyController@gradeInputPage']);
            Route::post('/', ['as' => 'manager-academy-grade-input', 'uses' => 'AcademyController@gradeInput']);
        });

        // 结业成绩
        Route::group(['prefix' => 'grade-list'], function (){
            Route::get('/', ['as' => 'manager-academy-grade-list-page', 'uses' => 'AcademyController@gradeListPage']);
            Route::post('/', ['as' => 'manager-academy-grade-list', 'uses' => 'AcademyController@gradeList']);
        });

        // 证书管理
        Route::group(['prefix' => 'certificate'], function (){
            //发放详情
            Route::get('list', ['as' => 'manager-academy-certificate-list-page', 'uses' => 'AcademyController@certificateListPage']);
            Route::post('list', ['as' => 'manager-academy-certificate-list', 'uses' => 'AcademyController@certificateList']);
            //证书发放
            Route::get('grant', ['as' => 'manager-academy-certificate-grant-page', 'uses' => 'AcademyController@certificateGrantPage']);
            Route::post('grant', ['as' => 'manager-academy-certificate-grant', 'uses' => 'AcademyController@certificateGrant']);
            Route::post('grant-result', ['as' => 'manager-academy-certificate-grant-result', 'uses' => 'AcademyController@certificateGrantResult']);
            //证书补办
            Route::get('last-grant', ['as' => 'manager-academy-certificate-last-grant', 'uses' => 'AcademyController@certificateLastGrant']);
            Route::get('last-grant/{id}/detail', ['as' => 'manager-academy-certificate-last-grant-detail-page', 'uses' => 'AcademyController@certificateLastGrantDetailPage']);
            Route::post('last-grant/{id}/detail', ['as' => 'manager-academy-certificate-last-grant-detail', 'uses' => 'AcademyController@certificateLastGrantDetail']);
            Route::post('last-grant/{id}/reject', ['as' => 'manager-academy-certificate-last-grant-reject', 'uses' => 'AcademyController@certificateLastGrantReject']);

            Route::get('last-grant/{id}', ['as' => 'manager-academy-certificate-last-grant', 'uses' => 'AcademyController@getCertificateById']);
        });

        // 申诉管理
        Route::group(['prefix' => 'complain'], function(){
            //申诉列表
            Route::get('/', ['as' => 'manager-academy-complain', 'uses' => 'AcademyController@complainList']);
            //申诉回复
            //展示申诉还未回复的页面,含编辑器
            Route::get('{id}/detail', ['as' => 'manager-academy-complain-detail-page', 'uses' => 'AcademyController@complainDetailPage']);
            //展示申诉已回复的页面
            Route::get('{id}/detail_1', ['as' => 'manager-academy-complain-detail-page-1', 'uses' => 'AcademyController@complainDetailPage_1']);
            Route::post('{id}/detail', ['as' => 'manager-academy-complain-detail', 'uses' => 'AcademyController@complainDetail']);
            Route::get('{id}', ['as' => 'manager-academy-complain', 'uses' => 'AcademyController@getComplainById']);
            /*
             * 新党建因为部分逻辑修改，可能会导致部分已回复的申诉显示为未回复，只需再提交一次即可解决
             * 新提交的回复内容不会覆盖原来回复的内容
             * 最终显示的回复内容仍然是之前所回复的
             */
        });
    });

    /**
     * 预备党员管理模块，路由为 /manager/probationary/{action}, 命名空间 \App\Http\Controllers\Manager
     */
    Route::group(['prefix' => 'probationary'], function(){
        // 培训设置
        Route::group(['prefix' => 'train'], function(){
            //培训列表
            Route::get('list', ['as' => 'manager-probationary-train-list', 'uses' => 'ProbationaryController@trainList']);
            //添加培训
            Route::get('add', ['as' => 'manager-probationary-train-add-page', 'uses' => 'ProbationaryController@trainAddPage']);
            Route::post('add', ['as' => 'manager-probationary-train-add', 'uses' => 'ProbationaryController@trainAdd']);
            //培训详情
            Route::get('{id}/detail', ['as' => 'manager-probationary-train-detail', 'uses' => 'ProbationaryController@trainDetail']);
            //编辑考试
            Route::get('{id}/edit', ['as' => 'manager-probationary-train-edit-page', 'uses' => 'ProbationaryController@trainEditPage']);
            Route::post('{id}/edit', ['as' => 'manager-probationary-train-edit', 'uses' => 'ProbationaryController@trainEdit']);
            //修改状态
            Route::get('{id}/status', ['as' => 'manager-probationary-train-status', 'uses' => 'ProbationaryController@trainStatusPage']);
            Route::post('{id}/entryStatus', ['as' => 'manager-probationary-train-entry-status', 'uses' => 'ProbationaryController@trainEntryStatus']);
            Route::post('{id}/netChooseStatus', ['as' => 'manager-probationary-train-net-choose-status', 'uses' => 'ProbationaryController@trainNetChooseStatus']);
            Route::post('{id}/gradeSearchStatus', ['as' => 'manager-probationary-train-grade-search-status', 'uses' => 'ProbationaryController@trainGradeSearchStatus']);
            Route::post('{id}/endListShow', ['as' => 'manager-probationary-train-end-list-show', 'uses' => 'ProbationaryController@trainEndListShow']);
            Route::post('{id}/goodMemberShow', ['as' => 'manager-probationary-train-good-member-show', 'uses' => 'ProbationaryController@trainGoodMemberShow']);
            Route::post('{id}/isEnd', ['as' => 'manager-probationary-train-is-end', 'uses' => 'ProbationaryController@trainIsEnd']);
            //结业成绩录入
            Route::post('{id}/open', ['as' => 'manager-probationary-train-open', 'uses' => 'ProbationaryController@trainOpen']);
            Route::post('{id}/close', ['as' => 'manager-probationary-train-close', 'uses' => 'ProbationaryController@trainClose']);

            Route::get('{id}', ['as' => 'manager-probationary-train', 'uses' => 'ProbationaryController@getTrainById']);
        });

        // 课程管理
        Route::group(['prefix' => 'course'], function (){
            //课程列表
            Route::get('list', ['as' => 'manager-probationary-course-list-page', 'uses' => 'ProbationaryController@courseListPage']);
            Route::post('list', ['as' => 'manager-probationary-course-list', 'uses' => 'ProbationaryController@courseList']);
            //课程详情
            Route::get('{id}/detail/compulsory', ['as' => 'manager-probationary-course-detail-compulsory', 'uses' => 'ProbationaryController@courseCompulsoryDetail']);
            Route::get('{id}/detail/elective', ['as' => 'manager-probationary-course-detail-elective', 'uses' => 'ProbationaryController@courseElectiveDetail']);
            //编辑必修课
            Route::get('{id}/edit/compulsory', ['as' => 'manager-probationary-course-edit-compulsory-page', 'uses' => 'ProbationaryController@courseCompulsoryEditPage']);
            Route::post('{id}/edit/compulsory', ['as' => 'manager-probationary-course-edit-compulsory', 'uses' => 'ProbationaryController@courseCompulsoryEdit']);
            //编辑选修课
            Route::get('{id}/edit/elective', ['as' => 'manager-probationary-course-edit-elective-page', 'uses' => 'ProbationaryController@courseElectiveEditPage']);
            Route::post('{id}/edit/elective', ['as' => 'manager-probationary-course-edit-elective', 'uses' => 'ProbationaryController@courseElectiveEdit']);
            //删除课程
            Route::post('{id}/delete', ['as' => 'manager-probationary-course-delete', 'uses' => 'ProbationaryController@courseDelete']);
            //开启(关闭)成绩录入
            Route::post('{id}/open', ['as' => 'manager-probationary-course-open', 'uses' => 'ProbationaryController@courseOpen']);
            Route::post('{id}/close', ['as' => 'manager-probationary-course-close', 'uses' => 'ProbationaryController@courseClose']);
            //添加必修课
            Route::get('add/compulsory', ['as' => 'manager-probationary-course-add-compulsory-page', 'uses' => 'ProbationaryController@courseAddCompulsoryPage']);
            Route::post('add/compulsory', ['as' => 'manager-probationary-course-add-compulsory', 'uses' => 'ProbationaryController@courseAddCompulsory']);
            //添加选修课
            Route::get('add/elective', ['as' => 'manager-probationary-course-add-elective-page', 'uses' => 'ProbationaryController@courseAddElectivePage']);
            Route::post('add/elective', ['as' => 'manager-probationary-course-add-elective', 'uses' => 'ProbationaryController@courseAddElective']);

            Route::get('{id}', ['as' => 'manager-probationary-course', 'uses' => 'ProbationaryController@getCourseById']);
        });

        // 报名管理
        Route::group(['prefix' => 'sign'], function (){
            //报名列表
            Route::get('list', ['as' => 'manager-probationary-sign-list', 'uses' => 'ProbationaryController@signList']);
            //退出(恢复)选课
            Route::post('{id}/inCourseChoose', ['as' => 'manager-probationary-sign-in-course-choose', 'uses' => 'ProbationaryController@signInCourseChoose']);
            Route::post('{id}/exitCourseChoose', ['as' => 'manager-probationary-sign-exit-course-choose', 'uses' => 'ProbationaryController@signExitCourseChoose']);
            //删除
            Route::post('{id}/delete', ['as' => 'manager-probationary-sign-delete', 'uses' => 'ProbationaryController@signDelete']);
            //退报名名单
            Route::get('exit-list', ['as' => 'manager-probationary-sign-exit-list', 'uses' => 'ProbationaryController@signExitList']);
            //后台补报名
            Route::get('makeup-sign', ['as' => 'manager-probationary-sign-makeup-sign-page', 'uses' => 'ProbationaryController@signMakeupPage']);
            Route::post('makeup-sign', ['as' => 'manager-probationary-sign-makeup-sign', 'uses' => 'ProbationaryController@signMakeup']);
        });

        // 选课管理
        Route::group(['prefix' => 'choose-course'], function (){
            //选课列表
            Route::get('list', ['as' => 'manager-probationary-choose-course-list-page', 'uses' => 'ProbationaryController@chooseCourseListPage']);
            Route::post('list', ['as' => 'manager-probationary-choose-course-list', 'uses' => 'ProbationaryController@chooseCourseList']);
            //退出(恢复)选课
            Route::post('{id}/inCourseChoose', ['as' => 'manager-probationary-choose-course-in-course-choose', 'uses' => 'ProbationaryController@chooseCourseInCourseChoose']);
            Route::post('{id}/exitCourseChoose', ['as' => 'manager-probationary-choose-course-exit-course-choose', 'uses' => 'ProbationaryController@chooseCourseExitCourseChoose']);
            //删除
            Route::post('{id}/delete', ['as' => 'manager-probationary-choose-course-delete', 'uses' => 'ProbationaryController@chooseCourseDelete']);
            //补选课
            Route::get('makeup', ['as' => 'manager-probationary-choose-course-makeup-page', 'uses' => 'ProbationaryController@chooseCourseMakeupPage']);
            Route::post('makeup', ['as' => 'manager-probationary-choose-course-makeup', 'uses' => 'ProbationaryController@chooseCourseMakeup']);
        });

        // 课程成绩录入
        Route::group(['prefix' => 'course-gradeInput'], function (){
            //成绩录入前对课程的筛选页面
            Route::get('/', ['as' => 'manager-probationary-course-grade-input-filter-1', 'uses' => 'ProbationaryController@courseGradeInputPage1']);
            //筛选后的页面，显示成绩录入表单
            Route::post('filter', ['as' => 'manager-probationary-course-grade-input-filter', 'uses' => 'ProbationaryController@courseGradeInputPage']);
            //录入成绩的后台操作
            Route::post('/', ['as' => 'manager-probationary-course-grade-input', 'uses' => 'ProbationaryController@courseGradeInput']);
        });

        // 结业成绩
        Route::group(['prefix' => 'graduation'], function (){
            //录入
            Route::get('input', ['as' => 'manager-probationary-graduation-input-page', 'uses' => 'ProbationaryController@graduationGradeInputPage']);
            Route::post('input', ['as' => 'manager-probationary-graduation-input', 'uses' => 'ProbationaryController@graduationGradeInput']);
            //调整
            Route::get('change', ['as' => 'manager-probationary-graduation-change-page-1', 'uses' => 'ProbationaryController@graduationGradeChangePage1']);
            Route::post('change1', ['as' => 'manager-probationary-graduation-change-page', 'uses' => 'ProbationaryController@graduationGradeChangePage']);
            Route::post('change', ['as' => 'manager-probationary-graduation-change', 'uses' => 'ProbationaryController@graduationGradeChange']);
        });

        // 成绩查询
        Route::group(['prefix' => 'grade-search'], function (){
            Route::get('/', ['as' => 'manager-probationary-grade-search-page', 'uses' => 'ProbationaryController@gradeSearchPage']);
            Route::post('/', ['as' => 'manager-probationary-grade-search', 'uses' => 'ProbationaryController@gradeSearch']);
        });
        
        // 证书管理
        Route::group(['prefix' => 'certificate'], function (){
            //发放详情
            Route::get('list', ['as' => 'manager-probationary-certificate-list-page', 'uses' => 'ProbationaryController@certificateListPage']);
            Route::post('list', ['as' => 'manager-probationary-certificate-list-page', 'uses' => 'ProbationaryController@certificateList']);
            //证书发放
            Route::get('grant', ['as' => 'manager-probationary-certificate-grant-page', 'uses' => 'ProbationaryController@certificateGrantPage']);
            Route::post('grant', ['as' => 'manager-probationary-certificate-grant', 'uses' => 'ProbationaryController@certificateGrant']);
            Route::post('grant-result', ['as' => 'manager-probationary-certificate-grant-result', 'uses' => 'ProbationaryController@certificateGrantResult']);
            //证书补办
            Route::get('last-grant', ['as' => 'manager-probationary-certificate-last-grant', 'uses' => 'ProbationaryController@certificateLastGrant']);
            Route::get('last-grant/{id}/detail', ['as' => 'manager-probationary-certificate-last-grant-detail-page', 'uses' => 'ProbationaryController@certificateLastGrantDetailPage']);
            Route::post('last-grant/{id}/detail', ['as' => 'manager-probationary-certificate-last-grant-detail', 'uses' => 'ProbationaryController@certificateLastGrantDetail']);
            Route::post('last-grant/{id}/reject', ['as' => 'manager-probationary-certificate-last-grant-reject', 'uses' => 'ProbationaryController@certificateLastGrantReject']);

            Route::get('last-grant/{id}', ['as' => 'manager-probationary-certificate-last-grant', 'uses' => 'ProbationaryController@getCertificateById']);
        });

        // 申诉管理
        Route::group(['prefix' => 'complain'], function(){
            //申诉列表
            Route::get('/', ['as' => 'manager-probationary-complain', 'uses' => 'ProbationaryController@complainList']);
            //申诉回复
            //展示申诉还未回复的页面,含编辑器
            Route::get('{id}/detail', ['as' => 'manager-probationary-complain-detail-page', 'uses' => 'ProbationaryController@complainDetailPage']);
            //展示申诉已回复的页面
            Route::get('{id}/detail_1', ['as' => 'manager-probationary-complain-detail-page-1', 'uses' => 'ProbationaryController@complainDetailPage_1']);
            Route::post('{id}/detail', ['as' => 'manager-probationary-complain-detail', 'uses' => 'ProbationaryController@complainDetail']);
            Route::get('{id}', ['as' => 'manager-probationary-complain', 'uses' => 'ProbationaryController@getComplainById']);
            /*
             * 新党建因为部分逻辑修改，可能会导致部分已回复的申诉显示为未回复，只需再提交一次即可解决
             * 新提交的回复内容不会覆盖原来回复的内容
             * 最终显示的回复内容仍然是之前所回复的
             */
        });

        // 成绩查询
        Route::group(['prefix' => 'grade-search'], function (){
            Route::get('/', 'ProbationaryController@gradeSearchPage');
            Route::post('/', 'ProbationaryController@gradeSearch');
        });

    });

    /**
     * 支部管理模块，路由为 /manager/party-branch/{action}, 命名空间 \App\Http\Controllers\Manager\PartyBranch
     */
    Route::group([ 'prefix' => 'party-branch'], function(){
        // 支部列表--每个学院及支部总数
        Route::get('list', ['as' => 'manager-party-branch-list', 'uses' => 'PartyBranchController@pList']);
        // 支部列表--列出每个的所有支部
        Route::get('r-list/{id}', ['as' => 'manager-party-branch-c-list', 'uses' => 'PartyBranchController@cList']);
        // 支部管理--主页面
        Route::get('{id}/manager', ['as' => 'manager-party-branch-manager', 'uses' => 'PartyBranchController@manager']);
        // 支部管理--添加支部书记、组织委员、宣传委员
        Route::get('{id}/add-cadre/{type}', ['as' => 'manager-party-branch-add-cadre-page', 'uses' => 'PartyBranchController@addCadrePage']);
        Route::post('{id}/add-cadre/{type}', ['as' => 'manager-party-branch-add-cadre', 'uses' => 'PartyBranchController@addCadre']);
        // 支部管理--删除支部书记、组织委员、宣传委员
        Route::patch('{id}/delete-cadre/{type}', ['as' => 'manager-party-branch-delete-cadre', 'uses' => 'PartyBranchController@deleteCadre']);
        // 支部管理--成员列表
        Route::get('{id}/member-list', ['as' => 'manager-party-branch-member-list', 'uses' => 'PartyBranchController@memberList']);
        // 支部管理--成员添加
        Route::get('{id}/member-add', ['as' => 'manager-party-branch-member-add-page', 'uses' => 'PartyBranchController@memberAddPage']);
        Route::post('{id}/member-add', ['as' => 'manager-party-branch-member-add', 'uses' => 'PartyBranchController@memberAdd']);
        // 支部管理--成员添加-混合党支部类型
        Route::get('{id}/member-add-mix-preview', ['as' => 'manager-party-branch-member-add-mix-preview-page', 'uses' => 'PartyBranchController@memberAddMixPreviewPage']);
        Route::get('{id}/member-add-mix', ['as' => 'manager-party-branch-member-add-mix-page', 'uses' => 'PartyBranchController@memberAddMixPage']);
        Route::post('{id}/member-add-mix', ['as' => 'manager-party-branch-member-add-mix', 'uses' => 'PartyBranchController@memberAddMix']);
        // 支部管理--成员删除
        Route::get('{id}/member-delete', ['as' => 'manager-party-branch-member-delete-page', 'uses' => 'PartyBranchController@memberDeletePage']);
        Route::post('{id}/member-delete', ['as' => 'manager-party-branch-member-delete', 'uses' => 'PartyBranchController@memberDelete']);
        // 编辑
        Route::get('{id}/edit', ['as' => 'manager-party-branch-edit-page', 'uses' => 'PartyBranchController@editPage']);
        Route::post('{id}/edit', ['as' => 'manager-party-branch-edit', 'uses' => 'PartyBranchController@edit']);
        // 删除支部
        Route::post('{id}/delete', ['as' => 'manager-party-branch-delete', 'uses' => 'PartyBranchController@deleteBranch']);
    });

    /**
     * 文件上传下载控制
     */
    Route::group(['prefix' => 'file'], function(){
        Route::post('/', ['as' => 'file', 'uses' => 'FileController@upload']);
    });

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
        Route::get('logout', ['as' => 'manager-auth-logout', 'uses' => 'LoginController@logout']);
    });

});

Route::group(['prefix' => 'manager/auth', 'namespace' => 'Manager\Auth'], function(){
    Route::get('login', 'LoginController@loginPage')->name('login');
    Route::post('login', 'LoginController@login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function(){

});
