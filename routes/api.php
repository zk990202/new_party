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
        //课程学习
        Route::get('/course', ['as' => 'api-applicant-all-course', 'uses' => 'ApplicantController@allCourse']);
        //课程对应的几篇文章
        Route::get('/{id}/course', ['as' => 'api-applicant-course', 'uses' => 'ApplicantController@course']);
        //文章详情
        Route::get('/{id}/article', ['api-applicant-article', 'uses' => 'ApplicantController@article']);
        //课程对应的题目
        Route::get('/{id}/exercise', ['api-applicant-exercise-page', 'uses' => 'ApplicantController@exercisePage']);
        Route::post('{id}/exercise', ['api-applicant-exercise', 'uses' => 'ApplicantController@exercise']);
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

