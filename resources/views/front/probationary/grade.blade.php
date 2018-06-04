@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/proposerTrain.css" type="text/css">
@endsection()

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="info">
            <h2>成绩查询</h2>
            <hr/>
            <h3 style="text-align: center">查询结果:您参加过{{ count($data['list']) }}次考试</h3>
            @foreach($data['list'] as $item)
                <table border="1">
                    <tr>
                        <td>学号:{{ $data['user']['userNumber'] }}</td>
                        <td>姓名:{{ $data['user']['userName'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $item['trainName'] }}</td>
                        <td>考试时间:{{ $item['trainTime'] }}</td>
                    </tr>
                    <tr>
                        <td>笔试成绩:{{ $item['practiceGrade'] }}</td>
                        <td>论文成绩:{{ $item['articleGrade'] }}</td>
                    </tr>
                    <tr>
                        <td>成绩状态:{{ $item['isAllPassed'] }}</td>
                        <td>考试状态:{{ $item['trainStatus'] }}</td>
                    </tr>
                    <tr>
                        <td>网上选课状态:{{ $item['trainCourseStatus'] }}</td>
                        <td>成绩查看状态:{{ $item['trainGradeStatus'] }}</td>
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