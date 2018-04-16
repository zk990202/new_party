@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/proposerTrain.css" type="text/css">
@endsection()

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
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
                    <td>考试附件：<a href="#">无</a></td>
                </tr>
                <tr>
                    <td>我的报名时间：{{ $data['form']['time'] }}</td>
                    <td>我的报名状态：{{ $data['form']['status'] }}</td>
                </tr>
                <tr>
                    <td colspan=2>
                        @if(!$data['form']['isExit'])
                            <a href="{{ url('academy/signExit') }}"><input class="button" type="button" value="退出报名"></a>
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