@extends('front.layouts.app')

@section('css')
@endsection



@section('main')

    <div class="total">
        @include('front.layouts.personalSidebar')
        <div class="info">
            <h2>支部详情</h2>
            <hr/>
            <div class="information">
                <p><b>姓名:</b><span>{{ $user->username }}</span></p>
                <p style="background: rgba(252,250,251,1)"><b>天外天账号:</b><span>xxxxxx</span></p>
                <p><b>学号:</b><span>3015282736</span></p>
                <p style="background: rgba(252,250,251,1)"><b>年级:</b><span>2015</span></p>
                <p><b>专业:</b><span>教育学院</span></p>
                <p style="background: rgba(252,250,251,1)"><b>支部编号:</b><span>2937</span></p>
                <p><b>名称:</b><span>教育学院混合学生第四党支部</span></p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection