@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
@endsection()

@section('main')

    <div class="total">
        @include('front.layouts.partyBuildSpecialSidebar')
        <div class="courseLearning">
            <h4>{{ $detail['title'] }}</h4>
            <div>
                {!! $detail['content'] !!}
                {{--{{ htmlspecialchars($detail['content']) }}--}}
                <p class="time">{{ $detail['time'] }}</p>
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