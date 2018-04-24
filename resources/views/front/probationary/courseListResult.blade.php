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
                        培训期数
                    </th>
                    <th>
                        通过必修
                    </th>
                    <th>
                        需学必修
                    </th>
                    <th>
                        通过选修
                    </th>
                    <th>
                        需学选修
                    </th>
                    <th>
                        实践
                    </th>
                    <th>
                        论文
                    </th>
                    <th>
                        紧接上期
                    </th>
                    <th>
                        退课次数
                    </th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($data['info'] as $v)
                            <td>{{ $v }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <br/>
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
                @foreach($data['list']['cur'] as $v)
                    <tr>
                        <td>{{ $v['courseName'] }}</td>
                        <td>{{ $v['courseType'] }}</td>
                        <td>{{ $v['courseTime'] }}</td>
                        <td>{{ $v['coursePlace'] ?? '无' }}</td>
                        <td><a href="{{ url('probationary/courseExit/' . $v['id']) }}">
                                <button class="button">退选</button>
                            </a></td>
                    </tr>
                @endforeach
                @foreach($data['list']['pre'] as $v)
                    <tr>
                        <td>{{ $v['courseName'] }}</td>
                        <td>{{ $v['courseType'] }}</td>
                        <td>{{ $v['courseTime'] }}</td>
                        <td>{{ $v['coursePlace'] ?? '无' }}</td>
                        <td>上期已通过课程</td>
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