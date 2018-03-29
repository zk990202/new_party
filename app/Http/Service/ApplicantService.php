<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 9:17 AM
 */

namespace App\Http\Service;
use App\Models\Applicant\CourseList;

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
                $data[$i]['url'] = '' . $data[$i]['id'];
            }
        }
        return $data;
    }
}