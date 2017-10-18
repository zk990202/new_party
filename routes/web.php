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

        //添加新闻
        Route::get('add', 'PartyBuildController@addPage');
        Route::post('add', 'PartyBuildController@add');

        Route::get('{id}', 'PartyBuildController@getNewsById');
    });

// 学习小组模块， 路由为 /manager/study-group/{action}, 命名空间 App\Http\Controllers\Manager
        Route::group(['prefix' => 'study-group'], function(){

// 新闻列表
            Route::get('list', ['as' => 'manager-study-group-list','uses' => 'StudyGroupController@lists']);

// 隐藏(显示)新闻
            Route::patch('{id}/hide', ['as' => 'manager-study-group-hide','uses' => 'StudyGroupController@hide']);


// 置顶(取消置顶)新闻
            Route::patch('{id}/top-up', ['as' => 'manager-study-group-top-up','uses' => 'StudyGroupController@topUp']);

        //添加新闻
        Route::get('add', 'StudyGroupController@addPage');
        Route::post('add', 'StudyGroupController@add');

        Route::get('{id}', 'StudyGroupController@getNewsById');
    });


// 编辑新闻
            Route::get('{id}/edit', ['as' => 'manager-study-group-edit-page','uses' => 'StudyGroupController@editPage']);

// 编辑新闻
            Route::post('{id}/edit', ['as' => 'manager-study-group-edit','uses' => 'StudyGroupController@edit']);

// 添加新闻
            Route::get('add', ['as' => 'manager-study-group-add-page','uses' => 'StudyGroupController@addPage']);

// 添加新闻
            Route::post('add', ['as' => 'manager-study-group-add','uses' => 'StudyGroupController@add']);

        });

        //添加新闻
        Route::get('add', 'PartySchoolController@addPage');
        Route::post('add', 'PartySchoolController@add');

        Route::get('{id}', 'PartySchoolController@getNewsById');


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

        // 申诉管理
        Route::group(['prefix' => 'complain'], function(){
            //证书列表
            Route::get('/', 'ApplicantController@complainList');
            //申诉回复
            Route::get('{id}/detail', 'ApplicantController@complainDetailPage');
            Route::get('{id}/detail_1', 'ApplicantController@complainDetailPage_1');
            Route::post('{id}/detail', 'ApplicantController@complainDetail');
            Route::get('{id}', 'ApplicantController@getComplainById');
            /*
             * 新党建因为部分逻辑修改，可能会导致部分已回复的申诉显示为未回复，只需再提交一次即可解决
             * 新提交的回复内容不会覆盖原来回复的内容
             * 最终显示的回复内容仍然是之前所回复的
             */
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

            Route::get('{notice_id}', 'NoticeController@getNoticeById');

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




