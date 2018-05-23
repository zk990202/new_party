@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
@endsection()

@section('main')

    <div class="total">
        @include('front.layouts.commonFilesSidebar')
        <div class="courseLearning">
            <h4>{{ $detail['title'] }}</h4>
            <div>
                {!! $detail['content'] !!}
                <p class="time">{{ $detail['time'] }}</p>
            </div>
            @if($detail['filePath'])
                <p>
                    <a href="{{ url($detail['filePath'].'/download/'.$detail['title']) }}">{{ $detail['title'] }}</a>
                </p>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection