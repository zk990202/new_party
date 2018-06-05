@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
    <link rel="stylesheet" href="/css/articleDetial.css" type="text/css">
@endsection()

@section('main')

    <div class="detialTotal" style="min-height:800px">
        @include('front.layouts.partyBuildSpecialSidebar')
        <div class="wrapper">
            <h4>{{ $detail['title'] }}</h4>
            <div>
                <p>{!! $detail['content'] !!}</p>
                {{--{{ htmlspecialchars($detail['content']) }}--}}
                <p class="time">{{ $detail['time'] }}</p>
                <div class="push"></div>
            </div>
            @if($detail['imgPath'])
                <p>
                    <a href="{{ url($detail['imgPath'].'/download/'.$detail['title']) }}">查看图片：{{ $detail['title'] }}</a>
                </p>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection