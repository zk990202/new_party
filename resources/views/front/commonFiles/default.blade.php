@extends('front.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
@endsection

@section('style')
    <style>
        .nav1{
            background: #e9a9a7;
        }
        .nav1 a{
            color: white;
        }
    </style>
@endsection

@section('main')

<div class="total">
    @include('front.layouts.commonFilesSidebar')
    <div class="info">
        <h2>申请人培训</h2>
        <hr/>
        @foreach($data['files'] as $v)
        <div>
            <h1>{{ $v['title'] }}</h1>
            <p>{{ $v['content'] }}</p>
        </div>
        @endforeach
        {{ $data['files']->links() }}
    </div>
</div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection