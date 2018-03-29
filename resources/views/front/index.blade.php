@extends('front.layouts.app')
@section('style')
    <style>

        li{
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .picture{
            width: 62.5%;
            height: 290px;
            margin:0 auto;
        }
        .text{
            width: 62.5%;
            height: 30px;
            background: rgba(0,0,0,0.35);
            color: rgba(255,255,255,0.7);
            text-align: center;
            padding-top: 5px;
            margin: 0 auto;
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
        .notice li span{
            margin-left: 30px;
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
            margin-left: 30px;
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
    <style>
        .prev,.next{
            cursor: pointer;
            position: absolute;
            top: 35%;
            color: white;
            padding: 0 14px;
            border-radius: 50%;
            font-size: 50px;
            z-index: 2;
        }
        .showpic{
            display: none;
        }
        .wrap{
            width: 100%;
            height: 290px;
            margin:  0 auto;
        }
        .wrap div img{
            width: 100%;
            height: 290px;
        }
    </style>
@endsection

<body>

@section('main')
<div class="picture" >
    <div class="wrap" id="wrap">
        <div class="showpic" style="display: block"><img src="img3/首页1.jpg"></div>
        <div class="showpic"><img src="img3/首页1.jpg"></div>
        <div class="showpic"><img src="img3/首页2.jpg"></div>
        <div class="showpic"><img src="img3/首页1.jpg"></div>
        <div class="showpic"><img src="img3/首页2.jpg"></div>
        <div class="showpic"><img src="img3/首页1.jpg"></div>
    </div>
</div>
<p class="text">党建系统新版回归</p>
<div class="module">
    <div class="item1">
        <div class="state">
            <img src="img3/用户.png" class="item1-img"/>
            <p>个人状态</p>
            <span>登陆查看个人状态</span>
            <br/>
            <input type="button" value="登录"  class="btn"/>
        </div>
        <div class="notice">
            <img src="img3/通知.png" class="item1-img"/>
            <p>最新通知</p>
            @foreach($data['notices'] as $v)
            <li>
                <span class="news">{{ $v['title'] }}</span>
                <span class="date">{{ $v['time'] }}</span>
            </li>
            <hr/>
            @endforeach
        </div>
    </div>
    <div class="item1">
        <div class="special">
            <img src="img3/通知.png" class="item1-img"/>
            <p>党建专项</p>
            <img class="item-pic" src="img3/党建专项.jpg"/>
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
            <img src="img3/通知.png" class="item1-img"/>
            <p>支部分采</p>
            <img class="item-pic" src="img3/支部风采.jpg"/>
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
        <img src="img3/网上党课.png" class="item2-pic"  />
        <div class="model">
            <img src="img3/通知.png" class="item1-img" />
            <p>榜样力量</p>
            <img  class="str" src="img3/支部力量.jpg"/>
            <ul class="index">
                <li><span>习近平:要是暴力恐怖分子成为要更多这样的...</span></li>
                <li><span>习近平致青年要更多这样的好干部</span></li>
                <li><span>习近平在北京大学师生座谈会上要更多这样的...</span></li>
                <li><span>共同开创亚洲发展新未来要更多这样的好干部</span></li>
            </ul>
        </div>
        <a href="TheoryStudy.html">
            <img src="img3/理论学习.png" class="item2-pic1" />
        </a>
    </div>
    <div class="item5">
        <img src="img3/通知.png" class="item1-img"/>
        <p style="padding-top: 8px">党校培训</p>
        <div class="end">
            <img src="img3/党校培训.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
        <div class="end">
            <img src="img3/党校培训.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
        <div class="end">
            <img src="img3/党校培训2.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
        <div class="end">
            <img src="img3/党校培训3.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
        <div class="end">
            <img src="img3/党校培训4.jpg"/>
            <p>习近平在北京大学师生座谈会上要更多这样的</p>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="/script/banner.js"></script>
@endsection
