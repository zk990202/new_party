@extends('front.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/homePage.css" type="text/css" />
@show

<body>
@section('main')
    <div class="picture" >
        <div class="wrap" id="wrap">
            <div class="showpic" style="display: block">
                <img src="/img3/homePage1.jpg">
            </div>
            <div class="showpic"><img src="/img3/homePage1.jpg"></div>
            <div class="showpic"><img src="/img3/homePage2.jpg"></div>
            <div class="showpic"><img src="/img3/homePage1.jpg"></div>
            <div class="showpic"><img src="/img3/homePage2.jpg"></div>
            <div class="showpic"><img src="/img3/homePage1.jpg"></div>
        </div>
    </div>
<p class="text">党建系统新版回归</p>
<div class="module">
    <div class="item1">
        <div class="state">
            <img src="/img3/user.png" class="item1-img"/>
            <p>个人状态</p>
            <span>登陆查看个人状态</span>
            <br/>
            <input type="button" value="登录"  class="btn"/>
        </div>
        <div class="notice">
            <img src="/img3/notice.png" class="item1-img"/>
            <p>最新通知</p>
            @foreach($data['notices'] as $v)
            <li>
                <span class="news"><a href="{{ url('/notification/detail/'.$v['id']) }} }}">{{ $v['title'] }}</a> </span>
                <span class="date">{{ $v['time'] }}</span>
            </li>
            <hr/>
            @endforeach
        </div>
    </div>
    <div class="item1">
        <div class="special">
            <img src="/img3/notice.png" class="item1-img"/>
            <p>党建专项</p>
            <img class="item-pic" src="/img3/partySpecial.jpg"/>
            <ul class="index">
                <li><span>习近平:要是暴力恐怖分子成为...</span></li>
                <li><span>习近平致青年</span></li>
                <li><span>习近平在北京大学师生座谈会上...</span></li>
                <li><span>共同开创亚洲发展新未来</span></li>
                <li><span>基层群众需要更多这样的好干部</span></li>
                <li><span>河南兰考：以焦裕禄为镜子 到群...</span></li>
            </ul>
        </div>
        <div class="special1">
            <img src="/img3/notice.png" class="item1-img"/>
            <p>支部分采</p>
            <img class="item-pic" src="/img3/branchMining.jpg"/>
            <ul class="index">
                <li><span>习近平:要是暴力恐怖分子成为...</span></li>
                <li><span>习近平致青年</span></li>
                <li><span>习近平在北京大学师生座谈会上...</span></li>
                <li><span>共同开创亚洲发展新未来</span></li>
                <li><span>基层群众需要更多这样的好干部</span></li>
                <li><span>河南兰考：以焦裕禄为镜子 到群...</span></li>
            </ul>
        </div>
    </div>
    <div class="item4">
        <a href="{{ url('/applicant/courseStudy') }}">
            <img src="/img3/onlineLectures.png" class="item2-pic"  />
        </a>
        <div class="model">
            <img src="/img3/notice.png" class="item1-img" />
            <p>榜样力量</p>
            <img  class="str" src="/img3/branchPower.jpg"/>
            <ul class="index">
                <li><span>习近平:要是暴力恐怖分子成为要更多这样的...</span></li>
                <li><span>习近平致青年要更多这样的好干部</span></li>
                <li><span>习近平在北京大学师生座谈会上要更多这样的...</span></li>
                <li><span>共同开创亚洲发展新未来要更多这样的好干部</span></li>
            </ul>
        </div>
        <a href="TheoryStudy.html">
            <img src="/img3/theory.png" class="item2-pic1" />
        </a>
    </div>
    <div class="item5">
        <img src="/img3/notice.png" class="item1-img"/>
        <p style="padding-top: 8px">党校培训</p>
        <div class="end">
            <img src="/img3/partyTrain.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
        <div class="end">
            <img src="/img3/partyTrain.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
        <div class="end">
            <img src="/img3/partyTrain2.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
        <div class="end">
            <img src="/img3/partyTrain3.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
        <div class="end">
            <img src="/img3/partyTrain4.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="/script/banner.js"></script>
@endsection
