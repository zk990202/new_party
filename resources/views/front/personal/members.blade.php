@extends('front.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/memberList.css" type="text/css">
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
@endsection

@section('main')

    <div class="total">
        @include('front.layouts.personalSidebar')
        <div class="info">
            <h2>支部详情</h2>
            <hr/>
            <table>
                <thead>
                <tr>
                    <th>学号</th>
                    <th>姓名</th>
                    <th>学院</th>
                    <th>专业</th>
                    <th>当前状态</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $v)
                    <tr>
                        <td>{{ $v['sno'] }}</td>
                        <td>{{ $v['studentName'] }}</td>
                        <td>{{ $v['academyName'] }}</td>
                        <td>{{ $v['majorName'] }}</td>
                        <td>{{ $v['mainStatus'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $list->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
    <script src="/script/memberList.js"></script>
@endsection