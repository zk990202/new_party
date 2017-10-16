<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('routes')->insert([
            'group_id'  =>  2,
            'method'    =>  'get',
            'action'    =>  'list',
            'name'      =>  'manager-party-build-list',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-build-list',
                'uses'      =>  'PartyBuildController@lists'
            ]),
            'desc'      =>  '党建专项新闻列表'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  2,
            'method'    =>  'patch',
            'action'    =>  '{id}/hide',
            'name'        =>  'manager-party-build-hide',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-build-hide',
                'uses'      =>  'PartyBuildController@hide'
            ]),
            'desc'      =>  '隐藏(显示)新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  2,
            'method'    =>  'patch',
            'action'    =>  '{id}/top-up',
            'name'        =>  'manager-party-build-top-up',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-build-top-up',
                'uses'      =>  'PartyBuildController@topUp'
            ]),
            'desc'      =>  '置顶(取消置顶)新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  2,
            'method'    =>  'get',
            'action'    =>  '{id}/edit',
            'name'        =>  'manager-party-build-edit-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-build-edit-page',
                'uses'      =>  'PartyBuildController@editPage'
            ]),
            'desc'      =>  '编辑新闻展示页'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  2,
            'method'    =>  'post',
            'action'    =>  '{id}/edit',
            'name'        =>  'manager-party-build-edit',

            'url'       =>  json_encode([
                'as'        =>  'manager-party-build-edit',
                'uses'      =>  'PartyBuildController@edit'
            ]),
            'desc'      =>  '编辑新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  2,
            'method'    =>  'get',
            'action'    =>  'add',
            'name'        =>  'manager-party-build-add-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-build-add-page',
                'uses'      =>  'PartyBuildController@addPage'
            ]),
            'desc'      =>  '添加新闻页'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  2,
            'method'    =>  'post',
            'action'    =>  'add',
            'name'        =>  'manager-party-build-add-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-build-add',
                'uses'      =>  'PartyBuildController@add'
            ]),
            'desc'      =>  '添加新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  3,
            'method'    =>  'get',
            'action'    =>  'list',
            'name'        =>  'manager-study-group-list',
            'url'       =>  json_encode([
                'as'        =>  'manager-study-group-list',
                'uses'      =>  'StudyGroupController@lists'
            ]),
            'desc'      =>  '新闻列表'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  3,
            'method'    =>  'patch',
            'action'    =>  '{id}/hide',
            'name'        =>  'manager-study-group-hide',
            'url'       =>  json_encode([
                'as'        =>  'manager-study-group-hide',
                'uses'      =>  'StudyGroupController@hide'
            ]),
            'desc'      =>  '隐藏(显示)新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  3,
            'method'    =>  'patch',
            'action'    =>  '{id}/top-up',
            'name'        =>  'manager-study-group-top-up',
            'url'       =>  json_encode([
                'as'        =>  'manager-study-group-top-up',
                'uses'      =>  'StudyGroupController@topUp'
            ]),
            'desc'      =>  '置顶(取消置顶)新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  3,
            'method'    =>  'get',
            'action'    =>  '{id}/edit',
            'name'        =>  'manager-study-group-edit-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-study-group-edit-page',
                'uses'      =>  'StudyGroupController@editPage'
            ]),
            'desc'      =>  '编辑新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  3,
            'method'    =>  'post',
            'action'    =>  '{id}/edit',
            'name'        =>  'manager-study-group-edit',
            'url'       =>  json_encode([
                'as'        =>  'manager-study-group-edit',
                'uses'      =>  'StudyGroupController@edit'
            ]),
            'desc'      =>  '编辑新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  3,
            'method'    =>  'get',
            'action'    =>  'add',
            'name'        =>  'manager-study-group-add-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-study-group-add-page',
                'uses'      =>  'StudyGroupController@addPage'
            ]),
            'desc'      =>  '添加新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  3,
            'method'    =>  'post',
            'action'    =>  'add',
            'name'        =>  'manager-study-group-add',
            'url'       =>  json_encode([
                'as'        =>  'manager-study-group-add',
                'uses'      =>  'StudyGroupController@add'
            ]),
            'desc'      =>  '添加新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  4,
            'method'    =>  'get',
            'action'    =>  'list',
            'name'        =>  'manager-party-school-list',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-school-list',
                'uses'      =>  'PartySchoolController@lists'
            ]),
            'desc'      =>  '新闻列表'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  4,
            'method'    =>  'patch',
            'action'    =>  '{id}/hide',
            'name'        =>  'manager-party-school-hide',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-school-hide',
                'uses'      =>  'PartySchoolController@hide'
            ]),
            'desc'      =>  '隐藏(显示)新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  4,
            'method'    =>  'patch',
            'action'    =>  '{id}/top-up',
            'name'        =>  'manager-party-school-top-up',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-school-top-up',
                'uses'      =>  'PartySchoolController@topUp'
            ]),
            'desc'      =>  '置顶(取消置顶)新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  4,
            'method'    =>  'get',
            'action'    =>  '{id}/edit',
            'name'        =>  'manager-party-school-edit-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-school-edit-page',
                'uses'      =>  'PartySchoolController@editPage'
            ]),
            'desc'      =>  '编辑新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  4,
            'method'    =>  'post',
            'action'    =>  '{id}/edit',
            'name'        =>  'manager-party-school-edit',

            'url'       =>  json_encode([
                'as'        =>  'manager-party-school-edit',
                'uses'      =>  'PartySchoolController@edit'
            ]),
            'desc'      =>  '编辑新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  4,
            'method'    =>  'get',
            'action'    =>  'add',
            'name'        =>  'manager-party-school-add-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-school-add-page',
                'uses'      =>  'PartySchoolController@addPage'
            ]),
            'desc'      =>  '添加新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  4,
            'method'    =>  'post',
            'action'    =>  'add',
            'name'        =>  'manager-party-school-add',
            'url'       =>  json_encode([
                'as'        =>  'manager-party-school-add',
                'uses'      =>  'PartySchoolController@add'
            ]),
            'desc'      =>  '添加新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  5,
            'method'    =>  'get',
            'action'    =>  'list',
            'name'        =>  'manager-important-files-list',
            'url'       =>  json_encode([
                'as'        =>  'manager-important-files-list',
                'uses'      =>  'ImportantFilesController@lists'
            ]),
            'desc'      =>  '新闻列表'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  5,
            'method'    =>  'patch',
            'action'    =>  '{id}/hide',
            'name'        =>  'manager-important-files-hide',
            'url'       =>  json_encode([
                'as'        =>  'manager-important-files-hide',
                'uses'      =>  'ImportantFilesController@hide'
            ]),
            'desc'      =>  '隐藏(显示)'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  5,
            'method'    =>  'get',
            'action'    =>  '{id}/edit',
            'name'        =>  'manager-important-files-edit-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-important-files-edit-page',
                'uses'      =>  'ImportantFilesController@editPage'
            ]),
            'desc'      =>  '编辑新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  5,
            'method'    =>  'post',
            'action'    =>  '{id}/edit',
            'name'        =>  'manager-important-files-edit',
            'url'       =>  json_encode([
                'as'        =>  'manager-important-files-edit',
                'uses'      =>  'ImportantFilesController@edit'
            ]),
            'desc'      =>  '编辑新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  5,
            'method'    =>  'GET',
            'action'    =>  'add',
            'name'        =>  'manager-important-files-add-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-important-files-add-page',
                'uses'      =>  'ImportantFilesController@addPage'
            ]),
            'desc'      =>  '添加新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  5,
            'method'    =>  'post',
            'action'    =>  'add',
            'name'        =>  'manager-important-files-add',
            'url'       =>  json_encode([
                'as'        =>  'manager-important-files-add',
                'uses'      =>  'ImportantFilesController@add'
            ]),
            'desc'      =>  '添加新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'login-page',
            'name'        =>  'manager-statistics-login-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-login-page',
                'uses'      =>  'StatisticsController@loginPage'
            ]),
            'desc'      =>  '登陆统计'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'login',
            'name'        =>  'manager-statistics-login',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-login',
                'uses'      =>  'StatisticsController@login'
            ]),
            'desc'      =>  '登陆统计'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'twenty-lessons-page',
            'name'        =>  'manager-statistics-twenty-lessons-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-twenty-lessons-page',
                'uses'      =>  'StatisticsController@twentyLessonsPage'
            ]),
            'desc'      =>  '20课统计'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'twenty-lessons',
            'name'        =>  'manager-statistics-twenty-lessons',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-twenty-lessons',
                'uses'      =>  'StatisticsController@twentyLessons'
            ]),
            'desc'      =>  '20课统计'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'applicant-test-list-page',
            'name'        =>  'manager-statistics-applicant-test-list-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-applicant-test-list-page',
                'uses'      =>  'StatisticsController@applicantTestListPage'
            ]),
            'desc'      =>  '申请人结业统计'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'applicant-test-list',
            'name'        =>  'manager-statistics-applicant-test-list',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-applicant-test-list',
                'uses'      =>  'StatisticsController@applicantTestList'
            ]),
            'desc'      =>  '申请人结业统计'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'academy-test-list-page',
            'name'        =>  'manager-statistics-academy-test-list-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-academy-test-list-page',
                'uses'      =>  'StatisticsController@academyTestList'
            ]),
            'desc'      =>  '积极分子结业统计'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'academy-test-list/{type?}',
            'name'        =>  'manager-statistics-academy-test-list',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-academy-test-list',
                'uses'      =>  'StatisticsController@academyTestList'
            ]),
            'desc'      =>  '积极分子结业统计'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'party-branch-page/{type}',
            'name'        =>  'manager-statistics-party-branch-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-party-branch-page',
                'uses'      =>  'StatisticsController@partyBranchPage'
            ]),
            'desc'      =>  '支部统计'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  6,
            'method'    =>  'get',
            'action'    =>  'party-branch/{type}',
            'name'        =>  'manager-statistics-party-branch',
            'url'       =>  json_encode([
                'as'        =>  'manager-statistics-party-branch',
                'uses'      =>  'StatisticsController@partyBranch'
            ]),
            'desc'      =>  '支部统计'
        ]);


        DB::table('routes')->insert([
            'group_id'  =>  8,
            'method'    =>  'get',
            'action'    =>  'list/{type}',
            'name'        =>  'manager-notice-party-school',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-party-school',
                'uses'      =>  'NoticeController@partySchool'
            ]),
            'desc'      =>  '党校新闻列表'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  8,
            'method'    =>  'patch',
            'action'    =>  '{notice_id}/hide',
            'name'        =>  'manager-notice-hide',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-hide',
                'uses'      =>  'NoticeController@hide'
            ]),
            'desc'      =>  '隐藏新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  8,
            'method'    =>  'patch',
            'action'    =>  '{notice_id}/top-up',
            'name'        =>  'manager-notice-top-up',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-top-up',
                'uses'      =>  'NoticeController@topUp'
            ]),
            'desc'      =>  '置顶新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  8,
            'method'    =>  'get',
            'action'    =>  '{notice_id}/edit',
            'name'        =>  'manager-notice-edit-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-edit-page',
                'uses'      =>  'NoticeController@editPage'
            ]),
            'desc'      =>  '编辑新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  8,
            'method'    =>  'post',
            'action'    =>  '{notice_id}/edit',
            'name'        =>  'manager-notice-edit',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-edit',
                'uses'      =>  'NoticeController@edit'
            ]),
            'desc'      =>  '编辑新闻'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  8,
            'method'    =>  'get',
            'action'    =>  '{notice_id}',
            'name'        =>  'manager-notice-edit',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-get',
                'uses'      =>  'NoticeController@getNoticeById'
            ]),
            'desc'      =>  '单个公告详情'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  9,
            'method'    =>  'get',
            'action'    =>  '/',
            'name'        =>  'manager-notice-edit',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-add-page',
                'uses'      =>  'NoticeController@addPage'
            ]),
            'desc'      =>  '添加公告'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  9,
            'method'    =>  'post',
            'action'    =>  '/',
            'name'        =>  'manager-notice-add',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-add',
                'uses'      =>  'NoticeController@add'
            ]),
            'desc'      =>  '添加公告'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  10,
            'method'    =>  'get',
            'action'    =>  'list',
            'name'        =>  'manager-notice-activity-list',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-activity-list',
                'uses'      =>  'NoticeController@activity'
            ]),
            'desc'      =>  '活动通知列表'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  10,
            'method'    =>  'patch',
            'action'    =>  '{activity_id}/hide',
            'name'        =>  'manager-notice-activity-hide',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-activity-hide',
                'uses'      =>  'NoticeController@hide'
            ]),
            'desc'      =>  '隐藏活动通知'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  10,
            'method'    =>  'patch',
            'action'    =>  '{activity_id}/top-up',
            'name'        =>  'manager-notice-activity-top-up',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-activity-top-up',
                'uses'      =>  'NoticeController@topUp'
            ]),
            'desc'      =>  '置顶活动通知'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  10,
            'method'    =>  'get',
            'action'    =>  '{activity_id}/edit',
            'name'        =>  'manager-notice-activity-edit-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-activity-edit-page',
                'uses'      =>  'NoticeController@activityEditPage'
            ]),
            'desc'      =>  '编辑活动通知'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  10,
            'method'    =>  'post',
            'action'    =>  '{activity_id}/edit',
            'name'        =>  'manager-notice-activity-edit',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-activity-edit',
                'uses'      =>  'NoticeController@activityEdit'
            ]),
            'desc'      =>  '编辑活动通知'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  10,
            'method'    =>  'get',
            'action'    =>  'add',
            'name'        =>  'manager-notice-activity-add-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-activity-add-page',
                'uses'      =>  'NoticeController@activityAddPage'
            ]),
            'desc'      =>  '编辑活动通知'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  10,
            'method'    =>  'post',
            'action'    =>  'add',
            'name'        =>  'manager-notice-activity-add',
            'url'       =>  json_encode([
                'as'        =>  'manager-notice-activity-add',
                'uses'      =>  'NoticeController@activityAdd'
            ]),
            'desc'      =>  '编辑活动通知'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  11,
            'method'    =>  'post',
            'action'    =>  '/',
            'name'        =>  'manager-file-upload',
            'url'       =>  json_encode([
                'as'        =>  'manager-file-upload',
                'uses'      =>  'FileController@upload'
            ]),
            'desc'      =>  '文件上传'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  12,
            'method'    =>  'get',
            'action'    =>  'logout',
            'name'        =>  'manager-auth-logout',
            'url'       =>  json_encode([
                'as'        =>  'manager-auth-logout',
                'uses'      =>  'LoginController@logout'
            ]),
            'desc'      =>  '用户退出'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  12,
            'method'    =>  'get',
            'action'    =>  'role',
            'name'        =>  'manager-auth-role',
            'url'       =>  json_encode([
                'as'        =>  'manager-auth-role',
                'uses'      =>  'RoleController@rolePage'
            ]),
            'desc'      =>  '用户角色列表'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  13,
            'method'    =>  'get',
            'action'    =>  'login',
            'name'        =>  'manager-auth-login-page',
            'url'       =>  json_encode([
                'as'        =>  'manager-auth-login-page',
                'uses'      =>  'LoginController@loginPage'
            ]),
            'desc'      =>  '登录'
        ]);

        DB::table('routes')->insert([
            'group_id'  =>  13,
            'method'    =>  'post',
            'action'    =>  'login',
            'name'        =>  'manager-auth-login',
            'url'       =>  json_encode([
                'as'        =>  'manager-auth-login',
                'uses'      =>  'LoginController@login'
            ]),
            'desc'      =>  '登录'
        ]);

    }
}
