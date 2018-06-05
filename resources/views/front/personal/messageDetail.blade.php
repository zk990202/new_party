@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
    <link rel="stylesheet" href="/css/articleDetial.css" type="text/css">
@endsection()

@section('main')

    <div class="detialTotal" style="min-height:800px">
        @include('front.layouts.personalSidebar ')
        <div class="wrapper">
            <h4>{{ $detail['title'] }}</h4>
            <p class="time">发送时间：{{ $detail['sendTime'] }}</p>
            <div>
                {!! $detail['content'] !!}
                {{--{{ htmlspecialchars($detail['content']) }}--}}
                <div class="push"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection