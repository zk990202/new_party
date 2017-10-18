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
            Route::get('grant', ['as' => 'manager-applicant-grant-page', 'uses' => 'ApplicantController@certificateGrantPage']);
            Route::post('grant', ['as' => 'manager-applicant-grant', 'uses' => 'ApplicantController@certificateGrant']);
            Route::post('grant-result', ['as' => 'manager-applicant-grant-result', 'uses' => 'ApplicantController@certificateGrantResult']);
            //证书补办
            Route::get('last-grant', ['as' => 'manager-applicant-last-grant', 'uses' => 'ApplicantController@certificateLastGrant']);
            Route::get('last-grant/{id}/detail', ['as' => 'manager-applicant-last-grant-detail-page', 'uses' => 'ApplicantController@certificateLastGrantDetailPage']);
            Route::post('last-grant/{id}/detail', ['as' => 'manager-applicant-last-grant-detail', 'uses' => 'ApplicantController@certificateLastGrantDetail']);
            Route::post('last-grant/{id}/reject', ['as' => 'manager-applicant-last-grant-reject', 'uses' => 'ApplicantController@certificateLastGrantReject']);

            Route::get('last-grant/{id}', ['as' => 'manager-applicant-last-grant', 'uses' => 'ApplicantController@getCertificateById']);
        });

        // 申诉管理
        Route::group(['prefix' => 'complain'], function(){
            //证书列表
            Route::get('/', ['as' => 'manager-applicant-complain-list', 'uses' => 'ApplicantController@complainList']);
            //申诉回复
            Route::get('{id}/detail', ['as' => 'manager-applicant-complain-detail-page', 'uses' => 'ApplicantController@complainDetailPage']);
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

        // 申诉管理
        Route::group(['prefix' => 'complain'], function(){
            //证书列表
            Route::get('/', 'AcademyController@complainList');
            //申诉回复
            Route::get('{id}/detail', 'AcademyController@complainDetailPage');
            Route::get('{id}/detail_1', 'AcademyController@complainDetailPage_1');
            Route::post('{id}/detail', 'AcademyController@complainDetail');
            Route::get('{id}', 'AcademyController@getComplainById');
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
            Route::get('list', 'ProbationaryController@trainList');
            //添加培训
            Route::get('add', 'ProbationaryController@trainAddPage');
            Route::post('add', 'ProbationaryController@trainAdd');
            //培训详情
            Route::get('{id}/detail', 'ProbationaryController@trainDetail');
            //编辑考试
            Route::get('{id}/edit', 'ProbationaryController@trainEditPage');
            Route::post('{id}/edit', 'ProbationaryController@trainEdit');
            //修改状态
            Route::get('{id}/status', 'ProbationaryController@trainStatusPage');
            Route::post('{id}/entryStatus', 'ProbationaryController@trainEntryStatus');
            Route::post('{id}/netChooseStatus', 'ProbationaryController@trainNetChooseStatus');
            Route::post('{id}/gradeSearchStatus', 'ProbationaryController@trainGradeSearchStatus');
            Route::post('{id}/endListShow', 'ProbationaryController@trainEndListShow');
            Route::post('{id}/goodMemberShow', 'ProbationaryController@trainGoodMemberShow');
            Route::post('{id}/isEnd', 'ProbationaryController@trainIsEnd');
            //结业成绩录入
            Route::post('{id}/open', 'ProbationaryController@trainOpen');
            Route::post('{id}/close', 'ProbationaryController@trainClose');

            Route::get('{id}', 'ProbationaryController@getTrainById');
        });

        // 课程管理
        Route::group(['prefix' => 'course'], function (){
            //课程列表
            Route::get('list', 'ProbationaryController@courseListPage');
            Route::post('list', 'ProbationaryController@courseList');
            //课程详情
            Route::get('{id}/detail/compulsory', 'ProbationaryController@courseCompulsoryDetail');
            Route::get('{id}/detail/elective', 'ProbationaryController@courseElectiveDetail');
            //编辑必修课
            Route::get('{id}/edit/compulsory', 'ProbationaryController@courseCompulsoryEditPage');
            Route::post('{id}/edit/compulsory', 'ProbationaryController@courseCompulsoryEdit');
            //编辑选修课
            Route::get('{id}/edit/elective', 'ProbationaryController@courseElectiveEditPage');
            Route::post('{id}/edit/elective', 'ProbationaryController@courseElectiveEdit');
            //删除课程
            Route::post('{id}/delete', 'ProbationaryController@courseDelete');
            //开启(关闭)成绩录入
            Route::post('{id}/open', 'ProbationaryController@courseOpen');
            Route::post('{id}/close', 'ProbationaryController@courseClose');
            //添加必修课
            Route::get('add/compulsory', 'ProbationaryController@courseAddCompulsoryPage');
            Route::post('add/compulsory', 'ProbationaryController@courseAddCompulsory');
            //添加选修课
            Route::get('add/elective', 'ProbationaryController@courseAddElectivePage');
            Route::post('add/elective', 'ProbationaryController@courseAddElective');

            Route::get('{id}', 'ProbationaryController@getCourseById');
        });

        // 报名管理
        Route::group(['prefix' => 'sign'], function (){
            //报名列表
            Route::get('list', 'ProbationaryController@signList');
            //退出(恢复)选课
            Route::post('{id}/inCourseChoose', 'ProbationaryController@signInCourseChoose');
            Route::post('{id}/exitCourseChoose', 'ProbationaryController@signExitCourseChoose');
            //删除
            Route::post('{id}/delete', 'ProbationaryController@signDelete');
            //退报名名单
            Route::get('exit-list', 'ProbationaryController@signExitList');
            //后台补报名
            Route::get('makeup-sign', 'ProbationaryController@signMakeupPage');
            Route::post('makeup-sign', 'ProbationaryController@signMakeup');
        });

        // 选课管理
        Route::group(['prefix' => 'choose-course'], function (){
            //报名列表
            Route::get('list', 'ProbationaryController@chooseCourseListPage');
            Route::post('list', 'ProbationaryController@chooseCourseList');
            //退出(恢复)选课
            Route::post('{id}/inCourseChoose', 'ProbationaryController@chooseCourseInCourseChoose');
            Route::post('{id}/exitCourseChoose', 'ProbationaryController@chooseCourseExitCourseChoose');
            //删除
            Route::post('{id}/delete', 'ProbationaryController@chooseCourseDelete');
            //补选课
            Route::get('makeup', 'ProbationaryController@chooseCourseMakeupPage');
            Route::post('makeup', 'ProbationaryController@chooseCourseMakeup');
        });

        // 课程成绩录入
        Route::group(['prefix' => 'course-gradeInput'], function (){
            //成绩录入前对课程的筛选页面
            Route::get('/', 'ProbationaryController@courseGradeInputPage1');
            //筛选后的页面，显示成绩录入表单
            Route::post('filter', 'ProbationaryController@courseGradeInputPage');
            //录入成绩的后台操作
            Route::post('/', 'ProbationaryController@courseGradeInput');
        });

        // 结业成绩
        Route::group(['prefix' => 'graduation'], function (){
            //录入
            Route::get('input', 'ProbationaryController@graduationGradeInputPage');
            Route::post('input', 'ProbationaryController@graduationGradeInput');
            //调整
            Route::get('change', 'ProbationaryController@graduationGradeChangePage1');
            Route::post('change1', 'ProbationaryController@graduationGradeChangePage');
            Route::post('change', 'ProbationaryController@graduationGradeChange');
        });

        // 成绩查询
        Route::group(['prefix' => 'grade-search'], function (){
            Route::get('/', 'ProbationaryController@gradeSearchPage');
            Route::post('/', 'ProbationaryController@gradeSearch');
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
