@extends('front.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/correctionApplication.css" type="text/css">
@endsection

@section('main')

    <div class="total">
        @include('front.layouts.personalSidebar')
        <div class="info">
            <h2>支部详情</h2>
            <hr/>
            <div class="information">
                <p><b>姓名:</b><span>{{ $user['userName'] }}</span></p>
                <p><b>学号:</b><span>{{ $user['userNumber'] }}</span></p>
                <p><b>年级:</b><span>{{ $user['grade'] }}</span></p>
                <p><b>专业:</b><span>{{ $user['major'] }}</span></p>
                <p><b>支部编号:</b><span>{{ $user['partyBranchId'] }}</span></p>
                <p><b>名称:</b><span>{{ $user['partyBranch'] }}</span></p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection