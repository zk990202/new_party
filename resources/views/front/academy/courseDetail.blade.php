@extends('front.layouts.app')
@section('css')
@endsection()

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
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