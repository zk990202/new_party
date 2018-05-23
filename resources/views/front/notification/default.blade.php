@extends('front.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
@endsection


@section('main')

<div class="total">
    @include('front.layouts.notificationSidebar')
    <div class="info">
        @if($data['notice'][0]['columnId'] == 70)
            <h2>申请人培训</h2>
        @elseif($data['notice'][0]['columnId'] == 71)
            <h2>院级积极分子培训</h2>
        @elseif($data['notice'][0]['columnId'] == 72)
            <h2>预备党员培训</h2>
        @elseif($data['notice'][0]['columnId'] == 73)
            <h2>党支部书记培训</h2>
        @elseif($data['notice'][0]['columnId'] == 2)
            <h2>活动通知</h2>
        @endif
        <hr/>
        @foreach($data['notice'] as $v)
        <div>
            <h1><a href="{{ url('/notification/detail/'.$v['id']) }}"> {{ $v['title'] }}</a></h1>
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