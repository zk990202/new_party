@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/accountStatus.css" type="text/css" />
@endsection()

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="info">
            <h2>账号状态</h2>
            <hr/>
            <h3 style="text-align: center">您的申请人状态信息</h3>
            <table border="1">
                <tr>
                    <td>学号:{{ $data['user']['userNumber'] }}</td>
                    <td>姓名:{{ $data['user']['username'] }}</td>
                </tr>
                <tr>
                    <td>学院:{{ $data['user']['college'] }}</td>
                    <td>专业:{{ $data['user']['major'] }}</td>
                </tr>
                <tr>
                    <td>20课状态: {{ $data['info']['isPass20'] }}</td>
                    <td>20课被清状态: {{ $data['info']['isClear20'] }}</td>
                </tr>
                <tr>
                    <td>申请人结业: {{ $data['info']['isPassed'] }}</td>
                    <td>是否被锁: {{ $data['info']['isLocked'] }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection