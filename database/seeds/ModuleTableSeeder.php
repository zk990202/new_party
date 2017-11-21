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
            'route'     => '#'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 101,
            'parent_id' => 1,
            'name'      => '登陆',
            'route'     => 'manager-statistics-login-page',
            'url'       => 'manager/statistics/loginPage'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 102,
            'parent_id' => 1,
            'name'      => '20课',
            'route'      => 'manager-statistics-twenty-lessons-page',
            'url'       => 'manager/statistics/twentyLessonsPage'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 103,
            'parent_id' => 1,
            'name'      => '申请人结业',
            'route'      => 'manager-statistics-applicant-test-list-page',
            'url'       => 'manager/statistics/applicantTestListPage'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 104,
            'parent_id' => 1,
            'name'      => '积极分子结业',
            'route'      => 'manager-statistics-academy-test-list-page',
            'url'       => 'manager/statistics/academyTestListPage'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 105,
            'parent_id' => 1,
            'name'      => '支部统计',
            'route'      => '#'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 106,
            'parent_id' => 105,
            'name'      => '学院',
            'route'      => 'manager-statistics-party-branch-page-1',
            'url'       => 'manager/statistics/partyBranchPage/1'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 107,
            'parent_id' => 105,
            'name'      => '年级',
            'route'      => 'manager-statistics-party-branch-page-2',
            'url'       => 'manager/statistics/partyBranchPage/2'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 108,
            'parent_id' => 105,
            'name'      => '类型',
            'route'      => 'manager-statistics-party-branch-page-3',
            'url'       => 'manager/statistics/partyBranchPage/3'
        ]);

        /**
         * 通知公告管理 父模块2 ，子模块 121 - 140
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 2,
            'parent_id' => 0,
            'name'      => '通知公告管理',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 121,
            'parent_id' => 2,
            'name'      => '党校公告',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 122,
            'parent_id' => 121,
            'name'      => '申请人党校',
            'route'      => 'manager-notice-party-school-list-applicant',
            'url'       => 'manager/notice/party-school/list/70'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 123,
            'parent_id' => 121,
            'name'      => '积极分子党校',
            'route'      => 'manager-notice-party-school-list-academy',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 124,
            'parent_id' => 121,
            'name'      => '预备党员党校',
            'route'      => 'manager-notice-party-school-list-probationary',
            'url'       => 'manager/notice/party-school/list/72'

        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 125,
            'parent_id' => 121,
            'name'      => '党支部书记培训',
            'route'      => 'manager-notice-party-school-list-secretary',
            'url'       => 'manager/notice/party-school/list/73'

        ]);

        DB::table('twt_manager_modules')->insert([
            'self_id'   => 126,
            'parent_id' => 2,
            'name'      => '发布公告',
            'route'      => 'manager-notice-add-page',
            'url'       => 'manager/notice/add'
        ]);

        DB::table('twt_manager_modules')->insert([
            'self_id'   => 127,
            'parent_id' => 2,
            'name'      => '活动通知',
            'route'      => 'manager-notice-activity-list',
            'url'       => 'manager/notice/activity/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 128,
            'parent_id' => 2,
            'name'      => '发布通知',
            'route'      => 'manager-notice-activity-add-page',
            'url'       => 'manager/notice/activity/add'
        ]);

        /**
         * 栏目管理 父模块3 ，子模块 141 - 150
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 3,
            'parent_id' => 0,
            'name'      => '栏目管理',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 141,
            'parent_id' => 3,
            'name'      => '栏目添加',
            'route'      => '#',
            'url'       => 'undefined'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 142,
            'parent_id' => 3,
            'name'      => '栏目列表',
            'route'      => '#',
            'url'       => 'undefined'
        ]);

        /**
         * 党建专项 父模块4 ，子模块 151 - 160
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 4,
            'parent_id' => 0,
            'name'      => '党建专项',
            'route'     => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 151,
            'parent_id' => 4,
            'name'      => '新闻列表',
            'route'     => 'manager-party-build-list',
            'url'       => 'manager/party-build/list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 152,
//            'parent_id' => 4,
//            'name'      => '推荐列表',
//            'route'      => 1,
//            'url'       => 'undefined'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 153,
            'parent_id' => 4,
            'name'      => '添加新闻',
            'route'      => 'manager-party-build-add-page',
            'url'       => 'manager/party-build/add'
        ]);

        /**
         * 学习小组 父模块5 ，子模块 161-170
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 5,
            'parent_id' => 0,
            'name'      => '学习小组',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 161,
            'parent_id' => 5,
            'name'      => '新闻列表',
            'route'      => 'manager-study-group-list',
            'url'       => 'manager/study-group/list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 162,
//            'parent_id' => 5,
//            'name'      => '推荐列表',
//            'route'      => 1,
//            'url'       => 'undefined'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 163,
            'parent_id' => 5,
            'name'      => '添加新闻',
            'route'      => 'manager-study-group-add-page',
            'url'       => 'manager/study-group/add'
        ]);

        /**
         * 党校培训 父模块6 ，子模块 171-180
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 6,
            'parent_id' => 0,
            'name'      => '党校培训',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 171,
            'parent_id' => 6,
            'name'      => '新闻列表',
            'route'      => 'manager-party-school-list',
            'url'       => 'manager/party-school/list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 172,
//            'parent_id' => 6,
//            'name'      => '推荐列表',
//            'route'      => 1,
//            'url'       => 'undefined'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 173,
            'parent_id' => 6,
            'name'      => '添加新闻',
            'route'      => 'manager-party-school-add-page',
            'url'       => 'manager/party-school/add'
        ]);

        /**
         * 重要文件 父模块7 ，子模块 181-190
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 7,
            'parent_id' => 0,
            'name'      => '重要文件',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 181,
            'parent_id' => 7,
            'name'      => '文件列表',
            'route'      => 'manager-important-files-list',
            'url'       => 'manager/important-files/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 182,
            'parent_id' => 7,
            'name'      => '文件添加',
            'route'      => 'manager-important-files-add-page',
            'url'       => 'manager/important-files/add'
        ]);

        /**
         * 理论学习 父模块8 ，子模块 191-200
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 8,
            'parent_id' => 0,
            'name'      => '理论学习',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 191,
            'parent_id' => 8,
            'name'      => '内容列表',
            'route'      => 'manager-theory-study-list',
            'url'       => 'manager/theory-study/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 192,
            'parent_id' => 8,
            'name'      => '视频添加',
            'route'      => 'manager-theory-study-add-video-page',
            'url'       => 'manager/theory-study/add/video'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 193,
            'parent_id' => 8,
            'name'      => '文章添加',
            'route'      => 'manager-theory-study-add-article-page',
            'url'       => 'manager/theory-study/add/article'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 194,
            'parent_id' => 8,
            'name'      => '电子书添加',
            'route'      => 'manager-theory-study-eBook-page',
            'url'       => 'manager/theory-study/add/eBook'
        ]);

        /**
         * 消息管理 父模块9， 子模块201-210
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 9,
            'parent_id' => 0,
            'name'      => '消息管理',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 201,
            'parent_id' => 9,
            'name'      => '收信箱',
            'route'      => 'manager-message-receive',
            'url'       => 'manager/message/receive'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 202,
            'parent_id' => 9,
            'name'      => '发信箱',
            'route'      => 'manager-message-send',
            'url'       => 'manager/message/send'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 203,
            'parent_id' => 9,
            'name'      => '写信',
            'route'      => 'manager-message-write-page',
            'url'       => 'manager/message/write'
        ]);

        /**
         * 申请人培训 父模块10， 子模块211-240
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 10,
            'parent_id' => 0,
            'name'      => '申请人培训',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 211,
            'parent_id' => 10,
            'name'      => '课程设置',
            'route'      => 'manager-applicant-course-list',
            'url'       => 'manager/applicant/course'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 212,
            'parent_id' => 10,
            'name'      => '文章设置',
            'route'      => 'manager-applicant-article-list',
            'url'       => 'manager/applicant/article'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 213,
            'parent_id' => 10,
            'name'      => '题目管理',
            'route'      => 'manager-applicant-exercise-list',
            'url'       => 'manager/applicant/exercise'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 214,
            'parent_id' => 10,
            'name'      => '考试控制',
            'route'      => 'manager-applicant-exam-list',
            'url'       => 'manager/applicant/exam'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 215,
            'parent_id' => 10,
            'name'      => '报名情况',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 216,
            'parent_id' => 215,
            'name'      => '报名列表',
            'route'      => 'manager-applicant-sign-list',
            'url'       => 'manager/applicant/sign/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 217,
            'parent_id' => 215,
            'name'      => '退考人员',
            'route'      => 'manager-applicant-sign-exit',
            'url'       => 'manager/applicant/sign/exit'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 218,
            'parent_id' => 215,
            'name'      => '补考报名',
            'route'      => 'manager-applicant-sign-makeup-page',
            'url'       => 'manager/applicant/sign/makeup'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 219,
            'parent_id' => 10,
            'name'      => '成绩录入',
            'route'      => 'manager-applicant-grade-input-page',
            'url'       => 'manager/applicant/grade-input'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 220,
            'parent_id' => 10,
            'name'      => '结业成绩查询',
            'route'      => 'manager-applicant-grade-list-page',
            'url'       => 'manager/applicant/grade-list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 221,
//            'parent_id' => 10,
//            'name'      => '成绩统计',
//            'route'      => 1,
//            'url'       => 'manager/applicant/grade-count'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 222,
            'parent_id' => 10,
            'name'      => '证书管理',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 223,
            'parent_id' => 222,
            'name'      => '发放详情',
            'route'      => 'manager-applicant-certificate-list-page',
            'url'       => 'manager/applicant/certificate/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 224,
            'parent_id' => 222,
            'name'      => '证书发放',
            'route'      => 'manager-applicant-certificate-grant-page',
            'url'       => 'manager/applicant/certificate/grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 225,
            'parent_id' => 222,
            'name'      => '证书补发',
            'route'      => 'manager-applicant-certificate-last-grant',
            'url'       => 'manager/applicant/certificate/last-grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 226,
            'parent_id' => 10,
            'name'      => '申诉管理',
            'route'      => 'manager-applicant-complain-list',
            'url'       => 'manager/applicant/complain'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 227,
            'parent_id' => 10,
            'name'      => '作弊+违纪',
            'route'      => 'manager-applicant-cheat-page',
            'url'       => 'manager/applicant/cheat'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 228,
            'parent_id' => 10,
            'name'      => '被锁人员名单',
            'route'      => 'manager-applicant-locked',
            'url'       => 'manager/applicant/locked'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 229,
            'parent_id' => 10,
            'name'      => '20被清名单',
            'route'      => 'manager-applicant-clear20-page',
            'url'       => 'manager/applicant/clear20'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 230,
//            'parent_id' => 10,
//            'name'      => '20课成绩查询',
//            'route'      => 1,
//            'url'       => 'manager/applicant/grade20'
//        ]);

        /**
         * 院级积极分子培训  父模块11， 子模块241-270
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 11,
            'parent_id' => 0,
            'name'      => '院级积极分子培训',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 241,
            'parent_id' => 11,
            'name'      => '总培训控制',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 242,
            'parent_id' => 241,
            'name'      => '总培训列表',
            'route'      => 'manager-academy-train-list',
            'url'       => 'manager/academy/train-list/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 243,
            'parent_id' => 241,
            'name'      => '添加总培训',
            'route'      => 'manager-academy-train-list-add-page',
            'url'       => 'manager/academy/train-list/add'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 244,
            'parent_id' => 11,
            'name'      => '子培训控制',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 245,
            'parent_id' => 244,
            'name'      => '子培训列表',
            'route'      => 'manager-academy-test-list',
            'url'       => 'manager/academy/test-list/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 246,
            'parent_id' => 244,
            'name'      => '添加子培训',
            'route'      => 'manager-academy-test-list-add-page',
            'url'       => 'manager/academy/test-list/add'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 247,
            'parent_id' => 11,
            'name'      => '报名情况',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 248,
            'parent_id' => 247,
            'name'      => '报名列表',
            'route'      => 'manager-academy-sign',
            'url'       => 'manager/academy/sign'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 249,
            'parent_id' => 247,
            'name'      => '院级补报名',
            'route'      => 'manager-academy-sign-makeup-page',
            'url'       => 'manager/academy/sign/makeup'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 250,
            'parent_id' => 11,
            'name'      => '成绩录入',
            'route'      => 'manager-academy-grade-input-page',
            'url'       => 'manager/academy/grade-input'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 251,
            'parent_id' => 11,
            'name'      => '结业成绩',
            'route'      => 'manager-academy-grade-list-page',
            'url'       => 'manager/academy/grade-list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 252,
            'parent_id' => 11,
            'name'      => '证书管理',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 253,
            'parent_id' => 252,
            'name'      => '发放详情',
            'route'      => 'manager-academy-certificate-list-page',
            'url'       => 'manager/academy/certificate/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 254,
            'parent_id' => 252,
            'name'      => '证书发放',
            'route'      => 'manager-academy-certificate-grant-page',
            'url'       => 'manager/academy/certificate/grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 255,
            'parent_id' => 252,
            'name'      => '证书补发',
            'route'      => 'manager-academy-certificate-last-grant',
            'url'       => 'manager/academy/certificate/last-grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 256,
            'parent_id' => 11,
            'name'      => '申诉管理',
            'route'      => 'manager-academy-complain',
            'url'       => 'manager/academy/complain'
        ]);

        /**
         * 预备党员培训  父模块12， 子模块271-310
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 12,
            'parent_id' => 0,
            'name'      => '预备党员培训',
            'route'      => '#'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 271,
            'parent_id' => 12,
            'name'      => '培训设置',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 272,
            'parent_id' => 271,
            'name'      => '培训列表',
            'route'      => 'manager-probationary-train-list',
            'url'       => 'manager/probationary/train/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 273,
            'parent_id' => 271,
            'name'      => '培训添加',
            'route'      => 'manager-probationary-train-add-page',
            'url'       => 'manager/probationary/train/add'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 274,
            'parent_id' => 12,
            'name'      => '课程管理',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 275,
            'parent_id' => 274,
            'name'      => '课程列表',
            'route'      => 'manager-probationary-course-list-page',
            'url'       => 'manager/probationary/course/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 276,
            'parent_id' => 274,
            'name'      => '添加必修课',
            'route'      => 'manager-probationary-course-add-compulsory-page',
            'url'       => 'manager/probationary/course/add/compulsory'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 277,
            'parent_id' => 274,
            'name'      => '添加选修课',
            'route'      => 'manager-probationary-course-add-elective-page',
            'url'       => 'manager/probationary/course/add/elective'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 278,
            'parent_id' => 12,
            'name'      => '报名管理',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 279,
            'parent_id' => 278,
            'name'      => '报名列表',
            'route'      => 'manager-probationary-sign-list',
            'url'       => 'manager/probationary/sign/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 280,
            'parent_id' => 278,
            'name'      => '退报名名单',
            'route'      => 'manager-probationary-sign-exit-list',
            'url'       => 'manager/probationary/sign/exit-list'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 281,
//            'parent_id' => 278,
//            'name'      => '选课查询',
//            'route'      => 1,
//            'url'       => 'manager/probationary/sign/choose-course'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 282,
            'parent_id' => 278,
            'name'      => '后台补报名',
            'route'      => 'manager-probationary-sign-makeup-sign-page',
            'url'       => 'manager/probationary/sign/makeup-sign'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 283,
//            'parent_id' => 278,
//            'name'      => '后台补选课',
//            'route'      => 1,
//            'url'       => 'manager/probationary/sign/makeup-course'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 284,
            'parent_id' => 12,
            'name'      => '选课管理',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 285,
            'parent_id' => 284,
            'name'      => '选课列表',
            'route'      => 'manager-probationary-choose-course-list-page',
            'url'       => 'manager/probationary/choose-course/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 286,
            'parent_id' => 284,
            'name'      => '补选课',
            'route'      => 'manager-probationary-choose-course-makeup-page',
            'url'       => 'manager/probationary/choose-course/makeup'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 287,
            'parent_id' => 12,
            'name'      => '课程成绩录入',
            'route'      => 'manager-probationary-course-grade-input-filter-1',
            'url'       => 'manager/probationary/course-gradeInput'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 289,
            'parent_id' => 12,
            'name'      => '结业成绩',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 290,
            'parent_id' => 289,
            'name'      => '结业成绩录入',
            'route'      => 'manager-probationary-graduation-input-page',
            'url'       => 'manager/probationary/graduation/input'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 291,
            'parent_id' => 289,
            'name'      => '结业成绩调整',
            'route'      => 'manager-probationary-graduation-change-page-1',
            'url'       => 'manager/probationary/graduation/change'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 292,
            'parent_id' => 12,
            'name'      => '成绩查询',
            'route'      => 'manager-probationary-grade-search-page',
            'url'       => 'manager/probationary/grade-search'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 293,
            'parent_id' => 12,
            'name'      => '证书管理',
            'route'      => '#',
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 294,
            'parent_id' => 293,
            'name'      => '发放详情',
            'route'      => 'manager-probationary-certificate-list-page',
            'url'       => 'manager/probationary/certificate/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 296,
            'parent_id' => 293,
            'name'      => '证书发放',
            'route'      => 'manager-probationary-certificate-grant-page',
            'url'       => 'manager/probationary/certificate/grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 297,
            'parent_id' => 293,
            'name'      => '证书补发',
            'route'      => 'manager-probationary-certificate-last-grant',
            'url'       => 'manager/probationary/certificate/last-grant'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 298,
            'parent_id' => 12,
            'name'      => '申诉管理',
            'route'      => 'manager-probationary-complain',
            'url'       => 'manager/probationary/complain'
        ]);

        /**
         * 支部管理  父模块13， 子模块311-320
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 13,
            'parent_id' => 0,
            'name'      => '支部管理',
            'route'      => '#'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 311,
            'parent_id' => 13,
            'name'      => '支部列表',
            'route'     => 'manager-party-branch-list',
            'url'       => 'manager/party-branch/list'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 312,
            'parent_id' => 13,
            'name'      => '支部查询',
            'route'     => 'manager-party-branch-search-preview',
            'url'       => 'manager/party-branch/search-preview'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 313,
            'parent_id' => 13,
            'name'      => '支部组建',
            'route'     => 'manager-party-branch-add',
            'url'       => 'manager/party-branch/add'
        ]);
//        DB::table('twt_manager_modules')->insert([
//            'self_id'   => 314,
//            'parent_id' => 13,
//            'name'      => '支部统计',
//            'route'     => 'manager-party-branch-statistics',
//            'url'       => 'manager/party-branch/statistics'
//        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 315,
            'parent_id' => 13,
            'name'      => '支部隐藏',
            'route'     => 'manager-party-branch-hide-preview',
            'url'       => 'manager/party-branch/hide-preview'
        ]);

        /**
         * 学生信息管理 父模块14， 子模块321-330
         */
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 14,
            'parent_id' => 0,
            'name'      => '学生信息管理',
            'route'     => '#'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 321,
            'parent_id' => 14,
            'name'      => '状态初始化',
            'route'     => 'manager-student-info-init-preview',
            'url'       => 'manager/student-info/init-preview'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 322,
            'parent_id' => 14,
            'name'      => '初始化状态查看',
            'route'     => 'manager-student-info-init-status',
            'url'       => 'manager/student-info/init-status'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 323,
            'parent_id' => 14,
            'name'      => '状态查看',
            'route'     => 'manager-student-info-status-watch-preview',
            'url'       => 'manager/student-info/status-watch-preview'
        ]);
        DB::table('twt_manager_modules')->insert([
            'self_id'   => 324,
            'parent_id' => 14,
            'name'      => '状态微调',
            'route'     => 'manager-student-info-status-change-preview',
            'url'       => 'manager/student-info/status-change-preview'
        ]);
    }


}