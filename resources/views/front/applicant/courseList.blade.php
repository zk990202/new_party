@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/SecondPage.css" type="text/css" />
@endsection()
@section('style')
    <style>
        .nav1{
            background: #e9a9a7;
        }
        .nav1 a{
            color: white;
        }
        .info div{
            height: 650px;
            max-width: 90%;
            margin: 0 auto;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;

        }
        .info ul{
            margin: 0;
            padding: 0;
        }
        .info li{
            width: 100%;
            height: 30px;
            line-height: 30px;
        }
        .info span{
            color: #c60001;
        }
    </style>
@endsection

@section('main')
    <div class="total">
        @include('front.layouts.partySchoolSidebar')
        <div class="info">
            <h2>课程学习</h2>
            <hr/>
            <div>
                <ul>
                    @foreach($data['courseList'] as $v)
                    <li>
                        <a href="{{ $v['url'] }}">
                            <span>{{ $v['courseName'][0] }}</span>
                            {{ $v['courseName'][1] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection