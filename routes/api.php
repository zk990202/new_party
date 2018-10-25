<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Front', 'middleware' => ['auth', 'log']], function(){
    // 首页
    Route::get('/', 'HomeController@index');

    // 入党申请人党校相关
    Route::group(['prefix' => 'applicant', 'middleware' => []], function(){
        // 20课列表
        Route::get('courseStudy', 'ApplicantController@courseStudy');
        Route::get('courseStudy/{id}', 'ApplicantController@courseDetail');

        Route::get('signUp', 'ApplicantController@signUpPage');
        Route::post('signUp', 'ApplicantController@signUp');

        Route::get('signResult', 'ApplicantController@signUpResult');
        Route::post('signExit', 'ApplicantController@signExit');

        Route::get('grade', 'ApplicantController@grade');
        Route::get('complain', 'ApplicantController@complainPage');
        Route::post('complain', 'ApplicantController@complain');

        Route::get('certificate', 'ApplicantController@certificate');

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

        Route::post('signExit', 'AcademyController@signExit');

        Route::get('grade', 'AcademyController@grade');
        Route::get('complain', 'AcademyController@complainPage');
        Route::post('complain', 'AcademyController@complain');

        Route::get('certificate', 'ApplicantController@certificate');
    });

    //预备党员党校党校学习
    Route::group(['prefix' => 'probationary'], function(){

        Route::get('notice', 'ProbationaryController@notice');
        Route::get('notice/{id}', 'ProbationaryController@noticeDetail');

        Route::get('signUp', 'ProbationaryController@signUpPage');
        Route::get('signResult', 'ProbationaryController@signUpResult');
        Route::post('signUp', 'ProbationaryController@signUp');
        Route::get('signExit', 'ProbationaryController@signExit');

        Route::get('courseChoose', 'ProbationaryController@courseChoosePage');
        Route::post('courseChoose', 'ProbationaryController@courseChoose');
        // 课程学习列表
        Route::get('studyList', 'ProbationaryController@courseChooseResult');
        Route::get('courseExit/{id}', 'ProbationaryController@courseExit');

        Route::get('grade', 'ProbationaryController@grade');
        Route::get('complain', 'ProbationaryController@complainPage');
        Route::post('complain', 'ProbationaryController@complain');

        Route::get('certificate', 'ApplicantController@certificate');
    });

    // 通知公告
    Route::group(['prefix' => 'notification'], function(){
        Route::get('applicant', 'NotificationController@applicant');
        Route::get('academy', 'NotificationController@academy');
        Route::get('probationary', 'NotificationController@probationary');
        Route::get('secretary', 'NotificationController@secretary');
        Route::get('activity', 'NotificationController@activity');
        Route::get('detail/{id}', 'NotificationController@detail');
    });

    // 党校培训 新闻板块
    Route::group(['prefix' => 'news'], function(){
        Route::get('partySchool', 'NewsController@partySchool');
        Route::get('detail/{id}', 'NewsController@detail');
    });

    // 党建专项
    Route::group(['prefix' => 'partyBuildSpecial'], function (){
        // 身边的英雄
        Route::get('hero', 'PartyBuildSpecialController@heroNews');
        // 中央精神
        Route::get('spirit', 'PartyBuildSpecialController@spiritNews');
        // 群众路线
        Route::get('massLine', 'PartyBuildSpecialController@massLineNews');
        // 中国梦
        Route::get('ChinaDream', 'PartyBuildSpecialController@ChinaDreamNews');

        Route::get('detail/{id}', 'PartyBuildSpecialController@detail');
    });

    // 重要文件
    Route::group(['prefix' => 'commonFiles'], function(){
        Route::get('regulation', 'FilesController@regulation');
        Route::get('instrument', 'FilesController@instrument');
        Route::get('mustRead', 'FilesController@mustRead');
        Route::get('manual', 'FilesController@manual');
        Route::get('detail/{id}', 'FilesController@detail');
    });

    // 个人支部
    Route::group(['prefix' => 'personal'], function(){
        Route::get('status', 'PersonalController@status');
        Route::get('partyBranch', 'PersonalController@partyBranch');
        // 支部成员列表
        Route::get('members', 'PersonalController@members');
        // 我的学习小组
        Route::get('groupMembers', 'PersonalController@groupMembers');
        Route::get('doc', 'PersonalController@docPage');
        Route::post('doc', 'PersonalController@docStore');
        // 上传文献查看
        Route::get('fileWatch/{type_start}/{type_end}', 'PersonalController@fileWatch');
        // 文献详情
        Route::get('fileDetail/{type}/{id}', 'PersonalController@fileDetail');
        // 我的消息
        Route::get('myMessage/{SentOrReceived}', 'PersonalController@myMessage');
        // 消息详情
        Route::get('messageDetail/{id}', 'PersonalController@messageDetail');
        // 我的申诉
        Route::get('myComplain', 'PersonalController@myComplain');
        // 申诉详情
        Route::get('complainDetail/{id}', 'PersonalController@complainDetail');
    });

    // 理论学习
    Route::group(['prefix' => 'theoryStudy'], function (){
        Route::get('/', 'TheoryStudyController@lists');
        Route::get('{id}', 'TheoryStudyController@detail');
    });

    // 文件下载
    Route::get('{filePath}/download/{fileName}', 'FileDownloadController@download');
});

Route::get('/login', 'Front\LogController@login');
Route::get('/logout', 'Front\LogController@logout');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

