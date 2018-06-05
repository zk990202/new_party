@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
    <link rel="stylesheet" href="/css/articleDetial.css" type="text/css">
@endsection()

@section('main')

    <div class="detialTotal" style="min-height:800px">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="wrapper">
            <h4>{{ $detail['title'] }}</h4>
            <div>
                <p>{!! $detail['content'] !!}</p>
                <p class="time">{{ $detail['time'] }}</p>
                @if($detail['filePath'] == null)
                    <div class="push"></div>
                @endif
            </div>
            @if($detail['filePath'])
                <p>
                    <a href="{{ url($detail['filePath'].'/download/'.$detail['fileName']) }}">{{ $detail['fileName'] }}</a>
                </p>
                <div class="push"></div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection