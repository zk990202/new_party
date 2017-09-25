<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2017/7/9
 * Time: 下午12:18
 */
namespace App\Http\Helpers;

use App\Models\Academy\EntryForm as AcademyEntryForm;
use App\Models\Academy\TestList as AcademyTestList;
use App\Models\Applicant\ArticleList;
use App\Models\Applicant\CourseList;
use App\Models\Applicant\EntryForm;
use App\Models\Applicant\ExerciseAnswerTransform;
use App\Models\Applicant\ExerciseList;
use App\Models\Applicant\TestList;
use App\Models\Cert;
use App\Models\CommonFiles;
use App\Models\Notification;
use App\Models\SpecialNews;


class Resources {
    public static function Notification(Notification $notification){
//        dd($notification->column);
//        exit;
        return [
            'id'        =>  $notification->notice_id,
            'columnId'  =>  $notification->column_id,
            'columnName'=>  $notification->column->column_name,
            'title'     =>  $notification->notice_title,
            'content'   =>  $notification->notice_content,
            'time'      =>  $notification->notice_time,
            'fileName'  =>  $notification->notice_filename,
            'filePath'  =>  $notification->notice_filepath,
            'isTop'     =>  $notification->notice_istop,
            'authorName'=>  $notification->owner->username ?? '',
            'isHidden'  =>  $notification->notice_ishidden,
            'isDeleted' =>  $notification->notice_isdeleted
        ];
    }

    public static function SpecialNews(SpecialNews $partyBuild){
        return [
            'id' => $partyBuild->id,
            'title' => $partyBuild->title,
            'summary' => $partyBuild->summary,
            'content' => $partyBuild->content,
            'time' => $partyBuild->inserttime,
            'authorName' => $partyBuild->owner->username ?? '',
            'type' => $partyBuild->type,
            'typeName' => $partyBuild->column->column_name,
            'isTop' => $partyBuild->isrecommand,
            'imgPath' => $partyBuild->img_path,
            'isHidden' => $partyBuild->isdeleted
        ];
    }

    public static function CommonFiles(CommonFiles $commonFiles){
        return [
            'id' => $commonFiles->file_id,
            'title' => $commonFiles->file_title,
            'content' => $commonFiles->file_content,
            'time' => $commonFiles->file_addtime,
            'type' => $commonFiles->file_type,
            'filePath' => $commonFiles->file_img,
            'isHidden' => $commonFiles->file_isdeleted
        ];
    }

    public static function CourseList(CourseList $courseList){
       // dd($courseList);
        return [
            'id' => $courseList->course_id,
            'courseName' => $courseList->course_name,
            'detail' => $courseList->course_detail,
            'priority' => $courseList->course_priority,
            'time' => $courseList->course_inserttime,
            'isHidden' => $courseList->course_ishidden,
            'isDeleted' => $courseList->course_isdeleted
        ];
    }

    public static function ArticleList(ArticleList $articleList){
//        dd($articleList->courseList->course_name) ;
//        exit;
        return [
            'id' => $articleList->article_id,
            'courseId' => $articleList->course_id,
            'articleName' => $articleList->article_name,
            'courseName' =>$articleList->courseList->course_name ?? "",
            'content' => $articleList->article_content,
            'isHidden' => $articleList->article_ishidden,
            'isDeleted' => $articleList->article_isdeleted
        ];
    }

    public static function ExerciseList(ExerciseList $exerciseList){
        return [
            'id' => $exerciseList->exercise_id,
            'courseId' => $exerciseList->course_id,
            'courseName' => $exerciseList->courseList->course_name ?? "",
            'type' => $exerciseList->exercise_type,
            'content' => $exerciseList->exercise_content,
            'optionA' => $exerciseList->exercise_optionA,
            'optionB' => $exerciseList->exercise_optionB,
            'optionC' => $exerciseList->exercise_optionC,
            'optionD' => $exerciseList->exercise_optionD,
            'optionE' => $exerciseList->exercise_optionE,
            'answerNumber' => $exerciseList->exercise_answer,
            'answerLetter' => $exerciseList->exerciseAnswerTransform->exercise_answer_letter ?? "",
            'isHidden' => $exerciseList->exercise_ishidden,
            'isDeleted' => $exerciseList->exercise_isdeleted
        ];
    }

    public static function ExerciseAnswerTransform(ExerciseAnswerTransform $exerciseAnswerTransform){
        return [
            'id' => $exerciseAnswerTransform->id,
            'answerNumber' => $exerciseAnswerTransform->exercise_answer_number,
            'answerLetter' => $exerciseAnswerTransform->exercise_answer_letter
        ];
    }

    public static function TestList(TestList $testList){
        return [
            'id' => $testList->test_id,
            'name' => $testList->test_name,
            'time' => $testList->test_begintime,
            'attention' => $testList->test_attention,
            'fileName' => $testList->test_filename,
            'filePath' => $testList->test_filepath,
            'status' => $testList->test_status,
            'isDeleted' => $testList->test_isdeleted
        ];
    }

    public static function EntryForm(EntryForm $entryForm){
        return [
            'id' => $entryForm->entry_id,
            'testId' => $entryForm->test_id,
            'testName' => $entryForm->testList->test_name,
            'sno' => $entryForm->sno,
            'academyId' => $entryForm->studentInfo->academy_id ?? '',
            'academyName' => $entryForm->studentInfo->college->shortname ?? '',
            'majorName' => $entryForm->userInfo->major->majorname ?? '',
            'studentName' => $entryForm->user->username ?? '',
            'time' => $entryForm->entry_time,
            'practiceGrade' => $entryForm->entry_practicegrade,
            'articleGrade' => $entryForm->entry_articlegrade,
            'isLastAdded' => $entryForm->entry_islastadded,
            'isSystemAdd' => $entryForm->is_systemadd,
            'isPassed' => $entryForm->entry_ispassed,
            'status' => $entryForm->entry_status,
            'certIsGrant' => $entryForm->cert_isgrant,
            'isExit' => $entryForm->isexit,
            'campus' => $entryForm->campus
        ];
    }

    public static function Cert(Cert $cert){
        return [
            'id' => $cert->cert_id,
            'sno' => $cert->sno,
            'studentName' => $cert->user->username ?? '',
            'academyId' => $cert->studentInfo->academy_id,
            'academyName' => $cert->studentInfo->college->shortname,
            'majorName' => $cert->userInfo->major->majorname ?? '',
            'entryId' => $cert->entry_id,
            'certNumber' => $cert->cert_no,
            'type' => $cert->cert_type,
            'time' => $cert->cert_time,
            'getPerson' => $cert->cert_getperson,
            'place' => $cert->cert_place,
            'isLost' => $cert->cert_islost,
            'isDeleted' => $cert->isdeleted,
            'practiceGrade' => $cert->entryForm->entry_practicegrade ?? '',
            'articleGrade' => $cert->entryForm->entry_articlegrade ?? '',
            'testGrade' => $cert->entryForm->entry_testgrade ?? ''
        ];
    }

    public static function CertLost($certLost){
        return [
            'lostId' => $certLost->lost_id,
            'sno' => $certLost->cert->sno,
            'testName' => $certLost->cert->entryForm->testList->test_name ?? '',
            'studentName' => $certLost->cert->user->username ?? '',
            'academyName' => $certLost->cert->studentInfo->college->shortname,
            'majorName' => $certLost->cert->userInfo->major->majorname ?? '',
            'certId' => $certLost->cert_id,
            'certType' => $certLost->cert->cert_type,
            'title' => $certLost->title,
            'content' => $certLost->content,
            'time' => $certLost->time,
            'dealStatus' => $certLost->deal_status,
            'dealWord' => $certLost->deal_word,
            'isDeleted' => $certLost->isdeleted,
            'getPerson' => $certLost->cert->cert_getperson,
            'place' => $certLost->cert->cert_place
        ];
    }

    public static function Complain($complain){
        return [
            'id' => $complain->id,
            'fromSno' => $complain->from_sno,
            'toSno' => $complain->to_sno,
            'studentName' => $complain->user->username ?? '',
            'academyId' => $complain->collegeid,
            'academyName' => $complain->userInfo->college->shortname ?? '',
            'testId' => $complain->test_id,
            'title' => $complain->title,
            'content' => $complain->content,
            'type' => $complain->type,
            'time' => $complain->time,
            'isRead' => $complain->isread,
            'isReply' => $complain->isreplay,
            'testName' => $complain->testList->test_name ?? ''
        ];
    }

    public static function AcademyTestList(AcademyTestList $testList){
        return [
            'id' => $testList->test_id,
            'name' => $testList->test_name,
            'parent' => $testList->test_parent,
            'trainName' => $testList->testList->test_name ?? '',
            'academyId' => $testList->test_of_academy,
            'academyName' => $testList->college->collegename ?? '',
            'time' => $testList->test_begintime,
            'introduction' => $testList->test_introduction,
            'attention' => $testList->test_attention,
            'status' => $testList->test_status,
            'isDeleted' => $testList->test_isdeleted
        ];
    }

    public static function AcademyEntryForm(AcademyEntryForm $entryForm){
        return [
            'id' => $entryForm->entry_id,
            'testId' => $entryForm->test_id,
            'testName' => $entryForm->testList->test_name,
            'sno' => $entryForm->sno,
            'academyId' => $entryForm->studentInfo->academy_id ?? '',
            'academyName' => $entryForm->studentInfo->college->shortname ?? '',
            'majorName' => $entryForm->userInfo->major->majorname ?? '',
            'studentName' => $entryForm->user->username ?? '',
            'time' => $entryForm->entry_time,
            'practiceGrade' => $entryForm->entry_practicegrade,
            'articleGrade' => $entryForm->entry_articlegrade,
            'testGrade' => $entryForm->entry_testgrade,
            'isLastAdded' => $entryForm->entry_islastadded,
            'isSystemAdd' => $entryForm->is_systemadd,
            'isPassed' => $entryForm->entry_ispassed,
            'status' => $entryForm->entry_status,
            'certIsGrant' => $entryForm->cert_isgrant,
            'isExit' => $entryForm->isexit,
        ];
    }

    public static function AcademyCert(Cert $cert){
        return [
            'id' => $cert->cert_id,
            'sno' => $cert->sno,
            'studentName' => $cert->user->username ?? '',
            'academyId' => $cert->studentInfo->academy_id,
            'academyName' => $cert->studentInfo->college->shortname,
            'majorName' => $cert->userInfo->major->majorname ?? '',
            'entryId' => $cert->entry_id,
            'certNumber' => $cert->cert_no,
            'type' => $cert->cert_type,
            'time' => $cert->cert_time,
            'getPerson' => $cert->cert_getperson,
            'place' => $cert->cert_place,
            'isLost' => $cert->cert_islost,
            'isDeleted' => $cert->isdeleted,
            'practiceGrade' => $cert->entryFormAcademy->entry_practicegrade,
            'articleGrade' => $cert->entryFormAcademy->entry_articlegrade,
            'testGrade' => $cert->entryFormAcademy->entry_testgrade
        ];
    }

    public static function ProbationaryTrainList($trainList){
        return [
            'id' => $trainList->train_id,
            'name' => $trainList->train_name,
            'time' => $trainList->train_begintime,
            'fileName' => $trainList->train_filename,
            'filePath' => $trainList->train_filepath,
            'detail' => $trainList->train_detail,
            'entryStatus' => $trainList->train_entry_status,
            'netChooseStatus' => $trainList->train_netchoose_status,
            'gradeSearchStatus' => $trainList->train_gradesearch_status,
            'endListShow' => $trainList->train_endlist_show,
            'goodMemberShow' => $trainList->train_goodmember_show,
            'endInsert' => $trainList->train_endinsert,
            'isEndInsert' => $trainList->train_isendinsert,
            'isEnd' => $trainList->train_isend,
            'isDeleted' => $trainList->train_isdeleted,
//            'courseCanInsert' => $trainList->CouresList->course_caninsert ?? '',
//            'courseIsInserted' => $trainList->CouresList->course_isinserted ?? ''
        ];
    }

    public static function ProbationaryCourseList($courseList){
        return [
            'id' => $courseList->course_id,
            'trainId' => $courseList->train_id,
            'trainName' => $courseList->trainList->train_name,
            'name' => $courseList->course_name,
            'type' => $courseList->course_type,
            'movieId' => $courseList->movie_id,
            'movieName' => $courseList->commonFiles->file_title,
            'introduction' => $courseList->course_introduction,
            'requirement' => $courseList->course_requirement,
            'time' => $courseList->course_begintime,
            'speaker' => $courseList->course_speaker,
            'place' => $courseList->course_place,
            'limitNum' => $courseList->course_limitnum,
            'canInsert' => $courseList->course_caninsert,
            'isInserted' => $courseList->course_isinserted,
            'isDeleted' => $courseList->course_isdeleted,
            'number' => $courseList->course_number
        ];
    }

    public static function ProbationaryEntryForm($entryForm){
        return [
            'id' => $entryForm->entry_id,
            'sno' => $entryForm->sno,
            'trainId' => $entryForm->train_id,
            'practiceGrade' => $entryForm->entry_practicegrade,
            'articleGrade' => $entryForm->entry_articlegrade,
            'time' => $entryForm->entry_time,
            'isLastAdded' => $entryForm->entry_islastadded,
            'status' => $entryForm->entry_status,
            'isAllPassed' => $entryForm->entry_isallpassed,
            'isSystemAdd' => $entryForm->is_systemadd,
            'certIsGrant' => $entryForm->cert_isgrant,
            'passCompulsory' => $entryForm->pass_must,
            'passElective' => $entryForm->pass_choose,
            'exitCount' => $entryForm->exitcount,
            'lastTrainId' => $entryForm->last_trainid,
            'isExit' => $entryForm->isexit,
            'countCheat' => $entryForm->count_zuobi
        ];
    }

    public static function ProbationaryChildEntryForm($childEntryForm){
        return [
            'id' => $childEntryForm->entry_id,
            'childId' => $childEntryForm->child_entryid,
            'sno' => $childEntryForm->child_sno,
            'courseId' => $childEntryForm->child_courseid,
            'entryTime' => $childEntryForm->child_entrytime,
            'status' => $childEntryForm->child_status,
            'grade' => $childEntryForm->child_grade,
            'isExit' => $childEntryForm->isexit
        ];
    }

    public static function StudentInfo($studentInfo){
        return [
            'id' => $studentInfo->info_id,
            'sno' => $studentInfo->sno,
            'academyId' => $studentInfo->academy_id,
            'partyBranchId' => $studentInfo->partybranch_id,
            'isPassed' => $studentInfo->is_pass20,
            'pass20Time' => $studentInfo->pass20_time,
            'isClear20' => $studentInfo->is_clear20,
            'lockedTestId' => $studentInfo->locked_test_id,
            'applicantIsLocked' => $studentInfo->applicant_islocked,
            'applicantFailedTimes' => $studentInfo->applicant_failedtimes,
            'captionOfGroup' => $studentInfo->captain_ofgroup,
            'applyGroupTime' => $studentInfo->apply_grouptime,
            'activeRoleTime' => $studentInfo->active_roletime,
            'groupExecTime' => $studentInfo->group_exectime,
            'developTargetTime' => $studentInfo->develop_targettime,
            'allTrainTime' => $studentInfo->all_traintime,
            'dataCompleteTime' => $studentInfo->data_completetime,
            'reportTime' => $studentInfo->report_time,
            'devShowStartTime' => $studentInfo->dev_show_starttime,
            'votePassTime' => $studentInfo->vote_passtime,
            'talkPassTime' => $studentInfo->talk_passtime,
            'probPassedTime' => $studentInfo->prob_passedtime,
            'activityPassedTime' => $studentInfo->activity_passetime,
            'realShowStartTime' => $studentInfo->real_show_starttime,
            'turnRealMeetingTime' => $studentInfo->turn_real_meetingtime,
            'approvePassedTime' => $studentInfo->approve_passedtime,
            'partyMemberTime' => $studentInfo->partymember_time,
            'thoughtReportCount' => $studentInfo->thought_reportcount,
            'personalReportCount' => $studentInfo->personal_reportcount,
            'mainStatus' => $studentInfo->main_status,
            'isInit' => $studentInfo->is_init,
            'studentName' => $studentInfo->user->username ?? '',
            'academyName' => $studentInfo->college->shortname ?? '',
            'majorName' => $studentInfo->userInfo->major->majorname ?? '',
            'testName' => $studentInfo->testList->test_name ?? ''
        ];
    }

    public static function File($file){
        return [
            'id'    => $file->id,
            'path'  => $file->file_path,
            'name'  => $file->file_name,
            'size'  => $file->file_size,
            'extension' => $file->file_extension,
            'usage' => $file->file_usage
        ];
    }

    public static function Column($column){
        return [
            'id'    => $column->column_id,
            'pid'   => $column->column_pid,
            'name'  => $column->column_name
        ];
    }
    public static function Module($module){
        return [
            'id'        =>  $module->self_id,
            'parent_id' =>  $module->parent_id,
            'name'      =>  $module->name,
            'url'       =>  $module->url,
            'icon'      =>  $module->icon,
            'is_show'   =>  $module->is_show,
            'auth'      =>  $module->auth
        ];
    }
}