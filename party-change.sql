/*
ALTER TABLE twt_notification ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_specialnews ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_specialnews CHANGE summary summary VARCHAR(100) NULL;
ALTER TABLE twt_commonfiles ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_applicant_articlelist ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_applicant_articlelist ADD COLUMN created_at datetime ;
ALTER TABLE twt_applicant_exerciselist ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_applicant_exerciselist ADD COLUMN created_at datetime ;
ALTER TABLE twt_applicant_testlist ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_cert ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_applicant_entryform  ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_certlost  ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_complain  ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_student_info  ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_academy_testlist ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_academy_entryform  ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_probationary_trainlist ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_probationary_courselist  ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_probationary_entryform  ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_probationary_childentryform  ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_partybranch   ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE b_userinfo   ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_logincount   ADD COLUMN updated_at datetime ON UPDATE CURRENT_TIMESTAMP();
ALTER TABLE twt_probationary_entryform ADD COLUMN isdeleted INT(5) DEFAULT 0;
ALTER TABLE twt_probationary_childentryform  ADD COLUMN isdeleted INT(5) DEFAULT 0;
ALTER TABLE twt_partybranch CHANGE partybranch_total_reply partybranch_total_reply INT(11) NOT NULL DEFAULT 0;
ALTER TABLE twt_partybranch CHANGE partybranch_total_topic partybranch_total_topic INT(11) NOT NULL DEFAULT 0;
ALTER TABLE twt_partybranch CHANGE partybranch_total_act partybranch_total_act INT(11) NOT NULL DEFAULT 0;
ALTER TABLE twt_logincount  ADD COLUMN created_at datetime ;

ALTER TABLE twt_commonfiles CHANGE file_addtime file_addtime datetime;
*/
-- userinfo表更新
/*
ALTER TABLE b_userinfo ADD COLUMN username VARCHAR(60) NOT NULL;
ALTER TABLE b_userinfo ADD COLUMN gender TINYINT(4) DEFAULT 1;
ALTER TABLE b_userinfo ADD COLUMN sso_token VARCHAR(255) DEFAULT NULL;
ALTER TABLE b_userinfo ADD COLUMN last_login DATETIME DEFAULT NULL;
ALTER TABLE b_userinfo CHANGE usernumb user_number VARCHAR(20) NOT NULL;
ALTER TABLE b_userinfo CHANGE partybranchid party_branch_id INT(11);
ALTER TABLE b_userinfo DROP COLUMN departmentid;
ALTER TABLE b_userinfo CHANGE collegeid college_id INT(10);
ALTER TABLE b_userinfo CHANGE lastschool last_school VARCHAR(255);
ALTER TABLE b_userinfo DROP COLUMN oldcollegeid;
ALTER TABLE b_userinfo CHANGE classid class_id INT(11);
ALTER TABLE b_userinfo CHANGE stuintime stu_in_time VARCHAR(50);
ALTER TABLE b_userinfo DROP COLUMN gradeadd;
ALTER TABLE b_userinfo DROP COLUMN state;
ALTER TABLE b_userinfo CHANGE majorname major_name VARCHAR(200);
ALTER TABLE b_userinfo DROP COLUMN stucity;
ALTER TABLE b_userinfo CHANGE COLUMN politicalface political_face VARCHAR(50);

DROP TABLE b_party;
DROP TABLE intro;

ALTER TABLE twt_academy_testlist CHANGE test_begintime test_begintime datetime DEFAULT null;
-- 2018-04-17
ALTER TABLE twt_probationary_trainlist CHANGE train_gradeserach_status train_gradesearch_status TINYINT(4) DEFAULT 0 NOT NULL;
*/
-- 2018-04-20
CREATE TABLE `twt_applicant_exerciseanswertransform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
`exercise_answer_number` int(11) NOT NULL COMMENT '题目答案的代码',
`exercise_answer_letter` char(11) NOT NULL COMMENT '题目答案的字母',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `twt_applicant_exerciseanswertransform`(`exercise_answer_number`, `exercise_answer_letter`) VALUES
  (1, 'A'),(2, 'B'),(3, 'AB'),(4, 'C'),(5, 'AC'),(6, 'BC'),(7, 'ABC'),(8, 'D'),(9, 'AD'),(10, 'BD'),(11, 'ABD'),(12, 'CD'),(13, 'ACD'),(14, 'BCD'),(15, 'ABCD'),
  (16, 'E'),(17, 'AE'),(18, 'BE'),(19, 'ABE'),(20, 'CE'),(21, 'ACE'),(22, 'BCE'),(23, 'ABCE'),(24, 'DE'),(25, 'ADE'),(26, 'BDE'),(27, 'ABDE'),(28, 'CDE'),
  (29, 'ACDE'),(30, 'BCDE'),(31, 'ABCDE');
	
-- 2018-04-25 删除UserInfo表中partyBranchId字段，增加Type字段，Type使用SSO中Type定义
ALTER TABLE b_userinfo DROP COLUMN party_branch_id;
ALTER TABLE b_userinfo ADD COLUMN type TINYINT(4);
-- 以下操作需要从基础库把user表考过来
-- UPDATE b_userinfo, twt_userinfos SET b_userinfo.type = twt_userinfos.type WHERE b_userinfo.user_number = twt_userinfos.user_number;