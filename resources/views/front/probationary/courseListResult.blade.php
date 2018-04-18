@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/proposerTrain.css" type="text/css">
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
@endsection()

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="info">
            <h2>我的课表</h2>
            <hr/>


            <table border="1">
                <thead>
                <tr>
                    <th>
                        课程名称
                    </th>
                    <th>
                        类型
                    </th>
                    <th>
                        开课时间
                    </th>
                    <th>
                        开课地点
                    </th>
                    <th>
                        操作
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['list'] as $v)
                    <tr>
                        <td>{{ $v['courseName'] }}</td>
                        <td>{{ $v['courseType'] }}</td>
                        <td>{{ $v['courseTime'] }}</td>
                        <td>{{ $v['coursePlace'] ?? '无' }}</td>
                        <td><a href="{{ url('probationary/courseExit/' . $v['id']) }}"><button class="button">退选</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection