<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 11:51 AM
 */

return [
    'namespace' => 'App\\Http\\Service\\PartyStatus\\',
    'PartyApplication' => [
        'dependsOn' => [],
        'determines'=> ['ApplicantPartySchool', 'IdeologicalReport_1', 'ApplicantLearningGroup']
    ],
    'ApplicantPartySchool' => [
        'dependsOn' => ['PartyApplication'],
        'determines'=> ['ApplicantFinalExam']
    ],
    'ApplicantFinalExam' => [
        'dependsOn' => ['ApplicantPartySchool'],
        'determines'=> ['AcademyPartySchool']
    ],
    'AcademyPartySchool' => [
        'dependsOn' => ['ApplicantFinalExam'],
        'determines'=> ['DevelopmentTarget']
    ],
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
    'ApplicantLearningGroup' => [
        'dependsOn' => ['PartyApplication'],
        'determines'=> ['PartyActivist']
    ],
    'PartyActivist' => [
        'dependsOn' => ['ApplicantLearningGroup'],
        'determines'=> ['DevelopmentTarget']
    ],
    'CommunistPartyBranch' => [
        'dependsOn' => ['ApplicantLearningGroup'],
        'determines'=> ['DevelopmentTarget']
    ],
    'DevelopmentTarget' => [
        'dependsOn' => ['AcademyPartySchool', 'IdeologicalReport_4', 'PartyActivist', 'CommunistPartyBranch'],
        'determines'=> ['CentralizedTraining']
    ],
    'CentralizedTraining' => [
        'dependsOn' => ['DevelopmentTarget'],
        'determines'=> ['MaterialsReady']
    ],
    'MaterialsReady' => [
        'dependsOn' => ['CentralizedTraining'],
        'determines'=> ['ReportToSuperior']
    ],
    'ReportToSuperior' => [
        'dependsOn' => ['MaterialsReady'],
        'determines'=> ['DevelopmentPublicity']
    ],
    'DevelopmentPublicity' => [
        'dependsOn' => ['ReportToSuperior'],
        'determines'=> ['VolunteerBook']
    ],
    'VolunteerBook' => [
        'dependsOn' => ['DevelopmentPublicity'],
        'determines'=> ['PartyBranchVoting']
    ],
    'PartyBranchVoting' => [
        'dependsOn' => ['VolunteerBook'],
        'determines'=> ['CommitteeApproval']
    ],
    'CommitteeApproval' => [
        'dependsOn' => ['PartyBranchVoting'],
        'determines'=> ['determines']
    ],
    'ProbationaryMember' => [
        'dependsOn' => ['CommitteeApproval'],
        'determines'=> []
    ],

];