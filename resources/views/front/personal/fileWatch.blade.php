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
            <h2>{{ $nav }}</h2>
            <hr/>
            <div class="information">
                @foreach($result as $v)
                    <table border="1">
                        <tr>
                            <td><span>学号:</span>{{ $v['sno'] }}</td>
                            <td><span>姓名:</span>{{ $user['userName'] }}</td>
                        </tr>
                        <tr>
                            <td><span>标题:</span><a href="{{ url('/personal/fileDetail/'.$v['type'].'/'.$v['id']) }}" >{{ $v['title'] }}</a></td>
                            <td><span>类型:</span>{{ $nav }}</td>
                        </tr>
                        <tr>
                            <td>
                                <span>状态:</span>
                                @if($v['status'] == \App\Models\StudentFiles::FILE_STATUS['UNPROCESSED'])
                                    未处理
                                @elseif($v['status'] == \App\Models\StudentFiles::FILE_STATUS['QUALIFIED'])
                                    合格
                                @elseif($v['status'] == \App\Models\StudentFiles::FILE_STATUS['REJECTED'])
                                    驳回
                                @elseif($v['status'] == \App\Models\StudentFiles::FILE_STATUS['EXCELLENT'])
                                    优秀
                                @endif
                            </td>
                            <td><span>递交时间:</span>{{ $v['addTime'] }}</td>
                        </tr>
                        <tr>
                            <td><span>处理时间:</span>{{ $v['dealTime'] }}</td>
                        </tr>
                    </table>
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