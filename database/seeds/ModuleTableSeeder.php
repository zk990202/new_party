<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * 统计信息及其子模块 父模块1 ，子模块 101 - 120
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 1,
            'parent_id' => 0,
            'name'      => '统计信息',
            'auth'      => 1
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 101,
            'parent_id' => 1,
            'name'      => '登陆',
            'auth'      => 1,
            'url'       => 'manager/statistics/loginPage'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 102,
            'parent_id' => 1,
            'name'      => '20课',
            'auth'      => 1,
            'url'       => 'manager/statistics/twentyLessonsPage'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 103,
            'parent_id' => 1,
            'name'      => '申请人结业',
            'auth'      => 1,
            'url'       => 'manager/statistics/applicantTestListPage'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 104,
            'parent_id' => 1,
            'name'      => '积极分子结业',
            'auth'      => 1,
            'url'       => 'manager/statistics/academyTestListPage'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 105,
            'parent_id' => 1,
            'name'      => '支部统计',
            'auth'      => 1
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 106,
            'parent_id' => 105,
            'name'      => '学院',
            'auth'      => 1,
            'url'       => 'manager/statistics/partyBranchPage/1'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 107,
            'parent_id' => 105,
            'name'      => '年级',
            'auth'      => 1,
            'url'       => 'manager/statistics/partyBranchPage/2'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 108,
            'parent_id' => 105,
            'name'      => '类型',
            'auth'      => 1,
            'url'       => 'manager/statistics/partyBranchPage/3'
        ]);

        /**
         * 通知公告管理 父模块2 ，子模块 121 - 140
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 2,
            'parent_id' => 0,
            'name'      => '通知公告管理',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 121,
            'parent_id' => 2,
            'name'      => '党校公告',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 122,
            'parent_id' => 121,
            'name'      => '申请人党校',
            'auth'      => 1,
            'url'       => 'manager/notice/party-school/list/70'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 123,
            'parent_id' => 121,
            'name'      => '积极分子党校',
            'auth'      => 1,
            'url'       => 'manager/notice/party-school/list/71'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 124,
            'parent_id' => 121,
            'name'      => '预备党员党校',
            'auth'      => 1,
            'url'       => 'manager/notice/party-school/list/72'

        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 125,
            'parent_id' => 121,
            'name'      => '党支部书记培训',
            'auth'      => 1,
            'url'       => 'manager/notice/party-school/list/73'

        ]);

        DB::table('twt_manager_modules')->insert([
            'self_id'   => 126,
            'parent_id' => 2,
            'name'      => '发布公告',
            'auth'      => 1,
            'url'       => 'manager/notice/add'
        ]);

        DB::table('twt_manager_modules')->insert([
            'self_id'   => 127,
            'parent_id' => 2,
            'name'      => '活动通知',
            'auth'      => 1,
            'url'       => 'manager/notice/activity/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 128,
            'parent_id' => 2,
            'name'      => '发布通知',
            'auth'      => 1,
            'url'       => 'manager/notice/activity/add'
        ]);

        /**
         * 栏目管理 父模块3 ，子模块 141 - 150
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 3,
            'parent_id' => 0,
            'name'      => '栏目管理',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 141,
            'parent_id' => 3,
            'name'      => '栏目添加',
            'auth'      => 1,
            'url'       => 'undefined'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 142,
            'parent_id' => 3,
            'name'      => '栏目列表',
            'auth'      => 1,
            'url'       => 'undefined'
        ]);

        /**
         * 党建专项 父模块4 ，子模块 151 - 160
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 4,
            'parent_id' => 0,
            'name'      => '党建专项',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 151,
            'parent_id' => 4,
            'name'      => '新闻列表',
            'auth'      => 1,
            'url'       => 'manager/party-build/list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 152,
//            'parent_id' => 4,
//            'name'      => '推荐列表',
//            'auth'      => 1,
//            'url'       => 'undefined'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 153,
            'parent_id' => 4,
            'name'      => '添加新闻',
            'auth'      => 1,
            'url'       => 'manager/party-build/add'
        ]);

        /**
         * 学习小组 父模块5 ，子模块 161-170
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 5,
            'parent_id' => 0,
            'name'      => '学习小组',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 161,
            'parent_id' => 5,
            'name'      => '新闻列表',
            'auth'      => 1,
            'url'       => 'manager/study-group/list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 162,
//            'parent_id' => 5,
//            'name'      => '推荐列表',
//            'auth'      => 1,
//            'url'       => 'undefined'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 163,
            'parent_id' => 5,
            'name'      => '添加新闻',
            'auth'      => 1,
            'url'       => 'manager/study-group/add'
        ]);

        /**
         * 党校培训 父模块6 ，子模块 171-180
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 6,
            'parent_id' => 0,
            'name'      => '党校培训',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 171,
            'parent_id' => 6,
            'name'      => '新闻列表',
            'auth'      => 1,
            'url'       => 'manager/party-school/list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 172,
//            'parent_id' => 6,
//            'name'      => '推荐列表',
//            'auth'      => 1,
//            'url'       => 'undefined'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 173,
            'parent_id' => 6,
            'name'      => '添加新闻',
            'auth'      => 1,
            'url'       => 'manager/party-school/add'
        ]);

        /**
         * 重要文件 父模块7 ，子模块 181-190
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 7,
            'parent_id' => 0,
            'name'      => '重要文件',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 181,
            'parent_id' => 7,
            'name'      => '文件列表',
            'auth'      => 1,
            'url'       => 'manager/important-files/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 182,
            'parent_id' => 7,
            'name'      => '文件添加',
            'auth'      => 1,
            'url'       => 'manager/important-files/add'
        ]);

        /**
         * 理论学习 父模块8 ，子模块 191-200
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 8,
            'parent_id' => 0,
            'name'      => '理论学习',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 191,
            'parent_id' => 8,
            'name'      => '内容列表',
            'auth'      => 1,
            'url'       => 'manager/theory-study/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 192,
            'parent_id' => 8,
            'name'      => '视频添加',
            'auth'      => 1,
            'url'       => 'manager/theory-study/add/video'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 193,
            'parent_id' => 8,
            'name'      => '文章添加',
            'auth'      => 1,
            'url'       => 'manager/theory-study/add/article'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 194,
            'parent_id' => 8,
            'name'      => '电子书添加',
            'auth'      => 1,
            'url'       => 'manager/theory-study/add/eBook'
        ]);

        /**
         * 消息管理
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 9,
            'parent_id' => 0,
            'name'      => '消息管理',
            'auth'      => 1,
        ]);
    }
}