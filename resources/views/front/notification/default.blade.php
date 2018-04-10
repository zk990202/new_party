@extends('front.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
@endsection


@section('main')

<div class="total">
    @include('front.layouts.notificationSidebar')
    <div class="info">
        <h2>申请人培训</h2>
        <hr/>
        @foreach($data['notice'] as $v)
        <div>
            <h1>{{ $v['title'] }}</h1>
            <p>{{ $v['content'] }}</p>
        </div>
        @endforeach
        {{ $data['notice']->links() }}
    </div>
</div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection