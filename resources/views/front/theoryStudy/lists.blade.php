@extends('front.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/memberList.css" type="text/css">
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
    <link rel="stylesheet" href="/css/correctionApplication.css" type="text/css">
    <link rel="stylesheet" href="/css/proposerTrain.css" type="text/css" >
@endsection

@section('main')

    <div class="total">
        <nav class="find">
            <div class="active">理论学习</div>
            <div class="btn">
                <p class="nav1"><a href="{{ url('theoryStudy') }}">理论经典</a></p>
            </div>
        </nav>
        <div class="info">
            <h2>经典理论</h2>
            <hr/>
            <div class="information">
                @foreach($result as $v)
                    <div style="height: 100px">
                        <h1><a href="{{ url('theoryStudy/'.$v['id']) }}">{{ $v['title'] }}</a></h1>
                    </div>
                @endforeach
            </div>
            {{ $result->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
    {{--<script src="/script/memberList.js"></script>--}}
@endsection