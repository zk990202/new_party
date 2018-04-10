@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/proposerTrain.css" type="text/css">
@endsection()

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
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