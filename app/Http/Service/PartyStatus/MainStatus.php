<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2018/4/3
 * Time: 1:56 PM
 */
namespace App\Http\Service\PartyStatus;
class MainStatus{
    // 入党申请人
    const APPLICANT = 0;
    // 入党积极分子
    const ACTIVIST = 1;
    // 团支部推优
    const COMMUNIST = 2;
    // 团支部推优 && 入党积极分子
    const ACTIVIST_COMMUNIST = 23;
    // 发展对象
    const DEVELOPMENT_TARGET = 3;
    // 集中培训
    const CENTRALIZED_TRAINING = 4;
    // 入党资料是否齐全
    const MATERIAL_READY = 5;
    // 向上级党组织汇报
    const REPORT_TO_SUPERIOR = 6;
    // 党员发展公示
    const DEVELOPMENT_PUBLICITY = 7;
    // 召开发展大会
    const PARTY_BRANCH_VOTING = 8;
    // 党员谈话
    const COMMITTEE_APPROVAL = 9;
    // 预备党员
    const PROBATIONARY = 10;
}