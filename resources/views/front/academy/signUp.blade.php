@extends('front.layouts.app')
@section('css')
@endsection()
@section('style')
@endsection

@section('main')
    <div class="total">
        @include('front.layouts.applicantSchoolSidebar')
        <div class="info">
            <h2>我要报名</h2>
            <hr/>
            <h3 style="text-align: center">个人报名信息</h3>
            <form action="{{ url('applicant/signUp') }}" method="post">
                {{ csrf_field() }}
                <table border="1">
                    <tr>
                        <td>学号:{{ $data['user']['userNumber'] }}</td>
                        <td>姓名:{{ $data['user']['username'] }}</td>
                    </tr>
                    <tr>
                        <td>学院:{{ $data['user']['college'] }}</td>
                        <td>专业:{{ $data['user']['major'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['test']['name'] }}</td>
                        <td>考试时间:{{ $data['test']['time'] }}</td>
                    </tr>
                    <tr>
                        <td>所在校区:
                            <label><input name="school" type="radio" value="new" />新校区</label>
                            <label><input name="school" type="radio" value="old" />老校区</label>
                        </td>
                        <td>
                            <input  class="button" type="submit" value="确认报名"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection