<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2017/7/9
 * Time: 下午12:18
 */

namespace App\Http\Helpers;

use App\Http\Service\FileService;
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
use App\Models\RouteGroups;
use App\Models\SpecialNews;
use App\Models\UserInfo;


class Resources
{
    public static function Notification(Notification $notification)
    {
//        dd($notification->column);
//        exit;
        return [
            'id'         => $notification->notice_id,
            'columnId'   => $notification->column_id,
            'columnName' => $notification->column->column_name,
            'title'      => $notification->notice_title,
            'content'    => clean($notification->notice_content),
            'time'       => $notification->notice_time,
            'fileName'   => $notification->notice_filename,
            'filePath'   => FileService::fileAccessUri($notification->notice_filepath),
            'isTop'      => $notification->notice_istop,
            'authorName' => $notification->author,
            'isHidden'   => $notification->notice_ishidden,
            'isDeleted'  => $notification->notice_isdeleted
        ];
    }

    public static function SpecialNews(SpecialNews $partyBuild)
    {
        return [
            'id'         => $partyBuild->id,
            'title'      => $partyBuild->title,
            'summary'    => $partyBuild->summary,
            'content'    => clean($partyBuild->content),
            'time'       => $partyBuild->inserttime,
            'authorName' => $partyBuild->userInfo->username ?? '',
            'type'       => $partyBuild->type,
            'typeName'   => $partyBuild->column->column_name,
            'isTop'      => $partyBuild->isrecommand,
            'imgPath'    => FileService::fileAccessUri($partyBuild->img_path),
            'isHidden'   => $partyBuild->isdeleted
        ];
    }

    public static function CommonFiles(CommonFiles $commonFiles)
    {
        return [
            'id'       => $commonFiles->file_id,
            'title'    => $commonFiles->file_title,
            'content'  => clean($commonFiles->file_content),
            'time'     => $commonFiles->file_addtime,
            'type'     => $commonFiles->file_type,
            'filePath' => FileService::fileAccessUri($commonFiles->file_img),
            'isHidden' => $commonFiles->file_isdeleted
        ];
    }

    public static function CourseList(CourseList $courseList)
    {
        // dd($courseList);
        return [
            'id'         => $courseList->course_id,
            'courseName' => $courseList->course_name,
            'detail'     => $courseList->course_detail,
            'priority'   => $courseList->course_priority,
            'time'       => $courseList->course_inserttime,
            'isHidden'   => $courseList->course_ishidden,
            'isDeleted'  => $courseList->course_isdeleted
        ];
    }

    public static function ArticleList(ArticleList $articleList)
    {
//        dd($articleList->courseList->course_name) ;
//        exit;
        return [
            'id'          => $articleList->article_id,
            'courseId'    => $articleList->course_id,
            'articleName' => $articleList->article_name,
            'courseName'  => $articleList->courseList->course_name ?? "",
            'content'     => clean($articleList->article_content),
            'isHidden'    => $articleList->article_ishidden,
            'isDeleted'   => $articleList->article_isdeleted
        ];
    }

    public static function ExerciseList(ExerciseList $exerciseList)
    {
        return [
            'id'           => $exerciseList->exercise_id,
            'courseId'     => $exerciseList->course_id,
            'courseName'   => $exerciseList->courseList->course_name ?? "",
            'type'         => $exerciseList->exercise_type,
            'content'      => $exerciseList->exercise_content,
            'optionA'      => $exerciseList->exercise_optionA,
            'optionB'      => $exerciseList->exercise_optionB,
            'optionC'      => $exerciseList->exercise_optionC,
            'optionD'      => $exerciseList->exercise_optionD,
            'optionE'      => $exerciseList->exercise_optionE,
            'answerNumber' => $exerciseList->exercise_answer,
            'answerLetter' => $exerciseList->exerciseAnswerTransform->exercise_answer_letter ?? "",
            'isHidden'     => $exerciseList->exercise_ishidden,
            'isDeleted'    => $exerciseList->exercise_isdeleted
        ];
    }

    public static function ExerciseListHideAnswer($e)
    {
        return [
            'id'         => $e['id'],
            'courseId'   => $e['courseId'],
            'courseName' => $e['courseName'],
            'type'       => $e['type'],
            'content'    => $e['content'],
            'optionA'    => $e['optionA'],
            'optionB'    => $e['optionB'],
            'optionC'    => $e['optionC'],
            'optionD'    => $e['optionD'],
            'optionE'    => $e['optionE'],
        ];
    }

    public static function ExerciseAnswerTransform(ExerciseAnswerTransform $exerciseAnswerTransform)
    {
        return [
            'id'           => $exerciseAnswerTransform->id,
            'answerNumber' => $exerciseAnswerTransform->exercise_answer_number,
            'answerLetter' => $exerciseAnswerTransform->exercise_answer_letter
        ];
    }

    public static function TestList(TestList $testList)
    {
        return [
            'id'        => $testList->test_id,
            'name'      => $testList->test_name,
            'time'      => $testList->test_begintime,
            'attention' => clean($testList->test_attention),
            'fileName'  => $testList->test_filename,
            'filePath'  => FileService::fileAccessUri($testList->test_filepath),
            'status'    => $testList->test_status,
            'isDeleted' => $testList->test_isdeleted
        ];
    }

    public static function EntryForm(EntryForm $entryForm)
    {
        return [
            'id'            => $entryForm->entry_id,
            'testId'        => $entryForm->test_id,
            'testName'      => $entryForm->testList->test_name,
            'testTime'      => $entryForm->testList->test_begintime,
            'testStatus'    => $entryForm->testList->test_status,
            'sno'           => $entryForm->sno,
            'academyId'     => $entryForm->studentInfo->academy_id ?? '',
            'academyName'   => $entryForm->studentInfo->college->shortname ?? '',
            'majorName'     => $entryForm->userInfo->majorInfo->majorname ?? '',
            'studentName'   => $entryForm->user->username ?? '',
            'time'          => $entryForm->entry_time,
            'practiceGrade' => $entryForm->entry_practicegrade,
            'articleGrade'  => $entryForm->entry_articlegrade,
            'isLastAdded'   => $entryForm->entry_islastadded,
            'isSystemAdd'   => $entryForm->is_systemadd,
            'isPassed'      => $entryForm->entry_ispassed,
            'status'        => $entryForm->entry_status,
            'certIsGrant'   => $entryForm->cert_isgrant,
            'isExit'        => $entryForm->isexit,
            'campus'        => $entryForm->campus,
            'fileName'      => $entryForm->testList->test_filename,
            'filePath'      => FileService::fileAccessUri($entryForm->testList->test_filepath),
        ];
    }

    public static function Cert(Cert $cert)
    {
        return [
            'id'            => $cert->cert_id,
            'sno'           => $cert->sno,
            'studentName'   => $cert->user->username ?? '',
            'academyId'     => $cert->studentInfo->academy_id,
            'academyName'   => $cert->studentInfo->college->shortname ?? '',
            'majorName'     => $cert->userInfo->majorInfo->majorname ?? '',
            'entryId'       => $cert->entry_id,
            'certNumber'    => $cert->cert_no,
            'type'          => $cert->cert_type,
            'time'          => $cert->cert_time,
            'getPerson'     => $cert->cert_getperson,
            'place'         => $cert->cert_place,
            'isLost'        => $cert->cert_islost,
            'isDeleted'     => $cert->isdeleted,
            'practiceGrade' => $cert->entryForm->entry_practicegrade ?? '',
            'articleGrade'  => $cert->entryForm->entry_articlegrade ?? '',
            'testGrade'     => $cert->entryForm->entry_testgrade ?? ''
        ];
    }

    public static function CertLost($certLost)
    {
        return [
            'lostId'      => $certLost->lost_id,
            'sno'         => $certLost->cert->sno,
            'testName'    => $certLost->cert->entryForm->testList->test_name ?? '',
            'studentName' => $certLost->cert->user->username ?? '',
            'academyName' => $certLost->cert->studentInfo->college->shortname ?? '',
            'majorName'   => $certLost->cert->userInfo->majorInfo->majorname ?? '',
            'certId'      => $certLost->cert_id,
            'certType'    => $certLost->cert->cert_type,
            'title'       => $certLost->title,
            'content'     => $certLost->content,
            'time'        => $certLost->time,
            'dealStatus'  => $certLost->deal_status,
            'dealWord'    => $certLost->deal_word,
            'isDeleted'   => $certLost->isdeleted,
            'getPerson'   => $certLost->cert->cert_getperson,
            'place'       => $certLost->cert->cert_place
        ];
    }

    public static function Complain($complain)
    {
        return [
            'id'          => $complain->id ?? -1,
            'fromSno'     => $complain->from_sno ?? '',
            'toSno'       => $complain->to_sno ?? '',
            'studentName' => $complain->user->username ?? '',
            'academyId'   => $complain->collegeid ?? -1,
            'academyName' => $complain->userInfo->college->shortname ?? '',
            'testId'      => $complain->test_id ?? -1,
            'title'       => $complain->title ?? '',
            'content'     => $complain->content ?? '',
            'type'        => $complain->type ?? -1,
            'time'        => $complain->time ?? '',
            'isRead'      => $complain->isread ?? -1,
            'isReply'     => $complain->isreplay ?? -1,
            'testName'    => $complain->testList->test_name ?? ''
        ];
    }

    public static function AcademyTestList(AcademyTestList $testList)
    {
        return [
            'id'           => $testList->test_id,
            'name'         => $testList->test_name,
            'parent'       => $testList->test_parent,
            'trainName'    => $testList->testList->test_name ?? '',
            'academyId'    => $testList->test_of_academy,
            'academyName'  => $testList->college->collegename ?? '',
            'time'         => $testList->test_begintime,
            'introduction' => clean($testList->test_introduction),
            'attention'    => $testList->test_attention,
            'status'       => $testList->test_status,
            'isDeleted'    => $testList->test_isdeleted
        ];
    }

    public static function AcademyEntryForm(AcademyEntryForm $entryForm)
    {
        return [
            'id'            => $entryForm->entry_id,
            'testId'        => $entryForm->test_id,
            'testName'      => $entryForm->testList->test_name,
            'testStatus'    => $entryForm->testList->test_status,
            'testTime'      => $entryForm->testList->test_begintime,
            'sno'           => $entryForm->sno,
            'academyId'     => $entryForm->studentInfo->academy_id ?? '',
            'academyName'   => $entryForm->studentInfo->college->shortname ?? '',
            'majorName'     => $entryForm->userInfo->majorInfo->majorname ?? '',
            'studentName'   => $entryForm->user->username ?? '',
            'time'          => $entryForm->entry_time,
            'practiceGrade' => $entryForm->entry_practicegrade,
            'articleGrade'  => $entryForm->entry_articlegrade,
            'testGrade'     => $entryForm->entry_testgrade,
            'isLastAdded'   => $entryForm->entry_islastadded,
            'isSystemAdd'   => $entryForm->is_systemadd,
            'isPassed'      => $entryForm->entry_ispassed,
            'status'        => $entryForm->entry_status,
            'certIsGrant'   => $entryForm->cert_isgrant,
            'isExit'        => $entryForm->isexit,
        ];
    }

    public static function AcademyCert(Cert $cert)
    {
        return [
            'id'            => $cert->cert_id,
            'sno'           => $cert->sno,
            'studentName'   => $cert->user->username ?? '',
            'academyId'     => $cert->studentInfo->academy_id,
            'academyName'   => $cert->studentInfo->college->shortname,
            'majorName'     => $cert->userInfo->majorInfo->majorname ?? '',
            'entryId'       => $cert->entry_id,
            'certNumber'    => $cert->cert_no,
            'type'          => $cert->cert_type,
            'time'          => $cert->cert_time,
            'getPerson'     => $cert->cert_getperson,
            'place'         => $cert->cert_place,
            'isLost'        => $cert->cert_islost,
            'isDeleted'     => $cert->isdeleted,
            'practiceGrade' => $cert->entryFormAcademy->entry_practicegrade ?? '',
            'articleGrade'  => $cert->entryFormAcademy->entry_articlegrade ?? '',
            'testGrade'     => $cert->entryFormAcademy->entry_testgrade ?? ''
        ];
    }

    public static function ProbationaryTrainList($trainList)
    {
        return [
            'id'                => $trainList->train_id,
            'name'              => $trainList->train_name,
            'time'              => $trainList->train_begintime,
            'fileName'          => $trainList->train_filename,
            'filePath'          => FileService::fileAccessUri($trainList->train_filepath),
            'detail'            => clean($trainList->train_detail),
            'entryStatus'       => $trainList->train_entry_status,
            'netChooseStatus'   => $trainList->train_netchoose_status,
            'gradeSearchStatus' => $trainList->train_gradesearch_status,
            'endListShow'       => $trainList->train_endlist_show,
            'goodMemberShow'    => $trainList->train_goodmember_show,
            'endInsert'         => $trainList->train_endinsert,
            'isEndInsert'       => $trainList->train_isendinsert,
            'isEnd'             => $trainList->train_isend,
            'isDeleted'         => $trainList->train_isdeleted,
            //            'courseCanInsert' => $trainList->CouresList->course_caninsert ?? '',
            //            'courseIsInserted' => $trainList->CouresList->course_isinserted ?? ''
        ];
    }

    public static function ProbationaryCourseList($courseList)
    {
        return [
            'id'           => $courseList->course_id,
            'trainId'      => $courseList->train_id,
            'trainName'    => $courseList->trainList->train_name,
            'name'         => $courseList->course_name,
            'type'         => $courseList->course_type,
            'movieId'      => $courseList->movie_id,
            'movieName'    => $courseList->commonFiles->file_title ?? '',
            'introduction' => clean($courseList->course_introduction),
            'requirement'  => $courseList->course_requirement,
            'time'         => $courseList->course_begintime,
            'speaker'      => $courseList->course_speaker,
            'place'        => $courseList->course_place,
            'limitNum'     => $courseList->course_limitnum,
            'canInsert'    => $courseList->course_caninsert,
            'isInserted'   => $courseList->course_isinserted,
            'isDeleted'    => $courseList->course_isdeleted,
            'number'       => $courseList->course_number
        ];
    }

    public static function ProbationaryEntryForm($entryForm)
    {
        return [
            'id'                => $entryForm->entry_id,
            'sno'               => $entryForm->sno,
            'trainId'           => $entryForm->train_id,
            'trainName'         => $entryForm->trainList->train_name ?? '',
            'trainTime'         => $entryForm->trainList->train_begintime,
            'trainStatus'       => $entryForm->trainList->train_entry_status,
            // 网上选课状态
            'trainCourseStatus' => $entryForm->trainList->train_netchoose_status,
            // 成绩查看状态
            'trainGradeStatus'  => $entryForm->trainList->train_gradesearch_status,
            'trainFileName'     => $entryForm->trainList->train_filename,
            'trainFilePath'     => $entryForm->trainList->train_filepath,
            'academyId'         => $entryForm->studentInfo->academy_id ?? '',
            'academyName'       => $entryForm->studentInfo->college->shortname ?? '',
            'majorName'         => $entryForm->userInfo->majorInfo->majorname ?? '',
            'studentName'       => $entryForm->user->username ?? '',
            'practiceGrade'     => $entryForm->entry_practicegrade,
            'articleGrade'      => $entryForm->entry_articlegrade,
            'time'              => $entryForm->entry_time,
            'isLastAdded'       => $entryForm->entry_islastadded,
            'status'            => $entryForm->entry_status,
            'isAllPassed'       => $entryForm->entry_isallpassed,
            'isSystemAdd'       => $entryForm->is_systemadd,
            'certIsGrant'       => $entryForm->cert_isgrant,
            'passCompulsory'    => $entryForm->pass_must,
            'passElective'      => $entryForm->pass_choose,
            'exitCount'         => $entryForm->exitcount,
            'lastTrainId'       => $entryForm->last_trainid,
            'isExit'            => $entryForm->isexit,
            'countCheat'        => $entryForm->count_zuobi,
            'isDeleted'         => $entryForm->isdeleted,
            'gradeSearchStatus' => $entryForm->trainList->train_gradesearch_status
        ];
    }

    public static function ProbationaryChildEntryForm($childEntryForm)
    {
        return [
            'id'          => $childEntryForm->entry_id,
            'childId'     => $childEntryForm->child_entryid,
            'sno'         => $childEntryForm->child_sno,
            'studentName' => $childEntryForm->user->username ?? '',
            'academyId'   => $childEntryForm->studentInfo->academy_id ?? '',
            'academyName' => $childEntryForm->studentInfo->college->shortname ?? '',
            'courseId'    => $childEntryForm->child_courseid,
            'courseName'  => $childEntryForm->courseList->course_name ?? '',
            'courseType'  => $childEntryForm->courseList->course_type,
            'courseTime'  => $childEntryForm->courseList->course_begintime,
            'coursePlace' => $childEntryForm->courseList->course_place,
            'entryTime'   => $childEntryForm->child_entrytime,
            'status'      => $childEntryForm->child_status,
            'grade'       => $childEntryForm->child_grade,
            'isExit'      => $childEntryForm->isexit
        ];
    }

    public static function ProbationaryCert(Cert $cert)
    {
        return [
            'id'            => $cert->cert_id,
            'sno'           => $cert->sno,
            'studentName'   => $cert->user->username ?? '',
            'academyId'     => $cert->studentInfo->academy_id,
            'academyName'   => $cert->studentInfo->college->shortname,
            'majorName'     => $cert->userInfo->majorInfo->majorname ?? '',
            'entryId'       => $cert->entry_id,
            'certNumber'    => $cert->cert_no,
            'type'          => $cert->cert_type,
            'time'          => $cert->cert_time,
            'getPerson'     => $cert->cert_getperson,
            'place'         => $cert->cert_place,
            'isLost'        => $cert->cert_islost,
            'isDeleted'     => $cert->isdeleted,
            'practiceGrade' => $cert->entryFormProbationary->entry_practicegrade,
            'articleGrade'  => $cert->entryFormProbationary->entry_articlegrade,
            'testGrade'     => $cert->entryFormProbationary->entry_testgrade
        ];
    }

    public static function PartyBranch($partyBranch)
    {
        return [
            'id'               => $partyBranch->partybranch_id,
            'name'             => $partyBranch->partybranch_name,
            'secretary'        => $partyBranch->partybranch_secretary,
            'secretaryName'    => $partyBranch->user_secretary->username ?? '',
            'organizer'        => $partyBranch->partybranch_organizer,
            'organizerName'    => $partyBranch->user_organizer->username ?? '',
            'propagator'       => $partyBranch->partybranch_propagator,
            'propagatorName'   => $partyBranch->user_propagator->username ?? '',
            'academy'          => $partyBranch->partybranch_academy,
            'academyName'      => $partyBranch->college_->collegename ?? '',
            'academyShortName' => $partyBranch->college_->shortname ?? '',
            'type'             => $partyBranch->partybranch_type,
            'schoolYear'       => $partyBranch->partybranch_schoolyear,
            'establishTime'    => $partyBranch->partybranch_establishtime,
            'isHidden'         => $partyBranch->partybranch_ishidden,
            'isDeleted'        => $partyBranch->partybranch_isdeleted,
            'totalScore'       => $partyBranch->partybranch_total_score,
            'totalReply'       => $partyBranch->partybranch_total_reply,
            'totalTopic'       => $partyBranch->partybranch_total_topic,
            'totalAct'         => $partyBranch->partybranch_total_act
        ];
    }

    public static function StudentInfo($studentInfo)
    {
        //dd($studentInfo->userInfo->majorInfo);
        return [
            'id'                   => $studentInfo->info_id,
            'sno'                  => $studentInfo->sno,
            'academyId'            => $studentInfo->academy_id,
            'partyBranchId'        => $studentInfo->partybranch_id,
            'isPassed'             => $studentInfo->is_pass20,
            'pass20Time'           => $studentInfo->pass20_time,
            'isClear20'            => $studentInfo->is_clear20,
            'lockedTestId'         => $studentInfo->locked_test_id,
            'applicantIsLocked'    => $studentInfo->applicant_islocked,
            'applicantFailedTimes' => $studentInfo->applicant_failedtimes,
            'captionOfGroup'       => $studentInfo->captain_ofgroup,
            'applyGroupTime'       => $studentInfo->apply_grouptime,
            'activeRoleTime'       => $studentInfo->active_roletime,
            'groupExecTime'        => $studentInfo->group_exectime,
            'developTargetTime'    => $studentInfo->develop_targettime,
            'allTrainTime'         => $studentInfo->all_traintime,
            'dataCompleteTime'     => $studentInfo->data_completetime,
            'reportTime'           => $studentInfo->report_time,
            'devShowStartTime'     => $studentInfo->dev_show_starttime,
            'votePassTime'         => $studentInfo->vote_passtime,
            'talkPassTime'         => $studentInfo->talk_passtime,
            'probPassedTime'       => $studentInfo->prob_passedtime,
            'activityPassedTime'   => $studentInfo->activity_passetime,
            'realShowStartTime'    => $studentInfo->real_show_starttime,
            'turnRealMeetingTime'  => $studentInfo->turn_real_meetingtime,
            'approvePassedTime'    => $studentInfo->approve_passedtime,
            'partyMemberTime'      => $studentInfo->partymember_time,
            'thoughtReportCount'   => $studentInfo->thought_reportcount,
            'personalReportCount'  => $studentInfo->personal_reportcount,
            'mainStatus'           => $studentInfo->main_status,
            'isInit'               => $studentInfo->is_init,
            'studentName'          => $studentInfo->user->username ?? '',
            'academyName'          => $studentInfo->college->shortname ?? '',
            'majorName'            => $studentInfo->userInfo->majorInfo->majorname ?? '',
            'testName'             => $studentInfo->testList->test_name ?? ''
        ];
    }

    public static function StudentFiles($studentFiles){
        return [
            'id' => $studentFiles->file_id ?? -1,
            'sno' => $studentFiles->sno ?? '',
            'title' => $studentFiles->file_title ?? '',
            'content' => $studentFiles->file_content ?? '',
            'addTime' => $studentFiles->file_addtime ?? '',
            'dealTime' => $studentFiles->file_dealtime ?? '',
            'type' => $studentFiles->file_type ?? -1,
            'status' => $studentFiles->file_status ?? -1,
            'systemAdd' => $studentFiles->is_systemadd ?? -1
        ];
    }
    
    public static function Report($report){
        return [
            'id' => $report->file_id,
            'sno' => $report->sno,
            'title' => $report->file_title,
            'content' => $report->file_content,
            'addTime' => $report->file_addtime,
            'dealTime' => $report->file_dealtime,
            'type' => $report->file_type,
            'status' => $report->file_status,
            'systemAdd' => $report->is_systemadd
        ];
    }

    public static function Summary($summary){
        return [
            'id' => $summary->file_id,
            'sno' => $summary->sno,
            'title' => $summary->file_title,
            'content' => $summary->file_content,
            'addTime' => $summary->file_addtime,
            'dealTime' => $summary->file_dealtime,
            'type' => $summary->file_type,
            'status' => $summary->file_status,
            'systemAdd' => $summary->is_systemadd
        ];
    }

    public static function Message($message){
        return [
            'id' => $message->message_id ?? -1,
            'fromSno' => $message->form_user_no ?? '',
            'fromName' => $message->fromUser->username ?? '',
            'toSno' => $message->to_user_no ?? '',
            'toName' => $message->toUser->username ?? '',
            'title' => $message->message_title ?? '',
            'content' => $message->message_content ?? '',
            'type' => $message->message_type ?? '',
            'isRead' => $message->message_isread ?? '',
            'isHandled' => $message->message_ishandled ?? -1,
            'isDeleted' => $message->message_isdeleted ?? -1,
            'sendTime' => $message->message_sendtime ?? -1
        ];
    }

    public static function File($file)
    {
        return [
            'id'        => $file->id,
            'path'      => $file->file_path,
            'name'      => $file->file_name,
            'size'      => $file->file_size,
            'extension' => $file->file_extension,
            'usage'     => $file->file_usage
        ];
    }

    public static function Column($column)
    {
        return [
            'id'   => $column->column_id,
            'pid'  => $column->column_pid,
            'name' => $column->column_name
        ];
    }

    public static function Module($module)
    {

//        dd($module);
        $route = $module->route_id ? self::Routes($module->route) : null;
        return [
            'id'        => $module->self_id,
            'parent_id' => $module->parent_id,
            'name'      => $module->name,
            'url'       => $module->url,
            'route'     => $route,
            'icon'      => $module->icon,
            'is_show'   => $module->is_show,
            'auth'      => $module->auth
        ];
    }

    public static function RouteGroups($group)
    {
        $subRoutes = $group->subRoutes->all();
        return [
            'id'        => $group->id,
            'parentId'  => $group->parent_id,
            'options'   => json_decode($group->options),
            'desc'      => $group->desc,
            'subRoutes' => empty($subRoutes) ? null : array_map(function ($route) {
                return self::Routes($route);
            }, $subRoutes),
            'subGroups' => null
        ];
    }

    public static function Routes($route)
    {
//        dd($route);
        return [
            'id'      => $route->id,
            'groupId' => $route->group_id,
            'url'     => json_decode($route->url),
            'method'  => $route->method,
            'action'  => $route->action,
            'desc'    => $route->desc,
        ];
    }

    public static function UserInfo($user){
        return [
            'userNumber'    => $user->user_number,
            'userName'      => $user->username,
            'majorId'       => $user->major,
            'major'         => $user->major_name,
            'collegeId'     => $user->college_id,
            'college'       => $user->college->collegename,
            'partyBranchId' => $user->info->partybranch_id,
            'partyBranch'   => $user->info->partyBranch->partybranch_name ?? '',
            'grade'         => $user->grade,
            'type'          => $user->type,
        ];
    }

    public static function Manager($manager){
        return [
            'id'        => $manager->manager_id,
            'twtName'      => $manager->manager_name,
            'userNumber'=> $manager->user->usernumb ?? '',
            'realName'  => $manager->user->username ?? '',
            'academy'   => $manager->manager_academy,
            'type'      => $manager->manager_type,
            'status'    => $manager->manager_status,
            'columnGrant' => $manager->manager_columngrant,
            'imgId'     => $manager->img_id,
            'lastLoginTime' => $manager->last_logintime,
            'isDeleted' => $manager->manager_isdeleted
        ];
    }

    public static function test()
    {
        return [
            'id'           => 1,
            'name'         => 'www',
            'color'        => 'yellow',
            'hhhhcolor'    => 'red',
            'hhhhhhhcolor' => 'r',
        ];
    }
}
