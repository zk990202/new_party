@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
@endsection()

@section('main')

    <div class="total">
        <nav class="find">
            <div class="active">理论学习</div>
            <div class="btn">
                <a href="{{ url('theoryStudy') }}"><p class="nav1">理论经典</p></a>
            </div>
        </nav>
        <div class="courseLearning">
            <h4>{{ $detail['title'] }}</h4>
            {{--<p class="time">提交时间：{{ $detail['time'] }}</p>--}}
            <div>
                {!! $detail['content'] !!}
                {{--{{ htmlspecialchars($detail['content']) }}--}}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection