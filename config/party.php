<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 11:51 AM
 */

return [
    'namespace' => 'App\\Http\\Service\\PartyStatus\\',
    'nodes' => [
        // 入党申请人
        'PartyApplication' => [
            'name'      => '提交入党申请书',
            'dependsOn' => [],
            'determines'=> ['ApplicantPartySchool', 'IdeologicalReport_1', 'ApplicantLearningGroup']
        ],
        // 申请人党校学习
        'ApplicantPartySchool' => [
            'name'      => '网上申请人党校学习',
            'dependsOn' => ['PartyApplication'],
            'determines'=> ['ApplicantFinalExam']
        ],
        //结业考试
        'ApplicantFinalExam' => [
            'name'      => '结业考试',
            'dependsOn' => ['ApplicantPartySchool'],
            'determines'=> ['AcademyPartySchool']
        ],
        // 院级积极分子党校学习
        'AcademyPartySchool' => [
            'name'      => '院级积极分子党校学习',
            'dependsOn' => ['ApplicantFinalExam'],
            'determines'=> ['DevelopmentTarget']
        ],
        // 第一季度思想汇报
        'IdeologicalReport_1' => [
            'name'      => '第一季度思想汇报',
            'dependsOn' => ['PartyApplication'],
            'determines'=> ['IdeologicalReport_2']
        ],
        'IdeologicalReport_2' => [
            'name'      => '第二季度思想汇报',
            'dependsOn' => ['IdeologicalReport_1'],
            'determines'=> ['IdeologicalReport_3']
        ],
        'IdeologicalReport_3' => [
            'name'      => '第三季度思想汇报',
            'dependsOn' => ['IdeologicalReport_2'],
            'determines'=> ['IdeologicalReport_4']
        ],
        'IdeologicalReport_4' => [
            'name'      => '第四季度思想汇报',
            'dependsOn' => ['IdeologicalReport_3'],
            'determines'=> ['DevelopmentTarget']
        ],
        // 申请人学习小组
        'ApplicantLearningGroup' => [
            'name'      => '参加申请人学习小组',
            'dependsOn' => ['PartyApplication'],
            'determines'=> ['PartyActivist', 'CommunistPartyBranch']
        ],
        // 入党积极分子
        'PartyActivist' => [
            'name'      => '被确认为入党积极分子',
            'dependsOn' => ['ApplicantLearningGroup'],
            'determines'=> ['DevelopmentTarget']
        ],
        // 团支部推优
        'CommunistPartyBranch' => [
            'name'      => '团支部推优',
            'dependsOn' => ['ApplicantLearningGroup'],
            'determines'=> ['DevelopmentTarget']
        ],
        // 发展对象
        'DevelopmentTarget' => [
            'name'      => '成为发展对象',
            'dependsOn' => ['AcademyPartySchool', 'IdeologicalReport_4', 'PartyActivist', 'CommunistPartyBranch'],
            'determines'=> ['CentralizedTraining']
        ],
        // 集中培训
        'CentralizedTraining' => [
            'name'      => '参加集中培训',
            'dependsOn' => ['DevelopmentTarget'],
            'determines'=> ['MaterialsReady']
        ],
        // 入党材料准备齐全
        'MaterialsReady' => [
            'name'      => '入党材料准备齐全',
            'dependsOn' => ['CentralizedTraining'],
            'determines'=> ['ReportToSuperior']
        ],
        // 向党组织汇报
        'ReportToSuperior' => [
            'name'      => '向上级党组织汇报',
            'dependsOn' => ['MaterialsReady'],
            'determines'=> ['DevelopmentPublicity']
        ],
        // 党员发展公示
        'DevelopmentPublicity' => [
            'name'      => '党员发展公示',
            'dependsOn' => ['ReportToSuperior'],
            'determines'=> ['VolunteerBook']
        ],
        // 填写入党志愿书
        'VolunteerBook' => [
            'name'      => '填写入党志愿书',
            'dependsOn' => ['DevelopmentPublicity'],
            'determines'=> ['PartyBranchVoting']
        ],
        // 召开发展大会，党支部表决
        'PartyBranchVoting' => [
            'name'      => '召开发展大会，党支部表决',
            'dependsOn' => ['VolunteerBook'],
            'determines'=> ['CommitteeApproval']
        ],
        // 党委谈话，审批
        'CommitteeApproval' => [
            'name'      => '党委谈话，审批',
            'dependsOn' => ['PartyBranchVoting'],
            'determines'=> ['ProbationaryMember']
        ],
        // 成为预备党员
        'ProbationaryMember' => [
            'name'      => '成为预备党员',
            'dependsOn' => ['CommitteeApproval'],
            'determines'=> ['ProbationarySchool', 'PersonalSummary_1', 'PartyOrganization']
        ],
        // 预备党员党校学习
        'ProbationarySchool' => [
            'name'      => '预备党员党校学习',
            'dependsOn' => ['ProbationaryMember'],
            'determines'=> ['CorrectApplication']
        ],
        // 个人小结
        'PersonalSummary_1' => [
            'name'      => '第一季度个人小结',
            'dependsOn' => ['ProbationaryMember'],
            'determines'=> ['PersonalSummary_2']
        ],
        'PersonalSummary_2' => [
            'name'      => '第二季度个人小结',
            'dependsOn' => ['PersonalSummary_1'],
            'determines'=> ['PersonalSummary_3']
        ],
        'PersonalSummary_3' => [
            'name'      => '第三季度个人小结',
            'dependsOn' => ['PersonalSummary_2'],
            'determines'=> ['PersonalSummary_4']
        ],
        'PersonalSummary_4' => [
            'name'      => '第四季度个人小结',
            'dependsOn' => ['PersonalSummary_3'],
            'determines'=> ['CorrectApplication']
        ],
        //参加党支部活动
        'PartyOrganization' => [
            'name'      => '按时参加党支部组织生活及党内活动',
            'dependsOn' => ['ProbationaryMember'],
            'determines'=> ['CorrectApplication']
        ],
        // 递交转正申请
        'CorrectApplication' => [
            'name'      => '递交转正申请',
            'dependsOn' => ['ProbationarySchool', 'PersonalSummary_4', 'PartyOrganization'],
            'determines'=> ['CorrectPublicity']
        ],
        // 党员转正公示
        'CorrectPublicity' => [
            'name'      => '党员转正公示',
            'dependsOn' => ['CorrectApplication'],
            'determines'=> ['VotePassed']
        ],
        // 表决通过
        'VotePassed' => [
            'name'      => '党支部召开转正大会',
            'dependsOn' => ['CorrectPublicity'],
            'determines'=> ['PartyApproval']
        ],
        // 党委审批
        'PartyApproval' => [
            'name'      => '党委审批',
            'dependsOn' => ['VotePassed'],
            'determines'=> ['FormalMember']
        ],
        // 成为正式党员
        'FormalMember' => [
            'name'      => '成为正式党员',
            'dependsOn' => ['PartyApproval'],
            'determines'=> []
        ],

    ]
];