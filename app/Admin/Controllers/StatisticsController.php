<?php

namespace App\Admin\Controllers;

use App\Models\PartyBranch\PartyBranch;
use App\Models\ScoresTwenty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginCount;
use Illuminate\Support\Facades\DB;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;


class StatisticsController extends Controller
{

    public function __construct()
    {
        Admin::css('/vendor/laravel-admin/morris.js/morris.css');
        Admin::js('/vendor/laravel-admin/raphael/raphael.min.js');
        Admin::js('/vendor/laravel-admin/morris.js/morris.min.js');
    }

    /**
     * 登陆统计
     *
     */
    public function loginPage(){
        return Admin::content(function(Content $content){
            // 选填
            $content->header('填写页面头标题');

            // 选填
            $content->description('填写页面描述小标题');

            // 添加面包屑导航 since v1.5.7
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/admin'],
                ['text' => '用户管理', 'url' => '/admin/users'],
                ['text' => '编辑用户']
            );

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.Statistics.login'));
        });
//        return view('Admin.Statistics.login');
    }

    /**
     * 登录统计的api接口
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(){
        // 获取本月第一天的时间戳
        $end = strtotime(date('Y-m-01', time()));

        // 过去一周
        $start = strtotime(date("Y-m-d", time()).'-7 day');
        $count_week = LoginCount::loginCountByDay($start);

        // 上个月
        $start = strtotime(date("Y-m-d", $end).'-1 month');
        $count_month = LoginCount::loginCountByDay($start, $end);

        // 过去一年
        $start = strtotime(date('Y-m-d', $end).'-1 year');
        $count_year = LoginCount::loginCountByDay($start, $end, "month");

//        dd($count_year);
        return response()->json([
            'week' => $count_week,
            'month' => $count_month,
            'year' => $count_year
        ]);
    }

/*----------------------------------------------------------------------------------------------*/

    /**
     * 20课统计
     * @return Content
     */
    public function twentyLessonsPage(){

        return Admin::content(function (Content $content){
            // 选填
            $content->header('填写页面头标题');

            // 选填
            $content->description('填写页面描述小标题');

            // 添加面包屑导航 since v1.5.7
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/admin'],
                ['text' => '用户管理', 'url' => '/admin/users'],
                ['text' => '编辑用户']
            );

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.Statistics.twentyLessons'));
        });
        //return view('Admin.Statistics.twentyLessons');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function twentyLessons(){
        // 获取本月第一天的时间戳
        $end = strtotime(date('Y-m-01', time()));

        // 过去一周
        $start = strtotime(date("Y-m-d", time()).'-7 day');
        $count_week = ScoresTwenty::scoresTwenty($start);

        // 上个月
        $start = strtotime(date("Y-m-d", $end).'-1 month');
        $count_month = ScoresTwenty::scoresTwenty($start, $end);

        // 过去一年
        $start = strtotime(date('Y-m-d', $end).'-1 year');
        $count_year = ScoresTwenty::scoresTwenty($start, $end, "month");
      //  dd($count_week);

        return response()->json([
            'week' => $count_week,
            'month' => $count_month,
            'year' => $count_year
        ]);
    }

    /*---------------------------------------------------------------------------------------------*/

    /**
     * 申请人结业统计
     * @return Content
     */
    public function applicantTestListPage(){
        return Admin::content(function(Content $content){
            // 选填
            $content->header('填写页面头标题');

            // 选填
            $content->description('填写页面描述小标题');

            // 添加面包屑导航 since v1.5.7
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/admin'],
                ['text' => '用户管理', 'url' => '/admin/users'],
                ['text' => '编辑用户']
            );

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.Statistics.applicantTestList'));
        });

        //return view('Admin.Statistics.applicantTestList');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function applicantTestList(){
        $test = DB::table('twt_applicant_testlist')
            ->where('test_isdeleted', 0)
            ->orderBy('test_id', 'DESC')
            ->limit(10)
            ->get()->toArray();
        //dd($test);
        $res_all = array();//全部的人数
        $res_pass = array();//通过的人数
        foreach($test as $i => $v){
            $test_name = mb_substr($v->test_name, 0, 4, 'utf-8');//取字符串前9个字符

            //全部参加考试的
            $all = DB::table('twt_applicant_entryform')
                ->where('test_id', $v->test_id)
                ->where('isexit', 0)
                ->get();
            $num_all = count($all);
            $res_all[$i][0] = $test_name;
            $res_all[$i][1] = $num_all;

            //通过考试的
            $pass = DB::table('twt_applicant_entryform')
                ->where('test_id', $v->test_id)
                ->where('isexit', 0)
                ->where('entry_ispassed', '>=', 1)
                ->where('entry_ispassed', '<=', 2)
                ->get();
            $num_pass = count($pass);
            $res_pass[$i][0] = $test_name;
            $res_pass[$i][1] = $num_pass;
        }
      //  dd($res_pass);

        return response()->json([
            'res_all' => $res_all,
            'res_pass' => $res_pass
        ]);
    }

    /*---------------------------------------------------------------------------------------------------*/

    /**
     * 积极分子结业统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function academyTestListPage(Request $request){
        //默认显示最近一期（这里未完成，待会还要写表单传过来的数据）
        if($request->input('test_parent') == null){
            $test_p = DB::table('twt_academy_testlist')
                ->where('test_parent', 0)
                ->orderBy('test_id', 'DESC')
                ->first();
            $test_parent = $test_p->test_id;
        }
        else{
            $test_parent = $request->input('test_parent');
        }

        //所有期的test
        $tests = DB::table('twt_academy_testlist')
            ->where('test_parent', 0)
            ->where('test_isdeleted', 0)
            ->get();
        return view('Admin.Statistics.academyTestList', [
            'test' => $tests,
            'test_parent' => $test_parent
            ]);
    }

    public function academyTestList($type){
        //默认显示最近一期（这里未完成，待会还要写表单传过来的数据）
        if($type == 0){
            $test_p = DB::table('twt_academy_testlist')
                ->where('test_parent', 0)
                ->orderBy('test_id', 'DESC')
                ->first();
            $test_parent = $test_p->test_id;
        }
        else{
            $test_parent = $type;
        }

        //当期所有学院的test
        $test = DB::table('twt_academy_testlist')
            ->leftJoin('b_college', 'test_of_academy', '=', 'id')
            ->where('test_isdeleted', 0)
            ->where('test_parent', $test_parent)
            ->get();

        $res_all = array();//全部的人数
        $res_pass = array();//通过的人数
        foreach($test as $i => $v){
            $test_name = mb_substr($v->test_name, 0, 8, 'utf-8');//取字符串前8个字符

            //全部参加考试的
            $all = DB::table('twt_academy_entryform')
                ->where('test_id', $v->test_id)
                ->where('isexit', 0)
                ->get();
            $num_all = count($all);
            $res_all[$i][0] = $test_name;
            $res_all[$i][1] = $num_all;

            //通过考试的
            $pass = DB::table('twt_academy_entryform')
                ->where('test_id', $v->test_id)
                ->where('isexit', 0)
                ->where('entry_ispassed', '>=', 1)
                ->where('entry_ispassed', '<=', 2)
                ->get();
            $num_pass = count($pass);
            $res_pass[$i][0] = $test_name;
            $res_pass[$i][1] = $num_pass;

        }
//        dd($res_pass);
        return response()->json([
            'res_all' => $res_all,
            'res_pass' => $res_pass
        ]);
    }

    /*----------------------------------------------------------------------------------------------------*/
    /**
     * 支部统计,分别按学院、年级、类型分类
     *
     */
    public function partyBranchPage1(){
        return Admin::content(function(Content $content){
            // 选填
            $content->header('填写页面头标题');

            // 选填
            $content->description('填写页面描述小标题');

            // 添加面包屑导航 since v1.5.7
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/admin'],
                ['text' => '用户管理', 'url' => '/admin/users'],
                ['text' => '编辑用户']
            );

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.Statistics.partyBranchCollege'));
        });
        //return view('Admin.Statistics.partyBranchCollege');
    }

    public function partyBranchPage2(){
        return Admin::content(function(Content $content){
            // 选填
            $content->header('填写页面头标题');

            // 选填
            $content->description('填写页面描述小标题');

            // 添加面包屑导航 since v1.5.7
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/admin'],
                ['text' => '用户管理', 'url' => '/admin/users'],
                ['text' => '编辑用户']
            );

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.Statistics.partyBranchGrade'));
        });

        //return view('Admin.Statistics.partyBranchGrade');
    }

    public function partyBranchPage3(){
        return Admin::content(function(Content $content){
            // 选填
            $content->header('填写页面头标题');

            // 选填
            $content->description('填写页面描述小标题');

            // 添加面包屑导航 since v1.5.7
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/admin'],
                ['text' => '用户管理', 'url' => '/admin/users'],
                ['text' => '编辑用户']
            );

            // 填充页面body部分，这里可以填入任何可被渲染的对象
            $content->body(view('Admin.Statistics.partyBranchCategory'));
        });
        //return view('Admin.Statistics.partyBranchCategory');
    }

    public function partyBranch1(){
        //按照学院排列
        $college = DB::table('b_college')
            ->where('state', 'ok')
            ->where('code', '!=', 220)
            ->where('code', '>=', 201)
            ->where('code', '<=', 231)
            ->get()->toArray();
        $res_college = PartyBranch::college($college);
        //dd($res_college);
        return response()->json([
            'res_college' => $res_college
        ]);
    }

    public function partyBranch2(){
        //按照年级排列
//            $grade = DB::table('b_class')
//                ->where('grade', '!=', 0)
//                ->where('grade', '>', 2005)
//                ->orderBy('grade', 'DESC')
//                ->distinct('grade')->get()->toArray();
        $grade = DB::select('select distinct grade from b_class where grade <>0 and grade >2005 order by grade desc');
        $res_grade = PartyBranch::grade($grade);
        return response()->json([
            'res_grade' => $res_grade
        ]);
    }

    public function partyBranch3(){
        //按照类型排列
        $res_category = PartyBranch::category();
        return response()->json([
            'res_category' => $res_category
        ]);
    }

}
