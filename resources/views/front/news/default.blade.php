@extends('front.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
@endsection

@section('main')

<div class="total">
    <nav class="find">
        <div class="active">党校培训</div>
        <div class="btn">
            <p class="nav1"><a href="{{ url('news/partySchool') }}">新闻中心</a></p>
        </div>
    </nav>
    <div class="info">
        <h2>新闻中心</h2>
        <hr/>
        @foreach($data['newsList'] as $v)
        <div>
            <h1><a href="{{ url('/news/detail/'.$v['id']) }}">{{ $v['title'] }}</a> </h1>
            <p>{{ $v['content'] }}</p>
        </div>
        @endforeach
        {{ $data['newsList']->links() }}
    </div>
</div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection