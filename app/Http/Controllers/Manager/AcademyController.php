<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/9/5
 * Time: 14:48
 */

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Resources;
use App\Models\Academy\EntryForm;
use App\Models\Academy\TestList;
use App\Models\Cert;
use App\Models\College;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class AcademyController extends Controller {

    //-------------------------------------以下是总培训控制部分-----------------------------------------------------------
    /**
     * 总培训列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trainList(){
        $trains = TestList::getAllTrain();
        return view('Manager.Academy.Train.list', ['trains' => $trains]);
    }

    /**
     * 关闭总培训
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainClose($id){
        $train = TestList::findOrFail($id);
        $train->test_status = 1;
        $train->save();
        TestList::closeTest($id);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function trainAddPage(){
        return view('Manager.Academy.Train.add');
    }

    /**
     * 总培训添加
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainAdd(Request $request){
        //如果上一期还有院级培训没有结束,是不能添加的
        $isOver = DB::table('twt_academy_testlist')
            ->where('test_parent', 0)
            ->where('test_status', 0)
            ->where('test_isdeleted', 0)
            ->get()->all();
        // $isOver有数据代表上一培训还未结束
        if ($isOver){
            return response()->json([
                'message' => '不好意思,上一期总培训没有结束,不能添加新一期的培训!'
            ]);
        }
        else{
            $name = $request->input('name');
            $time = $request->input('time');
            $res = TestList::addTrain($name, $time);
            if ($res){
                return response()->json([
                    'success' => true,
                ]);
            }
            else{
                return response()->json([
                    'message' => '添加失败'
                ]);
            }
        }
    }

    /**
     * 获取最近一期的test_id
     * @return mixed
     */
    public function getLatestTrain(){
        $trains = TestList::getAllTrain();
        $latest_test_id = $trains[0]['id'];
        return $latest_test_id;
    }

    //------------------------------------以下是子培训控制部分------------------------------------------------------------
    /**
     * 子培训列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function testList(){
        $tests = TestList::getAllTest();
        return view('Manager.Academy.Test.list', ['tests' => $tests]);
    }

    /**
     * 子培训详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function testDetail($id){
        $test = TestList::TestDetail($id);
        return view('Manager.Academy.Test.detail', ['test' => $test]);
    }

    /**
     * 删除子培训
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function testDelete($id){
        //先要查看一下该培训是否已经开始.如果已经开始,不允许删除操作
        $test = DB::table('twt_academy_testlist')
            ->where('test_id', $id)
            ->get()->toArray();
        //还有一种情况就是现在还没有人报名该考试,也是可以删除的
        $entry = DB::table('twt_academy_entryform')
            ->where('test_id', $id)
            ->get()->toArray();
        if(!$test[0]->test_status && !count($entry)){
            $test = TestList::findOrFail($id);
            $test->test_isdeleted = 1;
            $res = $test->save();
            if($res){
                return response()->json([
                    'success' => true
                ]);
            }
            else{
                return response()->json([
                    'message' => '删除失败，未知错误，请联系后台管理员'
                ]);
            }
        }
        else{
            return response()->json([
                'message' => '删除失败，该期培训可能开启或者已经有学生报名'
            ]);
        }
    }

    /**
     * 改变培训状态
     * @param $id
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function testChange($id, $status){
        $test = TestList::findOrFail($id);
        $test->test_status = $status;
        $res = $test->save();
        if ($res){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => '操作失败，请联系后台管理员'
            ]);
        }
    }

    /**
     * 子培训编辑页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function testEditPage($id){
        $test = TestList::TestDetail($id);
        return view('Manager.Academy.Test.edit', ['test' => $test]);
    }

    /**
     * 子培训编辑的后台操作
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function testEdit(Request $request, $id){
        $name = $request->input('name');
        $time = $request->input('time');
        $introduction = $request->input('introduction');
        $attention = $request->input('attention');
        try{
            $res = TestList::TestEdit($id, [
                'name' => $name,
                'time' => $time,
                'introduction' => $introduction,
                'attention' => $attention
            ]);
            if ($res){
                return response()->json([
                    'success' => true,
                    'info' => $res
                ]);
            }else{
                return response()->json([
                    'message' => '更新失败，请联系后台管理员'
                ]);
            }
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'id有误，未找到'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => '更新失败'
            ]);
        }
    }

    /**
     * 子培训添加页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function TestAddPage(){
        //获取的数据第一条为当前开启的总培训
        $train = TestList::getAllTrain();
        $colleges = College::getAll();
        return view('Manager.Academy.Test.add', ['train' => $train, 'colleges' => $colleges]);
    }

    /**
     * 子培训添加后台功能
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function TestAdd(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $parent = $request->input('parent');
        $academyId = $request->input('academyId');
        $time = $request->input('time');
        $introduction = $request->input('introduction');
        $attention = $request->input('attention');
        if(!$name || !$time){
            return response()->json([
                'message' => '参数丢失'
            ]);
        }
        $res = TestList::TestAdd([
            'id' => $id,
            'name' => $name,
            'parent' => $parent,
            'academyId' => $academyId,
            'time' => $time,
            'introduction' => $introduction,
            'attention' => $attention
        ]);
        if ($res){
            return response()->json([
                'success' => true,
                'info' => $res
            ]);
        }
        return response()->json([
            'message' => '添加失败，请联系后台管理员'
        ]);
    }

    public function getTestById($id){
        try{
            $test = TestList::findOrFail($id);
            return response()->json([
                'success' => true,
                'info' => Resources::AcademyTestList($test)
            ]);
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'Test Not Found'
            ]);
        }
    }

    //----------------------------------以下是报名情况部分----------------------------------------------
    /**
     * 最近一期报名列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signList(){
        $testId = $this->getLatestTrain();
        $entries = EntryForm::getLatest($testId);
        return view('Manager.Academy.Sign.list', ['entries' => $entries]);
    }

    /**
     * 院级补报名页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signMakeupPage(){
        $testId = $this->getLatestTrain();
        $tests = TestList::getLatestTest($testId);
        $signs = EntryForm::getLatest($testId);
        return view('Manager.Academy.Sign.makeup', ['tests' => $tests]);
    }

    /**
     * 院级补报名后台逻辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signMakeup(Request $request){
        $testId = $request->input('testId');
        $sno = $request->input('sno');
        if($testId && $sno){
            //查看申请人结业是否通过,不通过则没有报名资格
            $isPass = \App\Models\Applicant\EntryForm::makeupIsPass($sno);
            if($isPass){
                //查看是否已经报名..这里的报名包括退选的名单
                $isEntry = EntryForm::makeupIsEntry($sno, $testId);
                if(!$isEntry){
                    $res = EntryForm::makeup($sno, $testId);
                    if ($res){
                        return response()->json([
                            'success' => true
                        ]);
                    }else{
                        return response()->json([
                            'message' => '补考报名失败，请联系后台管理员'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '不好意思，该同学已经参加过本期考试的报名了！'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '不好意思,该同学不符合报名条件,申请人结业考试没有通过,请先去参加申请人结业考试!'
                ]);
            }
        }else{
            return response()->json([
                'message' => '请录入学号，或选择考试期数'
            ]);
        }
    }

    //----------------------------------以下是成绩录入部分---------------------------------------------
    /**
     * 成绩录入页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gradeInputPage(){
        $test = TestList::gradeInput();
        $entries = array();
        for ($i = 0; $i < count($test); $i++){
            $testId = $test[$i]['id'];
            $entries[$i] = EntryForm::gradeInput($testId);
        }
        $count = count($test);
//        dd($entries);
        return view('Manager.Academy.GradeInput.gradeInput', ['entries' => $entries, 'count' => $count]);
    }

    /**
     * 成绩录入后台逻辑
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gradeInput(Request $request){
        $id = $request->input('id');
//        dd($id);
        $sno = $request->input('sno');
        $practiceGrade = $request->input('practiceGrade');
        $articleGrade = $request->input('articleGrade');
        $testGrade = $request->input('testGrade');
        $testId = $request->input('testId');
        for ($i = 0; $i < count($id); $i++){
            EntryForm::gradeInputUpdate($i, $id, $practiceGrade, $articleGrade, $testGrade);
        }
        return view('Manager.Academy.GradeInput.result');
    }

    //----------------------------------以下是结业成绩查询部分------------------------------------------
    /**
     * 成绩筛选页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gradeListPage(){
        $tests = TestList::getAllTest();
        return view('Manager.Academy.Grade.listPage', ['tests' => $tests]);
    }

    /**
     * 筛选结果
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gradeList(Request $request){
        $testId = $request->input('testId');
        $grades = EntryForm::getGrade($testId);
        return view('Manager.Academy.Grade.list', ['grades' => $grades]);
    }

    //---------------------------------以下是证书管理部分------------------------------------------------
    /**
     * 证书筛选界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function certificateListPage(){
        $tests = TestList::getAllTest();
        return view('Manager.Academy.Certificate.listPage', ['tests' => $tests]);
    }

    /**
     * 筛选结果
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function certificateList(Request $request){
        $testId = $request->input('testId');
        $max = EntryForm::getMaxEntryId($testId);
        $min = EntryForm::getMinEntryId($testId);
        $certs = Cert::getCertAcademy($max, $min);
        return view('Manager.Academy.Certificate.list', ['certificates' => $certs]);
    }
}