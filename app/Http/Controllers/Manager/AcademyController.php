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
use App\Models\Academy\TestList;
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
}