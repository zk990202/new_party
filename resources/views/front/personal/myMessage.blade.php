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
            <h2>我收到的消息</h2>
            <hr/>
            <div class="information">
                @foreach($messages as $v)
                    <table border="1">
                        <tr>
                            <td><span>消息标题:</span><a href="{{ url('personal/messageDetail/'.$v['id']) }}">{{ $v['title'] }}</a> </td>
                            <td><span>发件人:</span>
                                @if(!$v['fromSno'])
                                    系统添加
                                @else
                                    {{ $v['fromName'] }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>收件人:</span>{{ $v['toName'] }}</td>
                            <td><span>发送时间:</span>{{ $v['sendTime'] }}</td>
                        </tr>
                    </table>
                @endforeach
                {{ $messages->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
    {{--<script src="/script/memberList.js"></script>--}}
@endsection