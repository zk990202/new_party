@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
@endsection()

@section('main')

    <div class="total">
        @include('front.layouts.personalSidebar ')
        <div class="courseLearning">
            <h4>{{ $detail['title'] }}</h4>
            <p class="time">提交时间：{{ $detail['addTime'] }}</p>
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