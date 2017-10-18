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
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 101,
            'parent_id' => 1,
            'name'      => '登陆',
            'route_id'  => 28
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 102,
            'parent_id' => 1,
            'name'      => '20课',
            'route'     => "manager-party-build-list"
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 103,
            'parent_id' => 1,
            'name'      => '申请人结业',
            'route_id'  => 32
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 104,
            'parent_id' => 1,
            'name'      => '积极分子结业',
            'route_id'  => 34
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 105,
            'parent_id' => 1,
            'name'      => '支部统计',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 106,
            'parent_id' => 105,
            'name'      => '学院',
            'route_id'  => 36,
            'url'       => 'manager/statistics/party-branch-page/1'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 107,
            'parent_id' => 105,
            'name'      => '年级',
            'route_id'  => 36,
            'url'       => 'manager/statistics/party-branch-page/2'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 108,
            'parent_id' => 105,
            'name'      => '类型',
            'route_id'  => 36,
            'url'       => 'manager/statistics/party-branch-page/3'
        ]);

        /**
         * 通知公告管理 父模块2 ，子模块 121 - 140
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 2,
            'parent_id' => 0,
            'name'      => '通知公告管理',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 121,
            'parent_id' => 2,
            'name'      => '党校公告',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 122,
            'parent_id' => 121,
            'name'      => '申请人党校',
            'route_id'  => 38,
            'url'       => 'manager/notice/party-school/list/70'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 123,
            'parent_id' => 121,
            'name'      => '积极分子党校',
            'route_id'  => 38,
            'url'       => 'manager/notice/party-school/list/71'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 124,
            'parent_id' => 121,
            'name'      => '预备党员党校',
            'route_id'  => 38,
            'url'       => 'manager/notice/party-school/list/72'

        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 125,
            'parent_id' => 121,
            'name'      => '党支部书记培训',
            'route_id'  => 38,
            'url'       => 'manager/notice/party-school/list/73'

        ]);

        DB::table('twt_manager_modules')->insert([
            'self_id'   => 126,
            'parent_id' => 2,
            'name'      => '发布公告',
            'route_id'  => 44
        ]);

        DB::table('twt_manager_modules')->insert([
            'self_id'   => 127,
            'parent_id' => 2,
            'name'      => '活动通知',
            'route_id'  => 46
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 128,
            'parent_id' => 2,
            'name'      => '发布通知',
            'route_id'  => 51,
        ]);

        /**
         * 栏目管理 父模块3 ，子模块 141 - 150
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 3,
            'parent_id' => 0,
            'name'      => '栏目管理',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 141,
            'parent_id' => 3,
            'name'      => '栏目添加',
            'url'       => 'undefined'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 142,
            'parent_id' => 3,
            'name'      => '栏目列表',
            'url'       => 'undefined'
        ]);

        /**
         * 党建专项 父模块4 ，子模块 151 - 160
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 4,
            'parent_id' => 0,
            'name'      => '党建专项',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 151,
            'parent_id' => 4,
            'name'      => '新闻列表',
            'route_id'  => 1,
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 152,
//            'parent_id' => 4,
//            'name'      => '推荐列表',
//            
//            'url'       => 'undefined'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 153,
            'parent_id' => 4,
            'name'      => '添加新闻',
            'route_id'  => 6,
        ]);

        /**
         * 学习小组 父模块5 ，子模块 161-170
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 5,
            'parent_id' => 0,
            'name'      => '学习小组',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 161,
            'parent_id' => 5,
            'name'      => '新闻列表',
            'route_id'  => 8,
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 162,
//            'parent_id' => 5,
//            'name'      => '推荐列表',
//            
//            'url'       => 'undefined'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 163,
            'parent_id' => 5,
            'name'      => '添加新闻',
            'route_id'  => 13,
        ]);

        /**
         * 党校培训 父模块6 ，子模块 171-180
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 6,
            'parent_id' => 0,
            'name'      => '党校培训',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 171,
            'parent_id' => 6,
            'name'      => '新闻列表',
            'route_id'  => 15,
            'url'       => 'manager/party-school/list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 172,
//            'parent_id' => 6,
//            'name'      => '推荐列表',
//            
//            'url'       => 'undefined'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 173,
            'parent_id' => 6,
            'name'      => '添加新闻',
            'route_id'  => 13,
        ]);

        /**
         * 重要文件 父模块7 ，子模块 181-190
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 7,
            'parent_id' => 0,
            'name'      => '重要文件',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 181,
            'parent_id' => 7,
            'name'      => '文件列表',
            'route_id'  => 22,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 182,
            'parent_id' => 7,
            'name'      => '文件添加',
            'route_id'  => 20,
        ]);

        /**
         * 理论学习 父模块8 ，子模块 191-200
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 8,
            'parent_id' => 0,
            'name'      => '理论学习',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 191,
            'parent_id' => 8,
            'name'      => '内容列表',
            'url'       => 'manager/theory-study/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 192,
            'parent_id' => 8,
            'name'      => '视频添加',
            'url'       => 'manager/theory-study/add/video'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 193,
            'parent_id' => 8,
            'name'      => '文章添加',
            'url'       => 'manager/theory-study/add/article'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 194,
            'parent_id' => 8,
            'name'      => '电子书添加',
            'url'       => 'manager/theory-study/add/eBook'
        ]);

        /**
         * 消息管理 父模块9， 子模块201-210
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 9,
            'parent_id' => 0,
            'name'      => '消息管理',
        ]);

        /**
         * 权限控制 父模块10 ，子模块 211-220
         */

        DB::table('twt_manager_modules')->insert([
            'self_id'   => 10,
            'parent_id' => 0,
            'name'      => '权限管理',
        ]);

        DB::table('twt_manager_modules')->insert([
            'self_id'   => 211,
            'parent_id' => 10,
            'name'      => '角色控制',
            'route_id'  => 55,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 201,
            'parent_id' => 9,
            'name'      => '收信箱',
            'auth'      => 1,
            'url'       => 'manager/'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 202,
            'parent_id' => 9,
            'name'      => '发信箱',
            'auth'      => 1,
            'url'       => 'manager/'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 203,
            'parent_id' => 9,
            'name'      => '写信',
            'auth'      => 1,
            'url'       => 'manager/'
        ]);

        /**
         * 申请人培训 父模块10， 子模块211-240
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 10,
            'parent_id' => 0,
            'name'      => '申请人培训',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 211,
            'parent_id' => 10,
            'name'      => '课程设置',
            'auth'      => 1,
            'url'       => 'manager/applicant/course'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 212,
            'parent_id' => 10,
            'name'      => '文章设置',
            'auth'      => 1,
            'url'       => 'manager/applicant/article'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 213,
            'parent_id' => 10,
            'name'      => '题目管理',
            'auth'      => 1,
            'url'       => 'manager/applicant/exercise'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 214,
            'parent_id' => 10,
            'name'      => '考试控制',
            'auth'      => 1,
            'url'       => 'manager/applicant/exam'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 215,
            'parent_id' => 10,
            'name'      => '报名情况',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 216,
            'parent_id' => 215,
            'name'      => '报名列表',
            'auth'      => 1,
            'url'       => 'manager/applicant/sign/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 217,
            'parent_id' => 215,
            'name'      => '退考人员',
            'auth'      => 1,
            'url'       => 'manager/applicant/sign/exit'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 218,
            'parent_id' => 215,
            'name'      => '补考报名',
            'auth'      => 1,
            'url'       => 'manager/applicant/sign/makeup'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 219,
            'parent_id' => 10,
            'name'      => '成绩录入',
            'auth'      => 1,
            'url'       => 'manager/applicant/grade-input'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 220,
            'parent_id' => 10,
            'name'      => '结业成绩查询',
            'auth'      => 1,
            'url'       => 'manager/applicant/grade-list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 221,
//            'parent_id' => 10,
//            'name'      => '成绩统计',
//            'auth'      => 1,
//            'url'       => 'manager/applicant/grade-count'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 222,
            'parent_id' => 10,
            'name'      => '证书管理',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 223,
            'parent_id' => 222,
            'name'      => '发放详情',
            'auth'      => 1,
            'url'       => 'manager/applicant/certificate/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 224,
            'parent_id' => 222,
            'name'      => '证书发放',
            'auth'      => 1,
            'url'       => 'manager/applicant/certificate/grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 225,
            'parent_id' => 222,
            'name'      => '证书补发',
            'auth'      => 1,
            'url'       => 'manager/applicant/certificate/last-grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 226,
            'parent_id' => 10,
            'name'      => '申诉管理',
            'auth'      => 1,
            'url'       => 'manager/applicant/complain'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 227,
            'parent_id' => 10,
            'name'      => '作弊+违纪',
            'auth'      => 1,
            'url'       => 'manager/applicant/cheat'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 228,
            'parent_id' => 10,
            'name'      => '被锁人员名单',
            'auth'      => 1,
            'url'       => 'manager/applicant/locked'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 229,
            'parent_id' => 10,
            'name'      => '20被清名单',
            'auth'      => 1,
            'url'       => 'manager/applicant/clear20'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 230,
//            'parent_id' => 10,
//            'name'      => '20课成绩查询',
//            'auth'      => 1,
//            'url'       => 'manager/applicant/grade20'
//        ]);

        /**
         * 院级积极分子培训  父模块11， 子模块241-270
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 11,
            'parent_id' => 0,
            'name'      => '院级积极分子培训',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 241,
            'parent_id' => 11,
            'name'      => '总培训控制',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 242,
            'parent_id' => 241,
            'name'      => '总培训列表',
            'auth'      => 1,
            'url'       => 'manager/academy/train-list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 243,
            'parent_id' => 241,
            'name'      => '添加总培训',
            'auth'      => 1,
            'url'       => 'manager/academy/train-list/add'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 244,
            'parent_id' => 11,
            'name'      => '子培训控制',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 245,
            'parent_id' => 244,
            'name'      => '子培训列表',
            'auth'      => 1,
            'url'       => 'manager/academy/test-list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 246,
            'parent_id' => 244,
            'name'      => '添加子培训',
            'auth'      => 1,
            'url'       => 'manager/academy/test-list/add'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 247,
            'parent_id' => 11,
            'name'      => '报名情况',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 248,
            'parent_id' => 247,
            'name'      => '报名列表',
            'auth'      => 1,
            'url'       => 'manager/academy/sign'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 249,
            'parent_id' => 247,
            'name'      => '院级补报名',
            'auth'      => 1,
            'url'       => 'manager/academy/sign/makeup'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 250,
            'parent_id' => 11,
            'name'      => '成绩录入',
            'auth'      => 1,
            'url'       => 'manager/academy/grade-input'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 251,
            'parent_id' => 11,
            'name'      => '结业成绩',
            'auth'      => 1,
            'url'       => 'manager/academy/grade-list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 252,
            'parent_id' => 11,
            'name'      => '证书管理',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 253,
            'parent_id' => 252,
            'name'      => '发放详情',
            'auth'      => 1,
            'url'       => 'manager/academy/certificate/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 254,
            'parent_id' => 252,
            'name'      => '证书发放',
            'auth'      => 1,
            'url'       => 'manager/academy/certificate/grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 255,
            'parent_id' => 252,
            'name'      => '证书补发',
            'auth'      => 1,
            'url'       => 'manager/academy/certificate/last-grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 256,
            'parent_id' => 11,
            'name'      => '申诉管理',
            'auth'      => 1,
            'url'       => 'manager/academy/complain'
        ]);

        /**
         * 预备党员培训  父模块12， 子模块271-310
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 12,
            'parent_id' => 0,
            'name'      => '预备党员培训',
            'auth'      => 1
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 271,
            'parent_id' => 12,
            'name'      => '培训设置',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 272,
            'parent_id' => 271,
            'name'      => '培训列表',
            'auth'      => 1,
            'url'       => 'manager/probationary/train/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 273,
            'parent_id' => 271,
            'name'      => '培训添加',
            'auth'      => 1,
            'url'       => 'manager/probationary/train/add'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 274,
            'parent_id' => 12,
            'name'      => '课程管理',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 275,
            'parent_id' => 274,
            'name'      => '课程列表',
            'auth'      => 1,
            'url'       => 'manager/probationary/course/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 276,
            'parent_id' => 274,
            'name'      => '添加必修课',
            'auth'      => 1,
            'url'       => 'manager/probationary/course/add/compulsory'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 277,
            'parent_id' => 274,
            'name'      => '添加选修课',
            'auth'      => 1,
            'url'       => 'manager/probationary/course/add/elective'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 278,
            'parent_id' => 12,
            'name'      => '报名管理',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 279,
            'parent_id' => 278,
            'name'      => '报名列表',
            'auth'      => 1,
            'url'       => 'manager/probationary/sign/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 280,
            'parent_id' => 278,
            'name'      => '退报名名单',
            'auth'      => 1,
            'url'       => 'manager/probationary/sign/exit-list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 281,
//            'parent_id' => 278,
//            'name'      => '选课查询',
//            'auth'      => 1,
//            'url'       => 'manager/probationary/sign/choose-course'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 282,
            'parent_id' => 278,
            'name'      => '后台补报名',
            'auth'      => 1,
            'url'       => 'manager/probationary/sign/makeup-sign'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 283,
//            'parent_id' => 278,
//            'name'      => '后台补选课',
//            'auth'      => 1,
//            'url'       => 'manager/probationary/sign/makeup-course'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 284,
            'parent_id' => 12,
            'name'      => '选课管理',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 285,
            'parent_id' => 284,
            'name'      => '选课列表',
            'auth'      => 1,
            'url'       => 'manager/probationary/choose-course/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 286,
            'parent_id' => 284,
            'name'      => '补选课',
            'auth'      => 1,
            'url'       => 'manager/probationary/choose-course/makeup'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 287,
            'parent_id' => 12,
            'name'      => '课程成绩录入',
            'auth'      => 1,
            'url'       => 'manager/probationary/course-gradeInput'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 289,
            'parent_id' => 12,
            'name'      => '结业成绩',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 290,
            'parent_id' => 289,
            'name'      => '结业成绩录入',
            'auth'      => 1,
            'url'       => 'manager/probationary/graduation/input'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 291,
            'parent_id' => 289,
            'name'      => '结业成绩调整',
            'auth'      => 1,
            'url'       => 'manager/probationary/graduation/change'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 292,
            'parent_id' => 12,
            'name'      => '成绩查询',
            'auth'      => 1,
            'url'       => 'manager/probationary/grade-search'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 293,
            'parent_id' => 12,
            'name'      => '证书管理',
            'auth'      => 1,
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 294,
            'parent_id' => 293,
            'name'      => '发放详情',
            'auth'      => 1,
            'url'       => 'manager/probationary/certificate/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 296,
            'parent_id' => 293,
            'name'      => '证书发放',
            'auth'      => 1,
            'url'       => 'manager/probationary/certificate/grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 297,
            'parent_id' => 293,
            'name'      => '证书补发',
            'auth'      => 1,
            'url'       => 'manager/probationary/certificate/last-grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 298,
            'parent_id' => 12,
            'name'      => '申诉管理',
            'auth'      => 1,
            'url'       => 'manager/probationary/complain'
        ]);
    }
}