@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/SecondPage.css" type="text/css" />
@endsection()
@section('style')
    <style>
        .courseLearning{
            width: 79%;
            background: rgba(252,250,251,1) ;
            float: right;
            min-height: 800px;
            height: auto !important;
        }
        .courseLearning p{
            line-height: 1.5;
            text-indent: 2em;
            font-size: 13px;
            margin-left: 30px;
            margin-right: 30px;
        }
        h4{
            text-align: center;
            font-size: 14px;
        }
    </style>
@endsection

@section('main')
    <div class="total">
        @include('front.layouts.partySchoolSidebar')
        <div class="courseLearning">
            <h2>{{ $data['course']['courseName'] }}</h2>
            <hr/>
            <div>
                @foreach($data['articles'] as $item)
                <h4>{{ $item['articleName'] }}</h4>
                <div>
                    {!! $item['content'] !!}
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection