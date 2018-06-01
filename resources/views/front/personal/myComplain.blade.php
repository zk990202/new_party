@extends('front.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/memberList.css" type="text/css">
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
    <link rel="stylesheet" href="/css/correctionApplication.css" type="text/css">
    <link rel="stylesheet" href="/css/proposerTrain.css" type="text/css" >
@endsection

@section('main')

    <div class="total">
        @include('front.layouts.personalSidebar')
        <div class="info">
            <h2>我的申诉</h2>
            <hr/>
            <div class="information">
                @foreach($complain as $v)
                    <table border="1">
                        <tr>
                            <td><span>申诉标题:</span><a href="{{ url('personal/complainDetail/'.$v['id']) }}">{{ $v['title'] }}</a> </td>
                            <td><span>申诉人:</span>
                                @if(!$v['fromSno'])
                                    系统添加
                                @else
                                    {{ $v['studentName'] }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>申诉时间:</span>{{ $v['time'] }}</td>
                        </tr>
                    </table>
                @endforeach
                {{ $complain->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
    {{--<script src="/script/memberList.js"></script>--}}
@endsection