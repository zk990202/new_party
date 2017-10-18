<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2017/9/22
 * Time: 15:01
 */

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Resources;
use App\Models\College;
use App\Models\CommonFiles;
use App\Models\Probationary\ChildEntryForm;
use App\Models\Probationary\CourseList;
use App\Models\Probationary\EntryForm;
use App\Models\Probationary\TrainList;
use App\Models\StudentInfo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Mockery\Exception;
use phpDocumentor\Reflection\Types\Null_;

class ProbationaryController extends Controller{
    protected $fileExtension;
    protected $fileUsage = 'probationaryFile';

    public function __construct(){
        $this->fileExtension = config('fileUpload');
    }

    //-----------------------------以下是课程设置部分---------------------------------------------------
    /**
     * 培训列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trainList(){
        $trains = TrainList::getAll();
        return view('Manager.Probationary.Train.list', ['trains' => $trains]);
    }

    /**
     * 培训详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trainDetail($id){
        $train = TrainList::getOneTrain($id);
        return view('Manager.Probationary.Train.detail', ['train' => $train]);
    }

    /**
     * 编辑考试展示页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trainEditPage($id){
        $train = TrainList::getOneTrain($id);
        return view('Manager.Probationary.Train.edit', ['train' => $train[0]]);
    }

    /**
     * 编辑考试后台逻辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainEdit(Request $request, $id){
        $name = $request->input('name');
        $time = $request->input('time');
        $detail = $request->input('detail');
        $filePath = $request->input('filePath') ?? null;
        $fileName = $request->input('fileName') ?? null;
        try{
            $res = TrainList::updateById($id, [
                'name' => $name,
                'time' => $time,
                'detail' => $detail,
                'filePath' => $filePath,
                'fileName' => $fileName
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
                'message' => 'id ERROR'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Fail in updating'
            ]);
        }
    }

    /**
     * 修改状态展示页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trainStatusPage($id){
        $train = TrainList::getOneTrain($id);
        return view('Manager.Probationary.Train.status', ['train' => $train[0]]);
    }

    /**
     * 修改报名状态
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainEntryStatus($id){
        $train = TrainList::findOrFail($id);
        $train->train_entry_status = $train->train_entry_status ^ 1;
        $train->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 修改网上选课状态
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainNetChooseStatus($id){
        $train = TrainList::findOrFail($id);
        $train->train_netchoose_status = $train->train_netchoose_status ^ 1;
        $train->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 修改成绩查询状态
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainGradeSearchStatus($id){
        $train = TrainList::findOrFail($id);
        $train->train_gradesearch_status = $train->train_gradesearch_status ^ 1;
        $train->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 修改结业名单状态
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainEndListShow($id){
        $train = TrainList::findOrFail($id);
        $train->train_endlist_show = $train->train_endlist_show ^ 1;
        $train->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 修改优秀学员状态
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainGoodMemberShow($id){
        $train = TrainList::findOrFail($id);
        $train->train_goodmember_show = $train->train_goodmember_show ^ 1;
        $train->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 修改培训状态状态
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainIsEnd($id){
        $train = TrainList::findOrFail($id);
        $train->train_isend = $train->train_isend ^ 1;
        $train->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * 开始录入
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainOpen($id){
        $train = TrainList::getOneTrain($id);
        $isEndInsert = $train[0]['isEndInsert'];
//        dd($isEndInsert);
        if (!$isEndInsert){
            $train1 = TrainList::findOrFail($id);
            $train1->train_endinsert = 1;
            $train1->train_isendinsert = 1;
            $res = $train1->save();
            if ($res){
                return response()->json([
                    'success' => true
                ]);
            }else{
                return response()->json([
                    'message' => '开始录入失败请联系后台管理员'
                ]);
            }
        }else{
            return response()->json([
                'message' => '不好意思,您已经开启过一次成绩录入通道,不能再次开启'
            ]);
        }
    }

    /**
     * 结束录入
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainClose($id){
        //这里我们需要判断一下,是否还有考试处于成绩录入状态下
        $isCourseInsert = CourseList::isCourseInsert();
        if(!$isCourseInsert){
            //更新字段
            $train = TrainList::findOrFail($id);
            $train->train_endinsert = 0;
            $res = $train->save();
            if ($res){
                //判断报名是否已经退出
                $isExit = EntryForm::getByTrainId($id);
                if ($isExit){
                    //报名未退出
                    for ($i = 0; $i < count($isExit); $i++){
                        $data = $isExit[$i];
                        //判断作弊情况
                        $res1 = EntryForm::isCheat($data);
                        if ($res1){
                            return response()->json([
                                'success' => true
                            ]);
                        }else{
                            return response()->json([
                                'message' => '未知错误，请联系后台管理员'
                            ]);
                        }
                    }
                }else{
                    //报名已退出
                    return response()->json([
                        'success' => true
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '未知错误，请联系后台管理员'
                ]);
            }
        }else{
            return response()->json([
                'message' => '本系统的处理逻辑是必须先将所有课程的成绩录入才能关闭该成绩录入通道然后统计计算该学生的成绩录入状态'
            ]);
        }
    }

    /**
     * 培训添加前端页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trainAddPage(){
        return view('Manager.Probationary.Train.add');
    }

    /**
     * 培训添加后台逻辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function trainAdd(Request $request){
        $data = $request->all();
        //判断之前的培训是否结束，isEnd = 1 表示还在进行中
        $isEnd = TrainList::isEnd();
        if ($isEnd){
            return response()->json([
                'message' => '添加培训失败，之前的培训未关闭，无法开启新的培训'
            ]);
        }else{
            if (!$data['name'] || !$data['time'] || !$data['detail']){
                return response()->json([
                    'message' => '培训名称、时间及详情均不可为空'
                ]);
            }
            //判断日期时间是否为标准格式
            $unixTime = strtotime($data['time']);
            $checkDate = date('Y-m-d H:i:s', $unixTime);
            if ($checkDate != $data['time']){
                return response()->json([
                    'message' => '日期格式非法，请按照Y-m-d H:i:s格式输入,如 2017-09-01 00:00:59(月和日需补齐至两位数)'
                ]);
            }

            $res = TrainList::addTrain($data);
            if ($res){
                return response()->json([
                    'success' => true
                ]);
            }else{
                return response()->json([
                    'message' => '添加失败，请联系后台管理员'
                ]);
            }
        }
    }

    public function getTrainById($id){
        try{
            $train = TrainList::findOrFail($id);
            return response()->json([
                'success' => true,
                'info'    => Resources::ProbationaryTrainList($train)
            ]);
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'Train Not Found'
            ]);
        }
    }

    //-------------------------------以下是课程管理部分------------------------------------------
    /**
     * 课程筛选页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseListPage(){
        $trains = TrainList::getAll();
        return view('Manager.Probationary.Course.listPage', ['trains' => $trains]);
    }

    /**
     * 课程筛选结果页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseList(Request $request){
        $data = $request->all();
        $courses = CourseList::getSomeCourse($data);
        return view('Manager.Probationary.Course.list', ['courses' => $courses]);
    }

    /**
     * 必修课详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseCompulsoryDetail($id){
        $course = CourseList::getCourseById($id);
        return view('Manager.Probationary.Course.detailCompulsory', ['course' => $course[0]]);
    }

    /**
     * 选修课详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseElectiveDetail($id){
        $course = CourseList::getCourseById($id);
        return view('Manager.Probationary.Course.detailElective', ['course' => $course[0]]);
    }

    /**
     * 必修课编辑前端页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseCompulsoryEditPage($id){
        $course = CourseList::getCourseById($id);
        return view('Manager.Probationary.Course.editCompulsory', ['course' => $course[0]]);
    }

    /**
     * 必修课编辑后台逻辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseCompulsoryEdit(Request $request, $id){
        $data = $request->all();
        try{
            $res = CourseList::updateById($id, $data);
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
                'message' => 'id ERROR'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Fail in updating'
            ]);
        }
    }

    /**
     * 选修课编辑前端
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseElectiveEditPage($id){
        $course = CourseList::getCourseById($id);
        $trains = TrainList::getNotEndTrain();
        $files = CommonFiles::getAddElective();
        return view('Manager.Probationary.Course.editElective', ['course' => $course[0], 'trains' => $trains, 'files' => $files]);
    }

    /**
     * 选修课编辑后台
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseElectiveEdit(Request $request, $id){
        $data = $request->all();
        try{
            $res = CourseList::updateById($id, $data);
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
                'message' => 'id ERROR'
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Fail in updating'
            ]);
        }
    }

    /**
     * 删除考试
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseDelete($id){
        $isSomeoneChoose = ChildEntryForm::isSomeoneChoose($id);
        if (!$isSomeoneChoose) {
            $course = CourseList::findOrFail($id);
            $course->course_isdeleted = 1;
            $res = $course->save();
            if ($res) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'message' => '删除失败'
                ]);
            }
        }else{
            return response()->json([
                'message' => '该课程已有人报名，不可删除'
            ]);
        }
    }

    /**
     * 开启成绩录入
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseOpen($id){
        $course = CourseList::getCourseById($id);
        if ($course){
            if (!$course[0]['isInserted']){
                $course1 = CourseList::findOrFail($id);
                $course1->course_caninsert = 1;
                $course1->course_isinserted = 1;
                $res = $course1->save();
                if ($res){
                    return response()->json([
                        'success' => true
                    ]);
                }else{
                    return response()->json([
                        'message' => '未知错误，请联系后台管理员'
                    ]);
                }
            }
        }else{
            return response()->json([
                'message' => '操作失败，可能为找到该课程'
            ]);
        }
    }

    /**
     * 关闭成绩录入
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseClose($id){
        $course = CourseList::getCourseById($id);
        if ($course){
            $course1 = CourseList::findOrFail($id);
            $course1->course_caninsert = 0;
            $res = $course1->save();
            if ($res){
                //我们要对通过成绩的学生+1..并且数出作弊次数
                $children = ChildEntryForm::isExit($id);
                for ($i = 0; $i < count($children); $i++){
                    $child = $children[$i];
                    $help = EntryForm::aHelp($child['childId']);
                    if ($child['status'] == 2){
                        //1表示正常...2,3作弊和缺考..
                        //2表示作弊,那么在它的报名记录里加1.
                        $countCheat = EntryForm::updateCheatCount($help[0]['id']);
                    }
                    else{
                        //没有作弊,那么直接看他的成绩是否通过,若通过,则在它的报名表中加1
                        if ($child['grade'] >= 60 && !$course[0]['type']){
                            //必修课
                            $compulsory = EntryForm::updateCompulsory($help[0]['id']);
                        }
                        if ($child['grade'] >= 60 && $course[0]['type']){
                            //选修课
                            $elective = EntryForm::updateEletive($help[0]['id']);
                        }
                    }
                    return response()->json([
                        'success' => true
                    ]);
                }
            }
        }else{
            return response()->json([
                'message' => '操作失败，请重试'
            ]);
        }
    }

    /**
     * 添加必须课前端页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseAddCompulsoryPage(){
        $trains = TrainList::getNotEndTrain();
        return view('Manager.Probationary.Course.addCompulsory', ['trains' => $trains]);
    }

    /**
     * 添加必修课后台逻辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseAddCompulsory(Request $request){
        $trains = TrainList::getNotEndTrain();
        if(!$trains){
            return response()->json([
                'message' => '没有培训处于开启状态，不可添加必修课'
            ]);
        }else{
            $data = $request->all();
            if (!$data['name'] || !$data['time'] || !$data['place'] || !$data['speaker'] || !$data['limitNum']
                || !$data['introduction'] || !$data['requirement']){
                return response()->json([
                    'message' => '参数丢失，所有文本框请都不要留空'
                ]);
            } else{
                //判断日期时间是否为标准格式
                $unixTime = strtotime($data['time']);
                $checkDate = date('Y-m-d H:i:s', $unixTime);
                if ($checkDate != $data['time']){
                    return response()->json([
                        'message' => '日期格式非法，请按照Y-m-d H:i:s格式输入,如 2017-09-01 00:00:59(月和日需补齐至两位数)'
                    ]);
                }
                $res = CourseList::addCompulsory($data);
                if ($res){
                    return response()->json([
                        'success' => true
                    ]);
                }else{
                    return response()->json([
                        'message' => '添加失败'
                    ]);
                }
            }
        }

    }

    /**
     * 添加选修课前端页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseAddElectivePage(){
        $trains = TrainList::getNotEndTrain();
        $files = CommonFiles::getAddElective();
        return view('Manager.Probationary.Course.addElective', ['trains' => $trains, 'files' => $files]);
    }

    /**
     * 添加选修课后台逻辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function courseAddElective(Request $request){
        $trains = TrainList::getNotEndTrain();
        if(!$trains) {
            return response()->json([
                'message' => '没有培训处于开启状态，不可添加必修课'
            ]);
        }else{
            $data = $request->all();
            if (!$data['name'] || !$data['time'] || !$data['movieId']
                || !$data['introduction'] || !$data['requirement']){
                return response()->json([
                    'message' => '参数丢失，所有文本框请都不要留空'
                ]);
            } else{
                //判断日期时间是否为标准格式
                $unixTime = strtotime($data['time']);
                $checkDate = date('Y-m-d H:i:s', $unixTime);
                if ($checkDate != $data['time']){
                    return response()->json([
                        'message' => '日期格式非法，请按照Y-m-d H:i:s格式输入,如 2017-09-01 00:00:59(月和日需补齐至两位数)'
                    ]);
                }
                $res = CourseList::addElective($data);
                if ($res){
                    return response()->json([
                        'success' => true
                    ]);
                }else{
                    return response()->json([
                        'message' => '添加失败'
                    ]);
                }
            }
        }
    }

    public function getCourseById($id){
        try{
            $course = CourseList::findOrFail($id);
            return response()->json([
                'success' => true,
                'info' => Resources::ProbationaryCourseList($course)
            ]);
        }catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'Course Not Found'
            ]);
        }
    }


    //---------------------------------以下是报名管理部分-----------------------------------------------
    /**
     * 报名列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signList(){
        $train = TrainList::getNotEndTrain();
        $signs = array();
        if(count($train) == 1){
            $signs = EntryForm::getAllSign($train[0]['id']);
        }
        if ($train == null){
            $train = [['name' => '无']];
        }
        return view('Manager.Probationary.Sign.list', ['signs' => $signs, 'train' => $train]);
    }

    /**
     * 退报名列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signExitList(){
        $train = TrainList::getNotEndTrain();
        $signs = array();
        if(count($train) == 1){
            $signs = EntryForm::getExitSign($train[0]['id']);
        }
        if ($train == null){
            $train = [['name' => '无']];
        }
        return view('Manager.Probationary.Sign.exitList', ['signs' => $signs, 'train' => $train]);
    }

    /**
     * 恢复选课
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function signInCourseChoose($id){
        $sign = EntryForm::findOrFail($id);
        $sign->isexit = 0;
        $res = $sign->save();
        if ($res){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => '操作失败'
            ]);
        }
    }

    /**
     * 退出选课
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function signExitCourseChoose($id){
        $sign = EntryForm::findOrFail($id);
        $sign->isexit = 1;
        $res = $sign->save();
        if ($res){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => '操作失败'
            ]);
        }
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function signDelete($id){
        $sign = EntryForm::findOrFail($id);
        $sign->isdeleted = 1;
        $res = $sign->save();
        if ($res){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => '操作失败'
            ]);
        }
    }

    /**
     * 补考报名前端
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signMakeupPage(){
        $train = TrainList::getNotEndTrain();
        return view('Manager.Probationary.Sign.makeup', ['trains' => $train]);
    }

    /**
     * 补报名后台逻辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signMakeup(Request $request){
        $sno = $request->input('sno');
        $trainId = $request->input('trainId');
        $studentInfo = StudentInfo::getStudentInfo($sno);
        if ($studentInfo){
            if ($sno && $trainId){
                //判断是否通过全部课程
                $isPass = EntryForm::isAllPassed($sno);
                if (!$isPass){
                    //判断该用户是否符合要求....
                    if ($studentInfo[0]['mainStatus'] > 9 && $studentInfo[0]['mainStatus'] < 12){
                        $res = EntryForm::add($sno, $trainId);
                        if ($res){
                            return response()->json([
                                'success' => true
                            ]);
                        }else{
                            return response()->json([
                                'message' => '未知错误，请联系后台管理员'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message' => '该同学没有报名预备党员的权限'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message' => '该同学已经通过了预备党员结业考试，无需报名'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '培训期数和学号不能为空'
                ]);
            }
        }else{
            return response()->json([
                'message' => '没有找到学号所对应的学生'
            ]);
        }
    }

    //-------------------------------以下是选课管理部分------------------------------------------
    /**
     * 选课管理筛选页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chooseCourseListPage(){
        $train = TrainList::getNotEndTrain();
        $courses = CourseList::getByTrainId($train[0]['id']);
        $colleges = College::getAll();
        return view('Manager.Probationary.ChooseCourse.listPage', ['courses' => $courses, 'colleges' => $colleges]);
    }

    /**
     * 选课管理筛选结果
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chooseCourseList(Request $request){
        $train = TrainList::getNotEndTrain();
        if ($train == null){
            $train = [['name' => '无']];
        }
        $data = $request->all();
        $res = ChildEntryForm::getByCourseAndCollege($data);
        return view('Manager.Probationary.ChooseCourse.list', ['entries' => $res, 'train' => $train]);
    }

    /**
     * 恢复选课
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function chooseCourseInCourseChoose($id){
        $sign = ChildEntryForm::findOrFail($id);
        $sign->isexit = 0;
        $res = $sign->save();
        if ($res){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => '操作失败'
            ]);
        }
    }

    /**
     * 退出选课
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function chooseCourseExitCourseChoose($id){
        $sign = ChildEntryForm::findOrFail($id);
        $sign->isexit = 1;
        $res = $sign->save();
        if ($res){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => '操作失败'
            ]);
        }
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function chooseCourseDelete($id){
        $sign = ChildEntryForm::findOrFail($id);
        $sign->isdeleted = 1;
        $res = $sign->save();
        if ($res){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => '操作失败'
            ]);
        }
    }

    /**
     * 补选课页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chooseCourseMakeupPage(){
        $train = TrainList::getNotEndTrain();
        $courses = CourseList::getByTrainId($train[0]['id']);
        return view('Manager.Probationary.ChooseCourse.makeup', ['train' => $train, 'courses' => $courses]);
    }

    //补选课后台逻辑
    public function chooseCourseMakeup(Request $request){
        $train = TrainList::getNotEndTrain();
        $trainId = $train[0]['id'];
        $sno = $request->input('sno');
        $courseId = $request->input('courseId');
        if ($sno && $courseId){
            //判断是否通过全部课程
            $isPass = EntryForm::isAllPassed($sno);
            if (!$isPass){
                //查看是否已经参加过本期考试
                $isEntry = EntryForm::isEntry($sno, $trainId);
                if ($isEntry){
                    //这里需要判断一下,该课程是否已经录入成绩完毕了
                    $endCourse = CourseList::getCourseById($courseId);
                    $courseType = $endCourse[0]['type'];
                    $pass = ChildEntryForm::getBySnoAndTrainId($sno, $trainId, $courseType);

                    $left = 0;
                    $courseStr = '';
                    if ($endCourse['type']){
                        $left = 1 - $isEntry['passElective'];
                        $courseStr = '选修课';
                    }else{
                        $left = 3 - $isEntry['passCompulsory'];
                        $courseStr = '必修课';
                    }
                    if (count($endCourse) >= $left){
                        return response()->json([
                            '添加失败，该学生'.$courseStr.'已经修完'
                        ]);
                    }

                    $entryId = $isEntry[0]['id'];
                    if (!($endCourse['canInsert'] || $endCourse['isInserted'])){
                        $isChoose = ChildEntryForm::isChoose($courseId, $entryId);
                        if (!$isChoose){
                            $res = ChildEntryForm::add($sno, $entryId, $courseId);
                            if ($res){
                                //这里还有一些操作.将该用户的课程数++
                                //这里需要做一个操作..就是如果搜索到的记录大于limit人数,则limit加1
                                $rs = ChildEntryForm::getByCourseId($courseId);
                                if (count($rs) > $endCourse['limitNum'] && !$endCourse['type']){
                                    //这里是报考的人数大于限制的人数了.同时是必修课
                                    $update = CourseList::updateWhenChooseCourse($courseId, count($rs));
                                    if ($update){
                                        return response()->json([
                                            'success' => true
                                        ]);
                                    }else{
                                        return response()->json([
                                            'message' => '未知错误'
                                        ]);
                                    }
                                }
                            }else{
                                return response()->json([
                                    'message' => '补选失败，未知错误'
                                ]);
                            }
                        }else{
                            return response()->json([
                                'message' => '该同学已经选择了该课程，不可重复选课'
                            ]);
                        }
                    }

                }else{
                    return response()->json([
                        'message' => '该同学还未报名该考试！'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => '该同学已经通过了预备党员结业考试，无需再补考报名，补选课'
                ]);
            }
        }else{
            return response()->json([
                'message' => '学号和课程不能为空！'
            ]);
        }
    }

    //----------------------------以下是课程成绩录入模块-----------------------------------------
    /**
     * 课程成绩录入前对课程进行筛选
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseGradeInputPage1(){
        $train = TrainList::getNotEndTrain();
        $courses = CourseList::getByTrainId($train[0]['id']);
        return view('Manager.Probationary.CourseGradeInput.inputPage', ['train' => $train,'courses' => $courses]);
    }

    /**
     * 课程成绩录入表单显示页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseGradeInputPage(Request $request){
        $train = TrainList::getNotEndTrain();
        $courseId  = $request->input('courseId');
        $entries = ChildEntryForm::getByCourseId($courseId);
        return view('Manager.Probationary.CourseGradeInput.input', ['train' => $train ,'entries' => $entries]);
    }

    /**
     * 课程成绩录入后台逻辑
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseGradeInput(Request $request){
        $data = $request->all();
        for ($i = 0; $i < count($data['id']); $i++){
            ChildEntryForm::updateSome($data, $i);
        }
        return view('Manager.Probationary.CourseGradeInput.result');
    }

    //-----------------------以下是结业成绩模块--------------------------------------------
    /**
     * 结业成绩录入前端页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function graduationGradeInputPage(){
        $train = TrainList::getNotEndTrain();
        $entries = [];
        if ($train[0]['endInsert']){
            $entries = EntryForm::getByTrainId($train[0]['id']);
        }
        return view('Manager.Probationary.Graduation.GradeInput', ['train' => $train ,'entries' => $entries]);
    }

    /**
     * 结业成绩录入后台逻辑
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function graduationGradeInput(Request $request){
        $data = $request->all();
        for ($i = 0; $i < count($data['id']); $i++){
            EntryForm::updateGradeAndStatus($data, $i);
        }
        return view('Manager.Probationary.Graduation.GradeInputResult');
    }

    /**
     * 结业成绩调整前的学号筛选
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function graduationGradeChangePage1(){
        $train = TrainList::getNotEndTrain();
        return view('Manager.Probationary.Graduation.GradeChangePage', ['train' => $train]);
    }

    /**
     * 结业成绩调整筛选出的学生信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function graduationGradeChangePage(Request $request){
        $train = TrainList::getNotEndTrain();
        $sno = $request->input('sno');
        $entry = EntryForm::getBySno($sno);
        $lastTrainEntry = [];
        $children = [];
        if ($entry){
            //这里,我们需要确定是否是继承自上期培训
            if ($entry[0]['lastTrainId']){
                $lastTrainEntry = EntryForm::getByTrainIdAndSno($entry[0]['lastTrainId'], $sno);
            }
            $children = ChildEntryForm::getByEntryId($entry[0]['id']);
        }
        return view('Manager.Probationary.Graduation.GradeChange', ['train' => $train ,'lastTrainEntry' => $lastTrainEntry, 'entry' => $entry, 'children' => $children]);
    }

    /**
     * 结业成绩调整后台逻辑
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function graduationGradeChange(Request $request){
        $data = $request->all();
//        dd($data);
        if ($data['sno'] && $data['entryFormId']){
            if ($data['status'] == 2){
                //作弊
                $data['countCheat']++;
                $data['practiceGrade'] = 0;
                $data['articleGrade'] = 0;
            }else if ($data['status'] == 3){
                //缺考
                $data['practiceGrade'] = 0;
                $data['articleGrade'] = 0;
            }
            $res2 = [];
            for ($i = 0; $i < count($data['childEntryId']); $i++){
                if ($data['status'][$i] == 2){
                    //作弊
                    $data['countCheat']++;
                    $data['grade'][$i] = 0;
                }else if ($data['status'][$i] == 3){
                    //缺考
                    $data['grade'][$i] = 0;
                }
                $res2 = ChildEntryForm::updateSome1($data, $i);
            }
            $res1 = EntryForm::updateOneGradeAndStatus($data);
            if ($res1 && $res2){
                $result = '结业成绩调整成功！';
            }else{
                $result = '调整失败！';
            }
        }else{
            $result = '重要信息丢失！';
        }
        return view('Manager.Probationary.Graduation.GradeChangeResult', ['result' => $result]);
    }
}