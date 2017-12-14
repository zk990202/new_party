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



Route::group(['middleware' => 'Access'], function (){
    //首页
    Route::get('/index', ['as' => 'api-index', 'uses' => 'Api\IndexController@index']);

    //登录
    Route::get('/login', ['as' => 'api-login', 'uses' => 'Api\LoginController@login']);

    //通知公告模块
    Route::group(['prefix' => 'notice', 'namespace' => 'Api'], function (){
        //申请人培训公告
        Route::get('/party-school/list/applicant', ['as' => 'api-notice-party-school-list-applicant', 'uses' => 'NoticeController@partySchoolApplicant']);
        //院级积极分子培训公告
        Route::get('/party-school/list/academy', ['as' => 'api-notice-party-school-list-academy', 'uses' => 'NoticeController@partySchoolAcademy']);
        //预备党员培训公告
        Route::get('/party-school/list/probationary', ['as' => 'api-notice-party-school-list-probationary', 'uses' => 'NoticeController@partySchoolProbationary']);
        //党支部书记培训公告
        Route::get('/party-school/list/secretary', ['as' => 'api-notice-party-school-list-secretary', 'uses' => 'NoticeController@partySchoolSecretary']);
        //活动通知
        Route::get('/activity/list', ['as' => 'api-notice-activity-list', 'uses' => 'NoticeController@activity']);
        //通知详情
        Route::get('/{id}/detail', ['as' => 'api-notice-detail', 'uses' => 'NoticeController@detail']);
    });

    //网上党校--申请人党校
    Route::group(['prefix' => 'applicant', 'namespace' => 'Api'], function (){
        //课程学习--所有课程
        Route::get('/course', ['as' => 'api-applicant-all-course', 'uses' => 'ApplicantController@allCourse']);
        //课程详情--对应的几篇文章
        Route::get('/{id}/course', ['as' => 'api-applicant-course', 'uses' => 'ApplicantController@course']);
        //文章详情
        Route::get('/{id}/article', ['api-applicant-article', 'uses' => 'ApplicantController@article']);
        // 20课成绩
        Route::get('/twenty-courses-score', ['api-applicant-twenty-courses-score', 'uses' => 'ApplicantController@twentyCoursesScore'])->middleware('HasToken');
        //课程对应的题目
        Route::get('/{id}/exercise', ['api-applicant-exercise-page', 'uses' => 'ApplicantController@exercisePage'])->middleware('HasToken');
        Route::post('/{id}/exercise', ['api-applicant-exercise', 'uses' => 'ApplicantController@exercise'])->middleware('HasToken');
        //报名
        Route::get('/sign', ['as' => 'api-applicant-sign-page', 'uses' => 'ApplicantController@signPage'])->middleware('HasToken');
        Route::post('/sign', ['as' => 'api-applicant-sign', 'uses' => 'ApplicantController@sign'])->middleware('HasToken');
        //报名结果
        Route::get('/sign-result', ['as' => 'api-applicant-sign-result', 'uses' => 'ApplicantController@signResult'])->middleware('HasToken');
        //退出报名
        Route::get('/{entry_id}/sign-exit', ['as' => 'api-applicant-sign-exit', 'uses' => 'ApplicantController@signExit'])->middleware('HasToken');
        //成绩查询
        Route::get('/grade-check', ['as' => 'api-applicant-grade-check', 'uses' => 'ApplicantController@gradeCheck'])->middleware('HasToken');
        //证书查询
        Route::get('/{entry_id}/certificate-check', ['as' => 'api-applicant-certificate-check', 'uses' => 'ApplicantController@certificateCheck'])->middleware('HasToken');
        //账号状态
        Route::get('/account-status', ['as' => 'api-applicant-account-status', 'uses' => 'ApplicantController@accountStatus'])->middleware('HasToken');
    });

    //网上党校--院级积极分子培训
    Route::group(['prefix' => 'academy', 'namespace' => 'Api'], function (){
        //课程学习--所有课程
        Route::get('/course', ['as' => 'api-academy-all-course', 'uses' => 'AcademyController@allCourse'])->middleware('HasToken');
        //课程详情
        Route::get('/{test_id}/course-detail', ['as' => 'api-academy-course-detail', 'uses' => 'AcademyController@courseDetail']);
        //考试报名
        Route::get('/sign', ['as' => 'api-academy-sign-page', 'uses' => 'AcademyController@signPage'])->middleware('HasToken');
        Route::post('/sign', ['as' => 'api-academy-sign', 'uses' => 'AcademyController@sign'])->middleware('HasToken');
        //我的报名表(报名详情)
        Route::get('/sign-detail', ['as' => 'api-academy-sign-detail', 'uses' => 'AcademyController@signDetail'])->middleware('HasToken');
        //退出报名
        Route::get('/{entry_id}/sign-exit', ['as' => 'api-academy-sign-exit', 'uses' => 'AcademyController@signExit'])->middleware('HasToken');
        //成绩查询
        Route::get('/grade-check', ['as' => 'api-academy-grade=check', 'uses' => 'AcademyController@gradeCheck'])->middleware('HasToken');
        //申诉
        Route::get('/{test_id}/complain', ['as' => 'api-academy-complain-page', 'uses' => 'AcademyController@complainPage'])->middleware('HasToken');
        Route::post('/{test_id}/complain', ['as' => 'api-academy-complain', 'uses' => 'AcademyController@complain'])->middleware('HasToken');
        //证书查询
        Route::get('/certificate-check', ['as' => 'api-academy-certificate-check', 'uses' => 'AcademyController@certificateCheck'])->middleware('HasToken');
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

