@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/detail.css" type="text/css" />
    <link rel="stylesheet" href="/css/articleDetial.css" type="text/css">
@endsection()
@section('style')
@endsection

@section('main')
    <div class="detialTotal" style="min-height:800px">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="wrapper">
            <h2>{{ $data['course']['courseName'] }}</h2>
            <div>
                @foreach($data['articles'] as $item)
                <h4>{{ $item['articleName'] }}</h4>
                <div>
                    <p>{!! $item['content'] !!}</p>
                    <div class="push"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection