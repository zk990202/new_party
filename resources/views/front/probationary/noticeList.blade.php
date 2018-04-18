@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
@endsection()

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="info">
            <h2>课程设置</h2>
            <hr/>
            @foreach($list as $v)
                <div>
                    <h1><a href="{{ url('probationary/notice/'. $v['id']) }}"> {{ $v['title'] }}</a></h1>
                    <p>{{ $v['content'] }}</p>
                </div>
            @endforeach
            {{ $list->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection