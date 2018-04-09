@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/SecondPage.css" type="text/css" />
@endsection()
@section('style')
    <style>
        .nav1{
            background: #e9a9a7;
        }
        .nav1 a{
            color: white;
        }
        .info div{
            height: 650px;
            max-width: 90%;
            margin: 0 auto;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;

        }
        .info ul{
            margin: 0;
            padding: 0;
        }
        .info li{
            width: 100%;
            height: 30px;
            line-height: 30px;
        }
        .info span{
            color: #c60001;
        }
        table{
            border-collapse: collapse;
            width: 85%;
            height: 80px;
            margin: 0 auto;
            text-align: center;
            line-height: 25px;
        }
        .button{
            background: #890c0c;
            width: 70px;
            height: 35px;
            border: none;
            color: white;
        }
    </style>
@endsection

@section('main')
    <div class="total">
        @include('front.layouts.partySchoolSidebar')
        <div class="info">
            <h2>成绩查询</h2>
            <hr/>
            <h3 style="text-align: center">查询结果:您参加过{{ count($data['list']) }}次考试</h3>
            @foreach($data['list'] as $item)
            <table border="1">
                <tr>
                    <td>学号:{{ $data['user']['userNumber'] }}</td>
                    <td>姓名:{{ $data['user']['username'] }}</td>
                </tr>
                <tr>
                    <td>{{ $item['testName'] }}</td>
                    <td>考试时间:{{ $item['testTime'] }}</td>
                </tr>
                <tr>
                    <td>笔试成绩:{{ $item['practiceGrade'] }}</td>
                    <td>论文成绩:{{ $item['articleGrade'] }}</td>
                </tr>
                <tr>
                    <td>成绩状态:{{ $item['isPassed'] }}</td>
                    <td>考试状态:{{ $item['testStatus'] }}</td>
                </tr>
                <tr>
                    <td>我的报名时间：{{ $item['time'] }}</td>
                    <td>我的报名状态：{{ $item['status'] }}</td>
                </tr>
                <tr>
                    <td colspan="2"><input class="button" type="button" value="申诉"></td>
                </tr>
            </table>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection