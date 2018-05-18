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
    // 党员推荐
    const MEMBER_RECOMMENDATION = 20;
    // 党员推荐 && 团支部推优
    const COMMUNIST_MEMBER_RECOMMENDATION = 22;
    // 团支部推优 && 入党积极分子
//    const ACTIVIST_COMMUNIST = 23;
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
    // 支部组织生活和党内活动
    const PARTY_ORGANIZATION = 11;
    // 党员转正公示
    const CORRECT_PUBLICITY = 12;
    // 召开转正大会表决通过
    const VOTE_PASSED = 13;
    // 党委审批
    const PARTY_APPROVAL = 14;
    // 正式党员
    const FORMAL_MEMBER = 15;

    public static function warpStatus(& $item, $key = 'mainStatus'){
        if(isset($item[$key])){
            switch($item[$key]){
                case self::APPLICANT:
                    $item[$key] = '申请人';
                    break;
                case self::ACTIVIST:
                    $item[$key] = '入党积极分子';
                    break;
                case self::COMMUNIST:
                    $item[$key] = '团支部推优';
                    break;
                case self::ACTIVIST_COMMUNIST:
                    $item[$key] = '团支部推优 && 入党积极分子';
                    break;
                case self::DEVELOPMENT_TARGET:
                    $item[$key] = '发展对象';
                    break;
                case self::CENTRALIZED_TRAINING:
                    $item[$key] = '集中培训';
                    break;
                case self::MATERIAL_READY:
                    $item[$key] = '入党资料是否齐全';
                    break;
                case self::REPORT_TO_SUPERIOR:
                    $item[$key] = '向上级党组织汇报';
                    break;
                case self::DEVELOPMENT_PUBLICITY:
                    $item[$key] = '党员发展公示';
                    break;
                case self::PARTY_BRANCH_VOTING:
                    $item[$key] = '召开发展大会';
                    break;
                case self::COMMITTEE_APPROVAL:
                    $item[$key] = '党员谈话';
                    break;
                case self::PROBATIONARY:
                    $item[$key] = '预备党员';
                    break;
                case self::PARTY_ORGANIZATION:
                    $item[$key] = '支部组织生活和党内活动';
                    break;
                case self::CORRECT_PUBLICITY:
                    $item[$key] = '党员转正公示';
                    break;
                case self::VOTE_PASSED:
                    $item[$key] = '召开转正大会表决通过';
                    break;
                case self::PARTY_APPROVAL:
                    $item[$key] = '党委审批';
                    break;
                case self::FORMAL_MEMBER:
                    $item[$key] = '正式党员';
                    break;
            }
        }
        return $item;
    }
}