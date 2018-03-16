<?php

use App\Http\Service\AdminMenuService;
use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    /**
     * 数据统计模块，路由为 /admin/statistics/{action}, 命名空间 \App\Http\Controllers\Manager\
     */
    $router->group(['prefix' => 'statistics'], function(Router $router){

        // 登陆统计
        $router->get('loginPage', ['as' => 'admin-statistics-login-page', 'uses' => 'StatisticsController@loginPage']);
        $router->get('login', ['as' => 'admin-statistics-login', 'uses' => 'StatisticsController@login']);

        // 20课统计
        $router->get('twentyLessonsPage', ['as' => 'admin-statistics-twenty-lessons-page', 'uses' => 'StatisticsController@twentyLessonsPage']);
        $router->get('twentyLessons', ['as' => 'admin-statistics-twenty-lessons', 'uses' => 'StatisticsController@twentyLessons']);

        //申请人结业统计
        $router->get('applicantTestListPage', ['as' => 'admin-statistics-applicant-test-list-page', 'uses' => 'StatisticsController@applicantTestListPage']);
        $router->get('applicantTestList', ['as' => 'admin-statistics-applicant-test-list', 'uses' => 'StatisticsController@applicantTestList']);

        //积极分子结业统计
        $router->get('academyTestListPage', ['as' => 'admin-statistics-academy-test-list-page', 'uses' => 'StatisticsController@academyTestListPage']);
        $router->get('academyTestList/{type?}', ['as' => 'admin-statistics-academy-test-list', 'uses' => 'StatisticsController@academyTestList']);

        //支部统计(类型为1/2/3)
        $router->get('partyBranchPage/1', ['as' => 'admin-statistics-party-branch-page-1', 'uses' => 'StatisticsController@partyBranchPage1']);
        $router->get('partyBranch/1', ['as' => 'admin-statistics-party-branch-1', 'uses' => 'StatisticsController@partyBranch1']);
        $router->get('partyBranchPage/2', ['as' => 'admin-statistics-party-branch-page-2', 'uses' => 'StatisticsController@partyBranchPage2']);
        $router->get('partyBranch/2', ['as' => 'admin-statistics-party-branch-2', 'uses' => 'StatisticsController@partyBranch2']);
        $router->get('partyBranchPage/3', ['as' => 'admin-statistics-party-branch-page-3', 'uses' => 'StatisticsController@partyBranchPage3']);
        $router->get('partyBranch/3', ['as' => 'admin-statistics-party-branch-3', 'uses' => 'StatisticsController@partyBranch3']);

    });

    /**
     * 通知公告管理模块，路由为 /admin/notice/{action},命名空间 \App\Http\Controllers\Manager\
     */
    $router->group(['prefix' => 'notice'], function(Router $router){

        /**
         * 党校管理子模块，路由为 /admin/notice/party-school/{action}, 命名空间 \App\Http\Controllers\Manager\
         */
        $router->group(['prefix' => 'party-school'], function(Router $router){
            //列表--申请人党校
            $router->get('list/70', ['as' => 'admin-notice-party-school-list-applicant', 'uses' => 'NoticeController@partySchoolApplicant']);
            //列表--院级积极分子党校
            $router->get('list/71', ['as' => 'admin-notice-party-school-list-academy', 'uses' => 'NoticeController@partySchoolAcademy']);
            //列表--预备党员党校
            $router->get('list/72', ['as' => 'admin-notice-party-school-list-probationary', 'uses' => 'NoticeController@partySchoolProbationary']);
            //列表--党支部书记党校
            $router->get('list/73', ['as' => 'admin-notice-party-school-list-secretary', 'uses' => 'NoticeController@partySchoolSecretary']);

            //隐藏(显示)
            $router->patch('{notice_id}/hide', ['as' => 'admin-notice-party-school-hide', 'uses' =>'NoticeController@hide']);
            //置顶(取消置顶)
            $router->patch('{notice_id}/top-up', ['as' => 'admin-notice-party-school-top-up', 'uses' => 'NoticeController@topUp']);

            //编辑
            $router->get('{notice_id}/edit', ['as' => 'admin-notice-party-school-edit-page', 'uses' => 'NoticeController@editPage']);
            $router->post('{notice_id}/edit', ['as' => 'admin-notice-party-school-edit', 'uses' => 'NoticeController@edit']);

            $router->get('{notice_id}', ['as' => 'admin-notice-party-school', 'uses' => 'NoticeController@getNoticeById']);

        });
        /**
         * 添加公告子模块，路由为 /admin/notice/add/{action}, 命名空间 \App\Http\Controllers\Manager\
         */
        $router->group(['prefix' => 'add'], function(Router $router){
            $router->get('/', ['as' => 'admin-notice-add-page', 'uses' => 'NoticeController@addPage']);
            $router->post('/', ['as' => 'admin-notice-add', 'uses' => 'NoticeController@add']);
        });

        /**
         * 活动通知子模块，路由为 /admin/notice/activity/{action}, 命名空间 \App\Http\Controllers\Manager\
         */
        $router->group(['prefix' => 'activity'], function(Router $router){
            $router->get('list', ['as' => 'admin-notice-activity-list', 'uses' => 'NoticeController@activity']);
            $router->patch('{activity_id}/hide', ['as' => 'admin-notice-activity-hide', 'uses' => 'NoticeController@hide']);
            $router->patch('{activity_id}/topUp', ['as' => 'admin-notice-activity-top-up', 'uses' => 'NoticeController@topUp']);

            $router->get('{activity_id}/edit', ['as' => 'admin-notice-activity-edit-page', 'uses' => 'NoticeController@activityEditPage']);
            $router->post('{activity_id}/edit', ['as' => 'admin-notice-activity-edit', 'uses' => 'NoticeController@activityEdit']);

            $router->get('add', ['as' => 'admin-notice-activity-add-page', 'uses' => 'NoticeController@activityAddPage']);
            $router->post('add', ['as' => 'admin-notice-activity-add', 'uses' => 'NoticeController@activityAdd']);

            $router->get('{notice_id}', ['as' => 'admin-notice-activity', 'uses' => 'NoticeController@getNoticeById']);

        });
    });

    /**
     * 党建专项模块， 路由为 /admin/party-build/{action}, 命名空间 \App\Http\Controllers\Manager\
     */
    $router->group(['prefix' => 'party-build'], function(Router $router){
        //党建专项新闻列表
        $router->get('list', ['as' => 'admin-party-build-list', 'uses' => 'PartyBuildController@lists']);

        //隐藏(显示)、置顶(取消置顶)新闻
        $router->patch('{id}/hide', ['as' => 'admin-party-build-hide', 'uses' => 'PartyBuildController@hide']);
        $router->patch('{id}/topUp',['as' => 'admin-party-build-top-up', 'uses' =>  'PartyBuildController@topUp']);

        //编辑新闻
        $router->get('{id}/edit', ['as' => 'admin-party-build-edit-page', 'uses' => 'PartyBuildController@editPage']);
        $router->post('{id}/edit', ['as' => 'admin-party-build-edit', 'uses' => 'PartyBuildController@edit']);

        //添加新闻
        $router->get('add', ['as' => 'admin-party-build-add-page', 'uses' => 'PartyBuildController@addPage']);
        $router->post('add', ['as' => 'admin-party-build-add', 'uses' => 'PartyBuildController@add']);

        $router->get('{id}', ['as' => 'admin-party-build', 'uses' => 'PartyBuildController@getNewsById']);
    });

    /**
     * 学习小组模块， 路由为 /admin/study-group/{action}, 命名空间 App\Http\Controllers\Manager\
     */
    $router->group(['prefix' => 'study-group'], function(Router $router){
        //新闻列表
        $router->get('list', ['as' => 'admin-study-group-list', 'uses' => 'StudyGroupController@lists']);

        //隐藏(显示)、置顶(取消置顶)新闻
        $router->patch('{id}/hide', ['as' => 'admin-study-group-hide', 'uses' => 'StudyGroupController@hide']);
        $router->patch('{id}/topUp', ['as' => 'admin-study-group-top-up', 'uses' => 'StudyGroupController@topUp']);

        //编辑新闻
        $router->get('{id}/edit', ['as' => 'admin-study-group-edit-page', 'uses' => 'StudyGroupController@editPage']);
        $router->post('{id}/edit', ['as' => 'admin-study-group-edit', 'uses' => 'StudyGroupController@edit']);

        //添加新闻
        $router->get('add', ['as' => 'admin-study-group-add-page', 'uses' => 'StudyGroupController@addPage']);
        $router->post('add', ['as' => 'admin-study-group-add', 'uses' => 'StudyGroupController@add']);

        $router->get('{id}', ['as' => 'admin-study-group', 'uses' => 'StudyGroupController@getNewsById']);
    });

    /**
     * 党校培训模块， 路由为 /admin/party-school/{action}, 命名空间 App\Http\Controllers\Manager
     */
    $router->group(['prefix' => 'party-school'], function(Router $router){
        //新闻列表
        $router->get('list', ['as' => 'admin-party-school-list', 'uses' => 'PartySchoolController@lists']);

        //隐藏(显示)、置顶(取消置顶)新闻
        $router->patch('{id}/hide', ['as' => 'admin-party-school-hide', 'uses' => 'PartySchoolController@hide']);
        $router->patch('{id}/top-up', ['as' => 'admin-party-school-top-up', 'uses' => 'PartySchoolController@topUp']);

        //编辑新闻
        $router->get('{id}/edit', ['as' => 'admin-party-school-edit-page', 'uses' => 'PartySchoolController@editPage']);
        $router->post('{id}/edit', ['as' => 'admin-party-school-edit', 'uses' => 'PartySchoolController@edit']);

        //添加新闻
        $router->get('add', ['as' => 'admin-party-school-add-page', 'uses' => 'PartySchoolController@addPage']);
        $router->post('add', ['as' => 'admin-party-school-add', 'uses' => 'PartySchoolController@add']);

        $router->get('{id}', ['as' => 'admin-party-school', 'uses' => 'PartySchoolController@getNewsById']);
    });

    /**
     * 重要文件模块， 路由为 /admin/important-files/{action}, 命名空间 App\Http\Controllers\Manager
     */
    $router->group(['prefix' => 'important-files'], function(Router $router){
        //新闻列表
        $router->get('list', ['as' => 'admin-important-files-list', 'uses' => 'ImportantFilesController@lists']);

        //隐藏(显示)
        $router->patch('{id}/hide', ['as' => 'admin-important-files-hide', 'uses' => 'ImportantFilesController@hide']);

        //编辑新闻
        $router->get('{id}/edit', ['as' => 'admin-important-files-edit-page', 'uses' => 'ImportantFilesController@editPage']);
        $router->post('{id}/edit', ['as' => 'admin-important-files-edit', 'uses' => 'ImportantFilesController@edit']);

        //添加新闻
        $router->get('add', ['as' => 'admin-important-files-add-page', 'uses' => 'ImportantFilesController@addPage']);
        $router->post('add', ['as' => 'admin-important-files-add', 'uses' => 'ImportantFilesController@add']);

        $router->get('{id}', ['as' => 'admin-important-files', 'uses' => 'ImportantFilesController@getFilesById']);
    });

    /**
     * 理论学习模块， 路由为 /manger/theory-study/{action}, 命名空间 App\Http\Controllers\Manager
     */
    $router->group(['prefix' => 'theory-study'], function(Router $router){
        //内容列表
        $router->get('list', ['as' => 'admin-theory-study-list', 'uses' => 'TheoryStudyController@lists']);

        //隐藏(显示)
        $router->patch('{id}/hide', ['as' => 'admin-theory-study-hide', 'uses' => 'TheoryStudyController@hide']);

        //编辑
        $router->group(['prefix' => 'edit'], function(Router $router){
            //视频编辑
            $router->get('video/{id}', ['as' => 'admin-theory-study-edit-video-page', 'uses' => 'TheoryStudyController@editVideoPage']);
            $router->post('video/{id}', ['as' => 'admin-theory-study-edit-video', 'uses' => 'TheoryStudyController@editVideo']);

            //文章编辑
            $router->get('article/{id}', ['as' => 'admin-theory-study-edit-article-page', 'uses' => 'TheoryStudyController@editArticlePage']);
            $router->post('article/{id}', ['as' => 'admin-theory-study-edit-article', 'uses' => 'TheoryStudyController@editArticle']);

            //电子书编辑
            $router->get('eBook/{id}', ['as' => 'admin-theory-study-edit-eBook-page', 'uses' => 'TheoryStudyController@editEBookPage']);
            $router->post('eBook/{id}', ['as' => 'admin-theory-study-edit-eBook', 'uses' => 'TheoryStudyController@editEBook']);
        });

        //添加
        $router->group(['prefix' => 'add'], function(Router $router){
            //视频添加
            $router->get('video', ['as' => 'admin-theory-study-add-video-page', 'uses' => 'TheoryStudyController@addVideoPage']);
            $router->post('video', ['as' => 'admin-theory-study-add-video', 'uses' => 'TheoryStudyController@addVideo']);

            //文章添加
            $router->get('article', ['as' => 'admin-theory-study-add-article-page', 'uses' => 'TheoryStudyController@addArticlePage']);
            $router->post('article', ['as' => 'admin-theory-study-add-article', 'uses' => 'TheoryStudyController@addArticle']);

            //电子书添加
            $router->get('eBook', ['as' => 'admin-theory-study-eBook-page', 'uses' => 'TheoryStudyController@addEBookPage']);
            $router->post('eBook', ['as' => 'admin-theory-study-eBook', 'uses' => 'TheoryStudyController@addEBook']);
        });

        $router->get('{id}', ['as' => 'admin-theory-study', 'uses' => 'TheoryStudyController@getContentsById']);

    });

    /**
     * 消息管理模块， 路由为 /admin/message/{action}, 命名空间 App\Http\Controllers\Manager
     */
    $router->group(['prefix' => 'message'], function(Router $router){
        //收信箱
        $router->get('receive', ['as' => 'admin-message-receive', 'uses' => 'MessageController@receive']);

        //发信箱
        $router->get('send', ['as' => 'admin-message-send', 'uses' => 'MessageController@send']);

        //查看信件详情
        $router->get('watch/{id}', ['as' => 'admin-message-watch', 'uses' => 'MessageController@watch']);

        //写信
        $router->get('write', ['as' => 'admin-message-write-page', 'uses' => 'MessageController@writePage']);
        $router->post('write', ['as' => 'admin-message-write', 'uses' => 'MessageController@write']);
    });

    /**
     * 申请人管理模块，路由为 /admin/applicant/{action}, 命名空间 \App\Http\Controllers\Manager
     */
    $router->group(['prefix' => 'applicant'], function(Router $router){
        // 课程设置
        $router->group(['prefix' => 'course'], function(Router $router){
            //课程列表
            $router->get('/', ['as' => 'admin-applicant-course-list', 'uses' => 'ApplicantController@courseList']);
            //课程详情
            $router->get('{id}/detail', ['as' => 'admin-applicant-course-detail', 'uses' => 'ApplicantController@courseDetail']);
            //课程编辑
            $router->get('{id}/edit', ['as' => 'admin-applicant-course-edit-page', 'uses' => 'ApplicantController@courseEditPage']);
            $router->post('{id}/edit', ['as' => 'admin-applicant-course-edit', 'uses' => 'ApplicantController@courseEdit']);
            //隐藏(显示)
            $router->patch('{id}/hide', ['as' => 'admin-applicant-course-hide', 'uses' => 'ApplicantController@courseHide']);

            $router->get('{id}', ['as' => 'admin-applicant-course', 'uses' => 'ApplicantController@getCourseById']);
        });

        //文章设置
        $router->group(['prefix' => 'article'], function(Router $router){
            //文章列表
            $router->get('/', ['as' => 'admin-applicant-article-list', 'uses' => 'ApplicantController@articleList']);
            //文章添加
            $router->get('{course_id}/add', ['as' => 'admin-applicant-article-add-page', 'uses' => 'ApplicantController@articleAddPage']);
            $router->post('{course_id}/add', ['as' => 'admin-applicant-article-add', 'uses' => 'ApplicantController@articleAdd']);
            //文章编辑
            $router->get('{id}/edit', ['as' => 'admin-applicant-article-edit-page', 'uses' => 'ApplicantController@articleEditPage']);
            $router->post('{id}/edit', ['as' => 'admin-applicant-article-edit', 'uses' => 'ApplicantController@articleEdit']);
            //隐藏(显示)
            $router->patch('{id}/hide', ['as' => 'admin-applicant-article-hide', 'uses' => 'ApplicantController@articleHide']);
            //删除
            $router->post('{id}/delete', ['as' => 'admin-applicant-article-delete', 'uses' => 'ApplicantController@articleDelete']);

            $router->get('{id}', ['as' => 'admin-applicant-article', 'uses' => 'ApplicantController@getArticleById']);
        });

        //题目管理
        $router->group(['prefix' => 'exercise'], function(Router $router){
            //题目列表
            $router->get('/', ['as' => 'admin-applicant-exercise-list', 'uses' => 'ApplicantController@exerciseList']);
            //题目添加
            $router->get('{course_id}/add', ['as' => 'admin-applicant-exercise-add-page', 'uses' => 'ApplicantController@exerciseAddPage']);
            $router->post('{course_id}/add', ['as' => 'admin-applicant-exercise-add', 'uses' => 'ApplicantController@exerciseAdd']);
            //题目编辑
            $router->get('{id}/edit', ['as' => 'admin-applicant-exercise-edit-page', 'uses' => 'ApplicantController@exerciseEditPage']);
            $router->post('{id}/edit', ['as' => 'admin-applicant-exercise-edit', 'uses' => 'ApplicantController@exerciseEdit']);
            //隐藏(显示)
            $router->patch('{id}/hide', ['as' => 'admin-applicant-exercise-hide', 'uses' => 'ApplicantController@exerciseHide']);
            //删除
            $router->post('{id}/delete', ['as' => 'admin-applicant-exercise-delete', 'uses' => 'ApplicantController@exerciseDelete']);

            $router->get('{id}', ['as' => 'admin-applicant-exercise', 'uses' => 'ApplicantController@getExerciseById']);
        });

        // 考试控制
        $router->group(['prefix' => 'exam'], function(Router $router){
            //考试列表
            $router->get('/', ['as' => 'admin-applicant-exam-list', 'uses' => 'ApplicantController@examList']);
            //考试详情
            $router->get('{id}/detail', ['as' => 'admin-applicant-exam-detail', 'uses' => 'ApplicantController@examDetail']);
            //考试修改
            $router->get('{id}/edit', ['as' => 'admin-applicant-exam-edit-page', 'uses' => 'ApplicantController@examEditPage']);
            $router->post('{id}/edit', ['as' => 'admin-applicant-exam-edit', 'uses' => 'ApplicantController@examEdit']);
            //添加考试
            $router->get('add', ['as' => 'admin-applicant-exam-add-page', 'uses' => 'ApplicantController@examAddPage']);
            $router->post('add', ['as' => 'admin-applicant-exam-add', 'uses' => 'ApplicantController@examAdd']);
            //删除考试
            $router->post('{id}/delete', ['as' => 'admin-applicant-exam-delete', 'uses' => 'ApplicantController@examDelete']);
            //状态改变
            $router->patch('{id}/change/{status}', ['as' => 'admin-applicant-exam-change', 'uses' => 'ApplicantController@examChange']);
            //附件下载
            $router->get('{id}/download', ['as' => 'admin-applicant-exam-download', 'uses' => 'ApplicantController@examDownload']);

            $router->get('{id}', ['as' => 'admin-applicant-exam-list', 'uses' => 'ApplicantController@getExamById']);
        });

        //报名情况
        $router->group(['prefix' => 'sign'], function(Router $router){
            //报名列表
            $router->get('/list', ['as' => 'admin-applicant-sign-list', 'uses' => 'ApplicantController@signList']);
            //退考人员
            $router->get('/exit', ['as' => 'admin-applicant-sign-exit', 'uses' => 'ApplicantController@signExit']);
            //补考报名
            $router->get('/makeup', ['as' => 'admin-applicant-sign-makeup-page', 'uses' => 'ApplicantController@signMakeupPage']);
            $router->post('/makeup', ['as' => 'admin-applicant-sign-makeup', 'uses' => 'ApplicantController@signMakeup']);
        });

        //成绩录入
        $router->group(['prefix' => 'grade-input'], function(Router $router){
            $router->get('/', ['as' => 'admin-applicant-grade-input-page', 'uses' => 'ApplicantController@gradeInputPage']);
            $router->post('/', ['as' => 'admin-applicant-grade-input', 'uses' => 'ApplicantController@gradeInput']);
        });

        //结业成绩查询
        $router->group(['prefix' => 'grade-list'], function(Router $router){
            $router->get('/', ['as' => 'admin-applicant-grade-list-page', 'uses' => 'ApplicantController@gradeListPage']);
            $router->post('/', ['as' => 'admin-applicant-grade-list', 'uses' => 'ApplicantController@gradeList']);
        });

        //证书管理
        $router->group(['prefix' => 'certificate'], function(Router $router){
            //证书列表
            $router->get('list', ['as' => 'admin-applicant-certificate-list-page', 'uses' => 'ApplicantController@certificateListPage']);
            $router->post('list', ['as' => 'admin-applicant-certificate-list', 'uses' => 'ApplicantController@certificateList']);
            //证书发放
            $router->get('grant', ['as' => 'admin-applicant-certificate-grant-page', 'uses' => 'ApplicantController@certificateGrantPage']);
            $router->post('grant', ['as' => 'admin-applicant-certificate-grant', 'uses' => 'ApplicantController@certificateGrant']);
            $router->post('grant-result', ['as' => 'admin-applicant-certificate-grant-result', 'uses' => 'ApplicantController@certificateGrantResult']);
            //证书补办
            $router->get('last-grant', ['as' => 'admin-applicant-certificate-last-grant', 'uses' => 'ApplicantController@certificateLastGrant']);
            $router->get('last-grant/{id}/detail', ['as' => 'admin-applicant-certificate-last-grant-detail-page', 'uses' => 'ApplicantController@certificateLastGrantDetailPage']);
            $router->post('last-grant/{id}/detail', ['as' => 'admin-applicant-certificate-last-grant-detail', 'uses' => 'ApplicantController@certificateLastGrantDetail']);
            $router->post('last-grant/{id}/reject', ['as' => 'admin-applicant-certificate-last-grant-reject', 'uses' => 'ApplicantController@certificateLastGrantReject']);

            $router->get('last-grant/{id}', ['as' => 'admin-applicant-certificate-last-grant', 'uses' => 'ApplicantController@getCertificateById']);
        });

        // 申诉管理
        $router->group(['prefix' => 'complain'], function(Router $router){
            //证书列表
            $router->get('/', ['as' => 'admin-applicant-complain-list', 'uses' => 'ApplicantController@complainList']);
            //申诉回复
            //展示申诉还未回复的页面,含编辑器
            $router->get('{id}/detail', ['as' => 'admin-applicant-complain-detail-page', 'uses' => 'ApplicantController@complainDetailPage']);
            //展示申诉已回复的页面
            $router->get('{id}/detail_1', ['as' => 'admin-applicant-complain-detail-1-page', 'uses' => 'ApplicantController@complainDetailPage_1']);
            $router->post('{id}/detail', ['as' => 'admin-applicant-complain-detail', 'uses' => 'ApplicantController@complainDetail']);
            $router->get('{id}', ['as' => 'admin-applicant-complain', 'uses' => 'ApplicantController@getComplainById']);
            /*
             * 新党建因为部分逻辑修改，可能会导致部分已回复的申诉显示为未回复，只需再提交一次即可解决
             * 新提交的回复内容不会覆盖原来回复的内容
             * 最终显示的回复内容仍然是之前所回复的
             */
        });

        // 作弊+违纪
        $router->group(['prefix' => 'cheat'], function(Router $router){
            $router->get('/', ['as' => 'admin-applicant-cheat-page', 'uses' => 'ApplicantController@cheatListPage']);
            $router->post('/', ['as' => 'admin-applicant-cheat', 'uses' => 'ApplicantController@cheatList']);
        });

        // 被锁人员名单
        $router->get('locked', ['as' => 'admin-applicant-locked', 'uses' => 'ApplicantController@lockedList']);
        // 解锁
        $router->post('locked/{id}/unlock', ['as' => 'admin-applicant-locked-unlock', 'uses' => 'ApplicantController@unlock']);

        // 被清人员名单
        $router->get('clear20', ['as' => 'admin-applicant-clear20-page', 'uses' => 'ApplicantController@clearList']);
        // 解除清除
        $router->post('clear20/{id}/unclear', ['as' => 'admin-applicant-clear20', 'uses' => 'ApplicantController@unclear']);
    });

    /**
     * 院级积极分子管理模块，路由为 /admin/academy/{action}, 命名空间 \App\Http\Controllers\Manager
     */
    $router->group(['prefix' => 'academy'], function(Router $router){
        // 总培训控制
        $router->group(['prefix' => 'train-list'], function(Router $router){
            //总培训列表
            $router->get('/', ['as' => 'admin-academy-train-list', 'uses' => 'AcademyController@trainList']);
            //关闭总培训
            $router->patch('{id}/close', ['as' => 'admin-academy-train-list-close', 'uses' => 'AcademyController@trainClose']);
            //添加总培训
            $router->get('add', ['as' => 'admin-academy-train-list-add-page', 'uses' => 'AcademyController@trainAddPage']);
            $router->post('add', ['as' => 'admin-academy-train-list-add', 'uses' => 'AcademyController@trainAdd']);
        });

        // 子培训控制
        $router->group(['prefix' => 'test-list'], function(Router $router){
            //子培训列表
            $router->get('list', ['as' => 'admin-academy-test-list', 'uses' => 'AcademyController@testList']);
            //子培训详情
            $router->get('{id}/detail', ['as' => 'admin-academy-test-list-detail', 'uses' => 'AcademyController@testDetail']);
            //添加子培训
            $router->get('add', ['as' => 'admin-academy-test-list-add-page', 'uses' => 'AcademyController@testAddPage']);
            $router->post('add', ['as' => 'admin-academy-test-list-add', 'uses' => 'AcademyController@testAdd']);
            //编辑子培训
            $router->get('{id}/edit', ['as' => 'admin-academy-test-list-edit-page', 'uses' => 'AcademyController@testEditPage']);
            $router->post('{id}/edit', ['as' => 'admin-academy-test-list-edit', 'uses' => 'AcademyController@testEdit']);
            //删除
            $router->patch('{id}/delete', ['as' => 'admin-academy-test-list-delete', 'uses' => 'AcademyController@testDelete']);
            //状态改变
            $router->patch('{id}/change/{status}', ['as' => 'admin-academy-test-list-change', 'uses' => 'AcademyController@testChange']);

            $router->get('{id}', ['as' => 'admin-academy-test-list', 'uses' => 'AcademyController@getTestById']);
        });

        // 报名情况
        $router->group(['prefix' => 'sign'], function(Router $router){
            //报名列表
            $router->get('/', ['as' => 'admin-academy-sign', 'uses' => 'AcademyController@signList']);
            //院级补报名
            $router->get('makeup', ['as' => 'admin-academy-sign-makeup-page', 'uses' => 'AcademyController@signMakeupPage']);
            $router->post('makeup', ['as' => 'admin-academy-sign-makeup', 'uses' => 'AcademyController@signMakeup']);
        });

        // 成绩录入
        $router->group(['prefix' => 'grade-input'], function(Router $router){
            $router->get('/', ['as' => 'admin-academy-grade-input-page', 'uses' => 'AcademyController@gradeInputPage']);
            $router->post('/', ['as' => 'admin-academy-grade-input', 'uses' => 'AcademyController@gradeInput']);
        });

        // 结业成绩
        $router->group(['prefix' => 'grade-list'], function(Router $router){
            $router->get('/', ['as' => 'admin-academy-grade-list-page', 'uses' => 'AcademyController@gradeListPage']);
            $router->post('/', ['as' => 'admin-academy-grade-list', 'uses' => 'AcademyController@gradeList']);
        });

        // 证书管理
        $router->group(['prefix' => 'certificate'], function(Router $router){
            //发放详情
            $router->get('list', ['as' => 'admin-academy-certificate-list-page', 'uses' => 'AcademyController@certificateListPage']);
            $router->post('list', ['as' => 'admin-academy-certificate-list', 'uses' => 'AcademyController@certificateList']);
            //证书发放
            $router->get('grant', ['as' => 'admin-academy-certificate-grant-page', 'uses' => 'AcademyController@certificateGrantPage']);
            $router->post('grant', ['as' => 'admin-academy-certificate-grant', 'uses' => 'AcademyController@certificateGrant']);
            $router->post('grant-result', ['as' => 'admin-academy-certificate-grant-result', 'uses' => 'AcademyController@certificateGrantResult']);
            //证书补办
            $router->get('last-grant', ['as' => 'admin-academy-certificate-last-grant', 'uses' => 'AcademyController@certificateLastGrant']);
            $router->get('last-grant/{id}/detail', ['as' => 'admin-academy-certificate-last-grant-detail-page', 'uses' => 'AcademyController@certificateLastGrantDetailPage']);
            $router->post('last-grant/{id}/detail', ['as' => 'admin-academy-certificate-last-grant-detail', 'uses' => 'AcademyController@certificateLastGrantDetail']);
            $router->post('last-grant/{id}/reject', ['as' => 'admin-academy-certificate-last-grant-reject', 'uses' => 'AcademyController@certificateLastGrantReject']);

            $router->get('last-grant/{id}', ['as' => 'admin-academy-certificate-last-grant', 'uses' => 'AcademyController@getCertificateById']);
        });

        // 申诉管理
        $router->group(['prefix' => 'complain'], function(Router $router){
            //申诉列表
            $router->get('/', ['as' => 'admin-academy-complain', 'uses' => 'AcademyController@complainList']);
            //申诉回复
            //展示申诉还未回复的页面,含编辑器
            $router->get('{id}/detail', ['as' => 'admin-academy-complain-detail-page', 'uses' => 'AcademyController@complainDetailPage']);
            //展示申诉已回复的页面
            $router->get('{id}/detail_1', ['as' => 'admin-academy-complain-detail-page-1', 'uses' => 'AcademyController@complainDetailPage_1']);
            $router->post('{id}/detail', ['as' => 'admin-academy-complain-detail', 'uses' => 'AcademyController@complainDetail']);
            $router->get('{id}', ['as' => 'admin-academy-complain', 'uses' => 'AcademyController@getComplainById']);
            /*
             * 新党建因为部分逻辑修改，可能会导致部分已回复的申诉显示为未回复，只需再提交一次即可解决
             * 新提交的回复内容不会覆盖原来回复的内容
             * 最终显示的回复内容仍然是之前所回复的
             */
        });
    });

    /**
     * 预备党员管理模块，路由为 /admin/probationary/{action}, 命名空间 \App\Http\Controllers\Manager
     */
    $router->group(['prefix' => 'probationary'], function(Router $router){
        // 培训设置
        $router->group(['prefix' => 'train'], function(Router $router){
            //培训列表
            $router->get('list', ['as' => 'admin-probationary-train-list', 'uses' => 'ProbationaryController@trainList']);
            //添加培训
            $router->get('add', ['as' => 'admin-probationary-train-add-page', 'uses' => 'ProbationaryController@trainAddPage']);
            $router->post('add', ['as' => 'admin-probationary-train-add', 'uses' => 'ProbationaryController@trainAdd']);
            //培训详情
            $router->get('{id}/detail', ['as' => 'admin-probationary-train-detail', 'uses' => 'ProbationaryController@trainDetail']);
            //编辑考试
            $router->get('{id}/edit', ['as' => 'admin-probationary-train-edit-page', 'uses' => 'ProbationaryController@trainEditPage']);
            $router->post('{id}/edit', ['as' => 'admin-probationary-train-edit', 'uses' => 'ProbationaryController@trainEdit']);
            //修改状态
            $router->get('{id}/status', ['as' => 'admin-probationary-train-status', 'uses' => 'ProbationaryController@trainStatusPage']);
            $router->post('{id}/entryStatus', ['as' => 'admin-probationary-train-entry-status', 'uses' => 'ProbationaryController@trainEntryStatus']);
            $router->post('{id}/netChooseStatus', ['as' => 'admin-probationary-train-net-choose-status', 'uses' => 'ProbationaryController@trainNetChooseStatus']);
            $router->post('{id}/gradeSearchStatus', ['as' => 'admin-probationary-train-grade-search-status', 'uses' => 'ProbationaryController@trainGradeSearchStatus']);
            $router->post('{id}/endListShow', ['as' => 'admin-probationary-train-end-list-show', 'uses' => 'ProbationaryController@trainEndListShow']);
            $router->post('{id}/goodMemberShow', ['as' => 'admin-probationary-train-good-member-show', 'uses' => 'ProbationaryController@trainGoodMemberShow']);
            $router->post('{id}/isEnd', ['as' => 'admin-probationary-train-is-end', 'uses' => 'ProbationaryController@trainIsEnd']);
            //结业成绩录入
            $router->post('{id}/open', ['as' => 'admin-probationary-train-open', 'uses' => 'ProbationaryController@trainOpen']);
            $router->post('{id}/close', ['as' => 'admin-probationary-train-close', 'uses' => 'ProbationaryController@trainClose']);

            $router->get('{id}', ['as' => 'admin-probationary-train', 'uses' => 'ProbationaryController@getTrainById']);
        });

        // 课程管理
        $router->group(['prefix' => 'course'], function(Router $router){
            //课程列表
            $router->get('list', ['as' => 'admin-probationary-course-list-page', 'uses' => 'ProbationaryController@courseListPage']);
            $router->post('list', ['as' => 'admin-probationary-course-list', 'uses' => 'ProbationaryController@courseList']);
            //课程详情
            $router->get('{id}/detail/compulsory', ['as' => 'admin-probationary-course-detail-compulsory', 'uses' => 'ProbationaryController@courseCompulsoryDetail']);
            $router->get('{id}/detail/elective', ['as' => 'admin-probationary-course-detail-elective', 'uses' => 'ProbationaryController@courseElectiveDetail']);
            //编辑必修课
            $router->get('{id}/edit/compulsory', ['as' => 'admin-probationary-course-edit-compulsory-page', 'uses' => 'ProbationaryController@courseCompulsoryEditPage']);
            $router->post('{id}/edit/compulsory', ['as' => 'admin-probationary-course-edit-compulsory', 'uses' => 'ProbationaryController@courseCompulsoryEdit']);
            //编辑选修课
            $router->get('{id}/edit/elective', ['as' => 'admin-probationary-course-edit-elective-page', 'uses' => 'ProbationaryController@courseElectiveEditPage']);
            $router->post('{id}/edit/elective', ['as' => 'admin-probationary-course-edit-elective', 'uses' => 'ProbationaryController@courseElectiveEdit']);
            //删除课程
            $router->post('{id}/delete', ['as' => 'admin-probationary-course-delete', 'uses' => 'ProbationaryController@courseDelete']);
            //开启(关闭)成绩录入
            $router->post('{id}/open', ['as' => 'admin-probationary-course-open', 'uses' => 'ProbationaryController@courseOpen']);
            $router->post('{id}/close', ['as' => 'admin-probationary-course-close', 'uses' => 'ProbationaryController@courseClose']);
            //添加必修课
            $router->get('add/compulsory', ['as' => 'admin-probationary-course-add-compulsory-page', 'uses' => 'ProbationaryController@courseAddCompulsoryPage']);
            $router->post('add/compulsory', ['as' => 'admin-probationary-course-add-compulsory', 'uses' => 'ProbationaryController@courseAddCompulsory']);
            //添加选修课
            $router->get('add/elective', ['as' => 'admin-probationary-course-add-elective-page', 'uses' => 'ProbationaryController@courseAddElectivePage']);
            $router->post('add/elective', ['as' => 'admin-probationary-course-add-elective', 'uses' => 'ProbationaryController@courseAddElective']);

            $router->get('{id}', ['as' => 'admin-probationary-course', 'uses' => 'ProbationaryController@getCourseById']);
        });

        // 报名管理
        $router->group(['prefix' => 'sign'], function(Router $router){
            //报名列表
            $router->get('list', ['as' => 'admin-probationary-sign-list', 'uses' => 'ProbationaryController@signList']);
            //退出(恢复)选课
            $router->post('{id}/inCourseChoose', ['as' => 'admin-probationary-sign-in-course-choose', 'uses' => 'ProbationaryController@signInCourseChoose']);
            $router->post('{id}/exitCourseChoose', ['as' => 'admin-probationary-sign-exit-course-choose', 'uses' => 'ProbationaryController@signExitCourseChoose']);
            //删除
            $router->post('{id}/delete', ['as' => 'admin-probationary-sign-delete', 'uses' => 'ProbationaryController@signDelete']);
            //退报名名单
            $router->get('exit-list', ['as' => 'admin-probationary-sign-exit-list', 'uses' => 'ProbationaryController@signExitList']);
            //后台补报名
            $router->get('makeup-sign', ['as' => 'admin-probationary-sign-makeup-sign-page', 'uses' => 'ProbationaryController@signMakeupPage']);
            $router->post('makeup-sign', ['as' => 'admin-probationary-sign-makeup-sign', 'uses' => 'ProbationaryController@signMakeup']);
        });

        // 选课管理
        $router->group(['prefix' => 'choose-course'], function(Router $router){
            //选课列表
            $router->get('list', ['as' => 'admin-probationary-choose-course-list-page', 'uses' => 'ProbationaryController@chooseCourseListPage']);
            $router->post('list', ['as' => 'admin-probationary-choose-course-list', 'uses' => 'ProbationaryController@chooseCourseList']);
            //退出(恢复)选课
            $router->post('{id}/inCourseChoose', ['as' => 'admin-probationary-choose-course-in-course-choose', 'uses' => 'ProbationaryController@chooseCourseInCourseChoose']);
            $router->post('{id}/exitCourseChoose', ['as' => 'admin-probationary-choose-course-exit-course-choose', 'uses' => 'ProbationaryController@chooseCourseExitCourseChoose']);
            //删除
            $router->post('{id}/delete', ['as' => 'admin-probationary-choose-course-delete', 'uses' => 'ProbationaryController@chooseCourseDelete']);
            //补选课
            $router->get('makeup', ['as' => 'admin-probationary-choose-course-makeup-page', 'uses' => 'ProbationaryController@chooseCourseMakeupPage']);
            $router->post('makeup', ['as' => 'admin-probationary-choose-course-makeup', 'uses' => 'ProbationaryController@chooseCourseMakeup']);
        });

        // 课程成绩录入
        $router->group(['prefix' => 'course-gradeInput'], function(Router $router){
            //成绩录入前对课程的筛选页面
            $router->get('/', ['as' => 'admin-probationary-course-grade-input-filter-1', 'uses' => 'ProbationaryController@courseGradeInputPage1']);
            //筛选后的页面，显示成绩录入表单
            $router->post('filter', ['as' => 'admin-probationary-course-grade-input-filter', 'uses' => 'ProbationaryController@courseGradeInputPage']);
            //录入成绩的后台操作
            $router->post('/', ['as' => 'admin-probationary-course-grade-input', 'uses' => 'ProbationaryController@courseGradeInput']);
        });

        // 结业成绩
        $router->group(['prefix' => 'graduation'], function(Router $router){
            //录入
            $router->get('input', ['as' => 'admin-probationary-graduation-input-page', 'uses' => 'ProbationaryController@graduationGradeInputPage']);
            $router->post('input', ['as' => 'admin-probationary-graduation-input', 'uses' => 'ProbationaryController@graduationGradeInput']);
            //调整
            $router->get('change', ['as' => 'admin-probationary-graduation-change-page-1', 'uses' => 'ProbationaryController@graduationGradeChangePage1']);
            $router->post('change1', ['as' => 'admin-probationary-graduation-change-page', 'uses' => 'ProbationaryController@graduationGradeChangePage']);
            $router->post('change', ['as' => 'admin-probationary-graduation-change', 'uses' => 'ProbationaryController@graduationGradeChange']);
        });

        // 成绩查询
        $router->group(['prefix' => 'grade-search'], function(Router $router){
            $router->get('/', ['as' => 'admin-probationary-grade-search-page', 'uses' => 'ProbationaryController@gradeSearchPage']);
            $router->post('/', ['as' => 'admin-probationary-grade-search', 'uses' => 'ProbationaryController@gradeSearch']);
        });

        // 证书管理
        $router->group(['prefix' => 'certificate'], function(Router $router){
            //发放详情
            $router->get('list', ['as' => 'admin-probationary-certificate-list-page', 'uses' => 'ProbationaryController@certificateListPage']);
            $router->post('list', ['as' => 'admin-probationary-certificate-list-page', 'uses' => 'ProbationaryController@certificateList']);
            //证书发放
            $router->get('grant', ['as' => 'admin-probationary-certificate-grant-page', 'uses' => 'ProbationaryController@certificateGrantPage']);
            $router->post('grant', ['as' => 'admin-probationary-certificate-grant', 'uses' => 'ProbationaryController@certificateGrant']);
            $router->post('grant-result', ['as' => 'admin-probationary-certificate-grant-result', 'uses' => 'ProbationaryController@certificateGrantResult']);
            //证书补办
            $router->get('last-grant', ['as' => 'admin-probationary-certificate-last-grant', 'uses' => 'ProbationaryController@certificateLastGrant']);
            $router->get('last-grant/{id}/detail', ['as' => 'admin-probationary-certificate-last-grant-detail-page', 'uses' => 'ProbationaryController@certificateLastGrantDetailPage']);
            $router->post('last-grant/{id}/detail', ['as' => 'admin-probationary-certificate-last-grant-detail', 'uses' => 'ProbationaryController@certificateLastGrantDetail']);
            $router->post('last-grant/{id}/reject', ['as' => 'admin-probationary-certificate-last-grant-reject', 'uses' => 'ProbationaryController@certificateLastGrantReject']);

            $router->get('last-grant/{id}', ['as' => 'admin-probationary-certificate-last-grant', 'uses' => 'ProbationaryController@getCertificateById']);
        });

        // 申诉管理
        $router->group(['prefix' => 'complain'], function(Router $router){
            //申诉列表
            $router->get('/', ['as' => 'admin-probationary-complain', 'uses' => 'ProbationaryController@complainList']);
            //申诉回复
            //展示申诉还未回复的页面,含编辑器
            $router->get('{id}/detail', ['as' => 'admin-probationary-complain-detail-page', 'uses' => 'ProbationaryController@complainDetailPage']);
            //展示申诉已回复的页面
            $router->get('{id}/detail_1', ['as' => 'admin-probationary-complain-detail-page-1', 'uses' => 'ProbationaryController@complainDetailPage_1']);
            $router->post('{id}/detail', ['as' => 'admin-probationary-complain-detail', 'uses' => 'ProbationaryController@complainDetail']);
            $router->get('{id}', ['as' => 'admin-probationary-complain', 'uses' => 'ProbationaryController@getComplainById']);
            /*
             * 新党建因为部分逻辑修改，可能会导致部分已回复的申诉显示为未回复，只需再提交一次即可解决
             * 新提交的回复内容不会覆盖原来回复的内容
             * 最终显示的回复内容仍然是之前所回复的
             */
        });

        // 成绩查询
        $router->group(['prefix' => 'grade-search'], function(Router $router){
            $router->get('/', 'ProbationaryController@gradeSearchPage');
            $router->post('/', 'ProbationaryController@gradeSearch');
        });

    });

    /**
     * 支部管理模块，路由为 /admin/party-branch/{action}, 命名空间 \App\Http\Controllers\Manager\PartyBranch
     */
    $router->group([ 'prefix' => 'party-branch'], function(Router $router){
        // 支部列表--每个学院及支部总数
        $router->get('list', ['as' => 'admin-party-branch-list', 'uses' => 'PartyBranchController@pList']);
        // 支部列表--列出每个的所有支部
        $router->get('r-list/{id}', ['as' => 'admin-party-branch-c-list', 'uses' => 'PartyBranchController@cList']);
        // 支部管理--主页面
        $router->get('{id}/admin', ['as' => 'admin-party-branch-manager', 'uses' => 'PartyBranchController@manager']);
        // 支部管理--添加支部书记、组织委员、宣传委员
        $router->get('{id}/add-cadre/{type}', ['as' => 'admin-party-branch-add-cadre-page', 'uses' => 'PartyBranchController@addCadrePage']);
        $router->post('{id}/add-cadre/{type}', ['as' => 'admin-party-branch-add-cadre', 'uses' => 'PartyBranchController@addCadre']);
        // 支部管理--删除支部书记、组织委员、宣传委员
        $router->patch('{id}/delete-cadre/{type}', ['as' => 'admin-party-branch-delete-cadre', 'uses' => 'PartyBranchController@deleteCadre']);
        // 支部管理--成员列表
        $router->get('{id}/member-list', ['as' => 'admin-party-branch-member-list', 'uses' => 'PartyBranchController@memberList']);
        // 支部管理--成员添加
        $router->get('{id}/member-add', ['as' => 'admin-party-branch-member-add-page', 'uses' => 'PartyBranchController@memberAddPage']);
        $router->post('{id}/member-add', ['as' => 'admin-party-branch-member-add', 'uses' => 'PartyBranchController@memberAdd']);
        // 支部管理--成员添加-混合党支部类型
        $router->get('{id}/member-add-mix-preview', ['as' => 'admin-party-branch-member-add-mix-preview-page', 'uses' => 'PartyBranchController@memberAddMixPreviewPage']);
        $router->get('{id}/member-add-mix', ['as' => 'admin-party-branch-member-add-mix-page', 'uses' => 'PartyBranchController@memberAddMixPage']);
        $router->post('{id}/member-add-mix', ['as' => 'admin-party-branch-member-add-mix', 'uses' => 'PartyBranchController@memberAddMix']);
        // 支部管理--成员删除
        $router->get('{id}/member-delete', ['as' => 'admin-party-branch-member-delete-page', 'uses' => 'PartyBranchController@memberDeletePage']);
        $router->post('{id}/member-delete', ['as' => 'admin-party-branch-member-delete', 'uses' => 'PartyBranchController@memberDelete']);
        // 编辑
        $router->get('{id}/edit', ['as' => 'admin-party-branch-edit-page', 'uses' => 'PartyBranchController@editPage']);
        $router->post('{id}/edit', ['as' => 'admin-party-branch-edit', 'uses' => 'PartyBranchController@edit']);
        // 删除支部
        $router->post('{id}/delete', ['as' => 'admin-party-branch-delete', 'uses' => 'PartyBranchController@deleteBranch']);
        // 支部查询
        $router->get('search-preview', ['as' => 'admin-party-branch-search-preview', 'uses' => 'PartyBranchController@searchPreview']);
        $router->get('search', ['as' => 'admin-party-branch-search', 'uses' => 'PartyBranchController@search']);
        // 支部组建
        $router->get('add', ['as' => 'admin-party-branch-add-page', 'uses' => 'PartyBranchController@addPage']);
        $router->post('add', ['as' => 'admin-party-branch-add', 'uses' => 'PartyBranchController@add']);
        // 支部隐藏
        $router->get('hide-preview', ['as' => 'admin-party-branch-hide-preview', 'uses' => 'PartyBranchController@hidePreview']);
        $router->get('hide', ['as' => 'admin-party-branch-hide-page', 'uses' => 'PartyBranchController@hidePage']);
        $router->patch('{id}/hide', ['as' => 'manger-party-branch-hide', 'uses' => 'PartyBranchController@hide']);
        $router->get('hided-list-preview', ['as' => 'admin-party-branch-hided-list-preview', 'uses' => 'PartyBranchController@hidedListPreview']);
        $router->get('hided-list', ['as' => 'admin-party-branch-hided-list', 'uses' => 'PartyBranchController@hidedList']);
    });

    /**
     * 文件上传下载控制
     */
    $router->group(['prefix' => 'file'], function(Router $router){
        $router->post('', ['as' => 'file', 'uses' => 'FileController@upload']);
    });

});
