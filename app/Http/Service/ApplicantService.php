<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:17 AM
 */

namespace App\Http\Service;
use App\Models\Applicant\CourseList;
use App\Models\Applicant\EntryForm;
use App\Models\Applicant\TestList;
use App\Models\StudentInfo;

class ApplicantService{

    public function courseList($split = false){
        // 获取20课信息
        $data = CourseList::getCourseByLimit(20);

        // 一二三四~十的unicode ：）
        $preg = "/(\x{7b2c}[\x{4e00}\x{4e8c}\x{4e09}\x{56db}\x{4e94}\x{516d}\x{4e03}\x{516b}\x{4e5d}\x{5341}]+\x{8bfe})\s*(.*)/u";

        if($split){
            foreach($data as $i => $v){
                if (preg_match_all($preg, $data[$i]['courseName'], $match)) {
                    $data[$i]['courseName'] = [$match[1][0] , $match[2][0]];
                }
                else
                    $data[$i]['courseName'] = ['', $data[$i]['courseName']];
                $data[$i]['url'] = url('applicant/courseStudy/' . $data[$i]['id']);
            }
        }
        return $data;
    }

    public function getCourseById($id){
        $courses = CourseList::getCourseById($id);
        if(!$courses)
            return null;
        return $courses[0];
    }
    
    public function canEntryTest($userNumber){

        if(! StudentInfo::isPass20($userNumber))
            return [
                'status' => false,
                'msg'    => '请先通过申请人网上党校学习',
            ];

        if(StudentInfo::isLocked($userNumber))
            return [
                'status' => false,
                'msg'    => '您的账号已经被锁住，无法进行报名，请联系管理员请求解锁',
            ];
        if(EntryForm::isPass($userNumber))
            return [
                'status' => false,
                'msg'    => '您已经通过申请人结业考试，无需重复报名',
            ];
        if(! $activeTest = TestList::getActiveTest())
            return [
                'status' => false,
                'msg'    => '暂时还没有考试处于报名开启状态',
            ];

        if(EntryForm::isEntry($userNumber, $activeTest['id']))
            return [
                'status' => false,
                'msg'    => '您已经参加过本期考试的报名了！到【报名结果】中进行查看吧！',
            ];

        return [
            'status' => true,
            'test'   => $activeTest
        ];
    }
}