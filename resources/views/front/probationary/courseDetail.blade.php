@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
    <link rel="stylesheet" href="/css/articleDetial.css" type="text/css">
@endsection()

@section('main')

    <div class="detialTotal" style="min-height:800px">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="wrapper">
            <h4>{{ $detail['name'] }}</h4>
            <div>
                <p>{!! $detail['introduction'] !!}</p>
                <p class="time">{{ $detail['time'] }}</p>
                <div class="push"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection