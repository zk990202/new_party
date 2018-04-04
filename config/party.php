<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 11:51 AM
 */

return [
    'namespace' => 'App\\Http\\Service\\PartyStatus\\',
    // 入党申请书
    'PartyApplication' => [
        'dependsOn' => [],
        'determines'=> ['ApplicantPartySchool', 'IdeologicalReport_1', 'ApplicantLearningGroup']
    ],
    // 申请人党校学习
    'ApplicantPartySchool' => [
        'dependsOn' => ['PartyApplication'],
        'determines'=> ['ApplicantFinalExam']
    ],
    //结业考试
    'ApplicantFinalExam' => [
        'dependsOn' => ['ApplicantPartySchool'],
        'determines'=> ['AcademyPartySchool']
    ],
    // 院级积极分子党校学习
    'AcademyPartySchool' => [
        'dependsOn' => ['ApplicantFinalExam'],
        'determines'=> ['DevelopmentTarget']
    ],
    // 第一季度思想汇报
    'IdeologicalReport_1' => [
        'dependsOn' => ['PartyApplication'],
        'determines'=> ['IdeologicalReport_2']
    ],
    'IdeologicalReport_2' => [
        'dependsOn' => ['IdeologicalReport_1'],
        'determines'=> ['IdeologicalReport_3']
    ],
    'IdeologicalReport_3' => [
        'dependsOn' => ['IdeologicalReport_2'],
        'determines'=> ['IdeologicalReport_4']
    ],
    'IdeologicalReport_4' => [
        'dependsOn' => ['IdeologicalReport_3'],
        'determines'=> ['DevelopmentTarget']
    ],
    // 申请人学习小组
    'ApplicantLearningGroup' => [
        'dependsOn' => ['PartyApplication'],
        'determines'=> ['PartyActivist']
    ],
    // 入党积极分子
    'PartyActivist' => [
        'dependsOn' => ['ApplicantLearningGroup'],
        'determines'=> ['DevelopmentTarget']
    ],
    // 团支部推优
    'CommunistPartyBranch' => [
        'dependsOn' => ['ApplicantLearningGroup'],
        'determines'=> ['DevelopmentTarget']
    ],
    // 发展对象
    'DevelopmentTarget' => [
        'dependsOn' => ['AcademyPartySchool', 'IdeologicalReport_4', 'PartyActivist', 'CommunistPartyBranch'],
        'determines'=> ['CentralizedTraining']
    ],
    // 集中培训
    'CentralizedTraining' => [
        'dependsOn' => ['DevelopmentTarget'],
        'determines'=> ['MaterialsReady']
    ],
    // 入党材料准备齐全
    'MaterialsReady' => [
        'dependsOn' => ['CentralizedTraining'],
        'determines'=> ['ReportToSuperior']
    ],
    // 向党组织汇报
    'ReportToSuperior' => [
        'dependsOn' => ['MaterialsReady'],
        'determines'=> ['DevelopmentPublicity']
    ],
    // 党员发展公示
    'DevelopmentPublicity' => [
        'dependsOn' => ['ReportToSuperior'],
        'determines'=> ['VolunteerBook']
    ],
    // 填写入党志愿书
    'VolunteerBook' => [
        'dependsOn' => ['DevelopmentPublicity'],
        'determines'=> ['PartyBranchVoting']
    ],
    // 召开发展大会，党支部表决
    'PartyBranchVoting' => [
        'dependsOn' => ['VolunteerBook'],
        'determines'=> ['CommitteeApproval']
    ],
    // 党委谈话，审批
    'CommitteeApproval' => [
        'dependsOn' => ['PartyBranchVoting'],
        'determines'=> ['ProbationaryMember']
    ],
    // 成为预备党员
    'ProbationaryMember' => [
        'dependsOn' => ['CommitteeApproval'],
        'determines'=> ['ProbationarySchool', 'PersonalSummary_1', 'PartyOrganization']
    ],
    // 预备党员党校学习
    'ProbationarySchool' => [
        'dependsOn' => ['ProbationaryMember'],
        'determines'=> ['CorrectApplication']
    ],
    // 个人小结
    'PersonalSummary_1' => [
        'dependsOn' => ['ProbationaryMember'],
        'determines'=> ['PersonalSummary_2']
    ],
    'PersonalSummary_2' => [
        'dependsOn' => ['PersonalSummary_1'],
        'determines'=> ['PersonalSummary_3']
    ],
    'PersonalSummary_3' => [
        'dependsOn' => ['PersonalSummary_2'],
        'determines'=> ['PersonalSummary_4']
    ],
    'PersonalSummary_4' => [
        'dependsOn' => ['PersonalSummary_3'],
        'determines'=> ['CorrectApplication']
    ],
    //参加党支部活动
    'PartyOrganization' => [
        'dependsOn' => ['ProbationaryMember'],
        'determines'=> ['CorrectApplication']
    ],
    // 递交转正申请
    'CorrectApplication' => [
        'dependsOn' => ['ProbationarySchool', 'PersonalSummary_4', 'PartyOrganization'],
        'determines'=> ['CorrectPublicity']
    ],
    // 党员转正公示
    'CorrectPublicity' => [
        'dependsOn' => ['CorrectApplication'],
        'determines'=> ['VotePassed']
    ],
    // 表决通过
    'VotePassed' => [
        'dependsOn' => ['CorrectPublicity'],
        'determines'=> ['PartyApproval']
    ],
    // 党委审批
    'PartyApproval' => [
        'dependsOn' => ['VotePassed'],
        'determines'=> ['FormalMember']
    ],
    // 成为正式党员
    'FormalMember' => [
        'dependsOn' => ['PartyApproval'],
        'determines'=> []
    ],

];