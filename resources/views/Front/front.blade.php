<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=yes"/>
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" />
    <title>党建</title>
    <link rel="stylesheet" href="/jquery/head.css" type="text/css" />
    <script src="/jquery/jquery-3.2.1.js"></script>
    <script src="/jquery/head.js"></script>
    <script src="/jquery/child-list.js"></script>
    <script src="/jquery/show.js"></script>
</head>
<style>

    li{
        list-style: none;
        padding: 0px;
        margin: 0px;
    }
    .picture{
        width: 62.5%;
        height: 290px;
        margin:0 auto;
        border: 1px solid black;

    }
    .text{
        width: 100%;
        height: 30px;
        margin-top: 238px;
        background: rgba(0,0,0,0.35);
        color: rgba(255,255,255,0.7);
        text-align: center;
        padding-top: 5px;
    }
    .land a{
        color: white;
        font-size: 14px;
        text-decoration: none;
    }
    .item1{
        height: 140px;
        width: 62.5%;
        margin: 0 auto;
        margin-top: 20px;
    }
    .module span{
        color: black;
        font-size:11px;

    }
    .module p{
        color: rgba(215,0,0,1);
        font-size: 11px;
        text-align: left;
        margin-top: 8px;
        margin-bottom: 4px;
    }
    .item1-img{
        width: 15px;
        height: 15px;
        float: left;
        margin-left: 10px;
        margin-top: 8px;
        margin-right: 10px;
    }
    .state{
        width:36% ;
        height: 140px;
        float: left;
        background: rgba(252,250,251,1);
        text-align: center;
    }
    .notice{
        width: 62%;
        height: 140px;
        float: right;
        background: rgba(252,250,251,1);
    }
    .btn{
        color: rgba(252,250,251,1);
        background: rgba(215,0,0,1);
        width: 30%;
        height: 30px;
        margin-top: 25px;
        border: none;
    }

    hr{
        border-top: 1px solid pink;
        width: 70%;
        margin-top: 1px;
        margin-bottom: 1px;
    }
    .news{
        margin-right: 40px;
        margin-left: 50px;
    }
    .special{
        width: 49%;
        height: 140px;
        background: rgba(252,250,251,1);
        float: left;
    }
    .special1{
        width: 49%;
        height: 140px;
        background: rgba(252,250,251,1);
        float: right;
    }
    .item-pic{
        width:45%;
        height:105px;
        position: relative;
        float: left;
        margin-left: 20px;
        margin-right: 10px;
    }
    .item4{
        width: 62.5%;
        height: 112px;
        margin: 0 auto;
        margin-top: 20px;
    }
    .item2-pic {
        width: 24%;
        height: 112px;
        position: relative;
        float: left;
    }
    .item2-pic1 {
        width: 24%;
        height: 112px;
        position: relative;
        float: left;
    }
    .model{
        width: 49%;
        height: 112px;
        position:relative;
        background: rgba(252,250,251,1);
        float: left;
        margin-left: 16px;
        margin-right: 17px;
    }
    .item5{
        width: 62.5%;
        height: 140px;
        background: rgba(252,250,251,1);
        margin: 0 auto;
        margin-top: 20px;
        position: relative;
    }
    .index{
        font-size: 12px;
    }
    .index span{
        color: gray;
    }
    .str{
        width: 30%;
        height:70px;
        float: left;
        margin-right: 10px;
        margin-left: 20px;
    }
    .end{
        width: 15%;
        height: 92px;
        float: left;
        margin-left: 35px;
    }
    .end img{
        width: 100%;
        height:60px;
    }
    .end p{
        color: gray;
    }
    @media screen and (max-width:1800px){
        .item2-pic{
            width: 23.5%;
        }
        .item2-pic1{
            width: 23.5%;
        }
    }
    @media screen and (max-width:1400px){
        .notice li,.special li, .special1 li ,.model li{
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .item2-pic{
            width: 23%;
        }
        .item2-pic1{
            width: 24%;
        }

    }
    @media screen and (max-width:1350px){
        .item2-pic{
            width: 23%;
        }
        .item2-pic1{
            width: 24%;
        }
        .model{
            margin-right: 15px;
            margin-left: 15px;
        }
    }
    @media screen and (max-width:1300px){
        .index span{
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .end p{
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .end{
            width: 13.5%;
        }
    }
    @media screen and (max-width:1210px){
        .item2-pic{
            width: 23%;
        }
        .item2-pic1{
            width: 23%;
        }
        .model{
            margin-right: 13px;
            margin-left: 13px;
        }
    }
    @media screen and (max-width:860px){
        .model{
            margin-right: 12px;
            margin-left: 12px;
        }
    }
    @media screen and (max-width: 840px){
        .state{
            float: none;
            width: 100%;
        }
        .notice{
            float: none;
            width: 100%;
            margin-top: 10px;
        }
        .special{
            float: none;
            width: 100%;
            margin-top: 160px;
        }
        .special1{
            float: none;
            width: 100%;
        }
        .module p{
            padding-top: 8px;
        }
        .item4{
            margin-top: 160px;
        }
        .item4 p{
            padding-top: 0;
        }
        .item2-pic{
            float: left;
            width: 48%;
        }
        .item2-pic1{
            float: right;
            width: 48%;
            margin-top: -255px;
        }
        .model{
            width: 100%;
            margin: 15px auto;
        }
        .item5{
            margin-top: 145px;
        }
    }
    @media screen and (max-width:900px){
        .item5{
            height: 230px;
        }
    }
</style>
<body>
<div class="header">
    <div class="system">
        <img  src="/jquery/img3/partybuild_logo.png"/>
    </div>

    <nav>
        <ul>
            <li class="list">
                <a href="{{ url('/api/index') }}" class="menu">首页</a>
            </li>
            <li class="list"><a href="#" class="menu">网上党校</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('api/applicant/course') }}">申请人培训</a></li>
                    <li><a href="{{ url('api/academy/course') }}">积极分子培训</a></li>
                    <li><a href="{{ url('api/probationary/course') }}">预备党员培训</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">我的支部</a>
                <ul class="sub-menu">
                    <li><a href="Ownness.html">个人状态</a></li>
                    <li><a href="detial.html">支部详情</a></li>
                    <li><a href="member-list.html">支部成员列表</a></li>
                    <li><a href="#">我的学习小组</a></li>
                    <li><a href="#">上传文献查看</a></li>
                    <li><a href="#">我的消息</a></li>
                    <li><a href="#">我的申诉</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">通知公告</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('/api/notice/party-school/list/applicant') }}">申请人培训</a></li>
                    <li><a href="{{ url('/api/notice/party-school/list/academy') }}">院积极分子培训</a></li>
                    <li><a href="{{ url('/api/notice/party-school/list/probationary') }}">预备党员培训</a></li>
                    <li><a href="{{ url('/api/notice/party-school/list/secretary') }}">党支部书记培训</a></li>
                    <li><a href="{{ url('/api/notice/activity/list') }}">活动通知</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">党建专项</a>
                <ul class="sub-menu">
                    <li><a href="Hero.html">身边的英雄</a></li>
                    <li><a href="CentralSpirit.html">中央精神</a></li>
                    <li><a href="MassLine.html">群众路线</a></li>
                    <li><a href="ChineseDream.html">中国梦</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">党建培训</a>
                <ul class="sub-menu">
                    <li><a href="PressCenter.html">新闻中心</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">重要文件</a>
                <ul class="sub-menu">
                    <li><a href="ImportantFiles.html">规章制度</a></li>
                    <li><a href="RegularlyFile.html">常用文书</a></li>
                    <li><a href="MustRead.html">入党必读</a></li>
                    <li><a href="SystemBook.html">系统手册</a></li>
                </ul>
            </li>



            <li class="list"><a href="#" class="menu">支部风采</a>
                <ul class="sub-menu">
                    <li><a href="#">我的社区</a></li>
                    <li><a href="#">全部社区</a></li>
                    <li><a href="#">全部社区话题</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="land">
        <img src="/jquery/img3/login.png" style="width: 17px; height: 17px"/>
        @if(!$userInfo)
            <a href="{{ url('/login') }}">登录</a>
        @else
            <a href="{{ url('/api/index') }}">登出</a>
        @endif
    </div>
</div>
<div class="respond">
    <div>
        <a href="#" class="enable">
            <img src="/jquery/img3/menu.png" />
        </a>
    </div>
    <div class="child-list">
        <p><a href="{{ url('api/index') }}">首页</a></p>
        <p><a href="#">网上党校</a></p>
        <ul>
            <li><a href="{{ url('api/applicant/course') }}">申请人培训</a></li>
            <li><a href="{{ url('api/academy/course') }}">积极分子培训</a></li>
            <li><a href="{{ url('api/probationary/course') }}">预备党员培训</a></li>
        </ul>

        <p><a href="#">我的支部</a></p>
        <ul>
            <li><a href="Ownness.html">个人状态</a></li>
            <li><a href="detial.html">支部详情</a></li>
            <li><a href="member-list.html">支部成员列表</a></li>
            <li><a href="#">我的学习小组</a></li>
            <li><a href="#">上传文献查看</a></li>
            <li><a href="#">我的消息</a></li>
            <li><a href="#">我的申诉</a></li>
        </ul>

        <p><a href="#">通知公告</a></p>
        <ul>
            <li><a href="{{ url('/api/notice/party-school/list/applicant') }}">申请人培训</a></li>
            <li><a href="{{ url('/api/notice/party-school/list/academy') }}">院积极分子培训</a></li>
            <li><a href="{{ url('/api/notice/party-school/list/probationary') }}">预备党员培训</a></li>
            <li><a href="{{ url('/api/notice/party-school/list/secretary') }}">党支部书记培训</a></li>
            <li><a href="{{ url('/api/notice/activity/list') }}">活动通知</a></li>
        </ul>

        <p><a href="#">党建专项</a></p>
        <ul>
            <li><a href="Hero.html">身边的英雄</a></li>
            <li><a href="CentralSpirit.html">中央精神</a></li>
            <li><a href="MassLine.html">群众路线</a></li>
            <li><a href="ChineseDream.html">中国梦</a></li>
        </ul>

        <p><a href="#">党建培训</a></p>
        <ul>
            <li><a href="PressCenter.html">新闻中心</a></li>
        </ul>

        <p><a href="#">重要文件</a></p>
        <ul>
            <li><a href="ImportantFiles.html">规章制度</a></li>
            <li><a href="RegularlyFile.html">常用文书</a></li>
            <li><a href="MustRead.html">入党必读</a></li>
            <li><a href="SystemBook.html">系统手册</a></li>
        </ul>
        <p><a href="#">理论学习</a></p>
        <ul>
            <li><a href="TheoryStudy.html">理论经典</a></li>
        </ul>

        <p><a href="#">支部风采</a></p>
        <ul>
            <li><a href="#">我的社区</a></li>
            <li><a href="#">全部社区</a></li>
            <li><a href="#">全部社区话题</a></li>
        </ul>
    </div>
</div>
<div class="picture">
    <img />
    <p class="text">党建系统新版回归</p>
</div>
<div class="foot">
    <p>Copyright © 2013 TWT Studio.All rights reserved</p>
</div>
</body>
</html>
