@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
    <link rel="stylesheet" href="/css/articleDetial.css" type="text/css">
@endsection()

@section('main')

    <div class="detialTotal" style="min-height:800px">
        <nav class="find">
            <div class="active">理论学习</div>
            <div class="btn">
                <a href="{{ url('theoryStudy') }}"><p class="nav1">理论经典</p></a>
            </div>
        </nav>
        <div class="wrapper">
            <h4>{{ $detail['title'] }}</h4>
            {{--<p class="time">提交时间：{{ $detail['time'] }}</p>--}}
            <div>
                <p>{!! $detail['content'] !!}</p>
                {{--{{ htmlspecialchars($detail['content']) }}--}}
                <div class="push"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection