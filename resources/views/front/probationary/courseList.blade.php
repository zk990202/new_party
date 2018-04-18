@extends('front.layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/proposerTrain.css" type="text/css">
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
@endsection()

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="info">
            <h2>{{ $trainName }}</h2>
            <hr/>

            <form action="{{ url('probationary/courseChoose') }}" method="post">
                {{ csrf_field() }}
                <table border="1">
                    <thead>
                    <tr>
                        <th>
                            选择
                        </th>
                        <th>
                            课程
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
                            人数上限
                        </th>
                        <th>
                            状态
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $v)
                        <tr>
                            <td>
                                <input type="checkbox" name="course_id[]" value="{{ $v['id'] }}" {{ $v['chooseStatus'] == 0 ? '' : 'disabled'  }}>
                                <!--对题干内容的长度进行限制。-->
                            </td>
                            <td>{{ $v['name'] }}</td>
                            <td>{{ $v['type'] }}</td>
                            <td>{{ $v['time'] }}</td>
                            <td>{{ $v['place'] ?? '无' }}</td>
                            <td>{{ $v['limitNum'] == 0 ?  '人数不限'  : $v['count'] . '/' . $v['limitNum']}}</td>
                            <td>{{ $v['chooseStatusMsg']}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">
                            <input  class="button" type="submit" value="确认提交"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection