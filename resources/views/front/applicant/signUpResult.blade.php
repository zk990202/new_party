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
            <h2>报名结果</h2>
            <hr/>
            <h3 style="text-align: center">我的报名表</h3>
            <table border="1">
                <tr>
                    <td>学号：{{ $data['user']['userNumber'] }}</td>
                    <td>姓名：{{ $data['user']['username'] }}</td>
                </tr>
                <tr>
                    <td>学院：{{ $data['user']['college'] }}</td>
                    <td>专业：{{ $data['user']['major'] }}</td>
                </tr>
                <tr>
                    <td>{{ $data['form']['testName'] }}</td>
                    <td>考试时间：{{ $data['form']['testTime'] }}</td>
                </tr>
                <tr>
                    <td>考试状态：{{ $data['form']['testStatus'] }}</td>
                    <td>考试附件：<a href="{{$data['form']['filePath']}}">{{ $data['form']['fileName'] }}</a></td>
                </tr>
                <tr>
                    <td>我的报名时间：{{ $data['form']['time'] }}</td>
                    <td>我的报名状态：{{ $data['form']['status'] }}</td>
                </tr>
                <tr>
                    <td>所在校区：{{ $data['form']['campus'] }}</td>

                    <td>
                        @if(!$data['form']['isExit'])
                            <a href="{{ url('applicant/signExit') }}"><input class="button" type="button" value="退出报名"></a>
                        @else
                            已退出报名
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection