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
                    <td>{{ $data['form']['trainName'] }}</td>
                    <td>培训时间：{{ $data['form']['trainTime'] }}</td>
                </tr>
                <tr>
                    <td>党校报名状态：{{ $data['form']['trainStatus'] }}</td>
                    <td>网上选课状态：{{ $data['form']['trainCourseStatus'] }}</td>
                </tr>
                <tr>
                    <td>我的报名时间：{{ $data['form']['time'] }}</td>
                    <td>我的报名状态：{{ $data['form']['status'] }}</td>
                </tr>
                <tr>
                    <td>成绩查看状态：{{ $data['form']['trainGradeStatus'] }}</td>
                    <td>考试附件：{{ $data['form']['trainFileName'] ?? '无' }}</td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ url('probationary/courseChoose') }}"><input class="button" type="button" value="前往选课"></a>
                    </td>
                    <td>
                        @if(!$data['form']['isExit'])
                            <a href="{{ url('probationary/signExit') }}"><input class="button" type="button" value="退出报名"></a>
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