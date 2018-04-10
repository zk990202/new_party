@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/proposerTrain.css" type="text/css">
@endsection()
@section('style')
    <style>
        .nav2{
            background: #e9a9a7 ;
        }
        .nav2 a{
            color: white;
        }
    </style>
@endsection

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="info">
            <h2>课程设置</h2>
            <hr/>
            @foreach($list as $v)
                <div>
                    <h1>{{ $v['name'] }}</h1>
                    <p>{{ $v['shortContent'] }}</p>
                </div>
            @endforeach
            {{ $list->links() }}

        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection