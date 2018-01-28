@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('main')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div>
                            <a href="{{ url('manager/applicant/exam/add') }}">
                                <button type="button" class="btn-danger">添加考试</button>
                            </a>
                        </div>
                        <div>

                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>考试期数</th>
                                <th>考试时间</th>
                                <th>当前状态</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td>
                                        <a href="{{ url('manager/applicant/exam/'.$exam['id'].'/detail') }}">
                                            {{ $exam['name'] }}
                                        </a>
                                    </td>
                                    <td>{{ $exam['time'] }}</td>
                                    <td>
                                        @if($exam['status'] == 0)
                                            未开启
                                        @elseif($exam['status'] == 1)
                                            报名开始
                                        @elseif($exam['status'] == 2)
                                            报名截至
                                        @elseif($exam['status'] == 3)
                                            成绩录入
                                        @elseif($exam['status'] == 4)
                                            录入结束
                                        @elseif($exam['status'] == 5)
                                            考试结束
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/applicant/exam/'.$exam['id'].'/edit') }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">修改</button></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-warning btn-xs" onclick="if(confirm('确认要执行该项操作?此操作是不可恢复操作,是否继续?')) deleteExam({{ $exam['id'] }})">删除</button>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                                状态编辑
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @if($exam['isDeleted'])
                                                    <li>
                                                        <a href="#">
                                                            已删除
                                                        </a>
                                                    </li>
                                                @else
                                                    @if(!$exam['status'])
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要开启报名?')) startSign({{ $exam['id'] }})">报名开始</a>
                                                        </li>
                                                    @elseif($exam['status'] == 1)
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要截止报名?')) endSign({{ $exam['id'] }})">截止报名</a>
                                                        </li>
                                                    @elseif($exam['status'] == 2)
                                                        {{--这里权限待接入--}}
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要开启成绩录入?')) gradeInput({{ $exam['id'] }})">成绩录入</a>
                                                        </li>
                                                    @elseif($exam['status'] == 3)
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要结束成绩录入?')) endInput({{ $exam['id'] }})">录入结束</a>
                                                        </li>
                                                    @elseif($exam['status'] == 4)
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要结束考试?')) endExam({{ $exam['id'] }})">考试结束</a>
                                                        </li>
                                                    @elseif($exam['status'] == 5)
                                                        <li>
                                                            <a href="#">
                                                                无操作
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>考试期数</th>
                                <th>考试时间</th>
                                <th>当前状态</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>
        <!-- Main row -->
    </section>
@endsection

@section('func')
    <script src="/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>

        $(function () {
            $('#example1').DataTable({
                "ordering" : false
            });
        });
        var deleteExam = function deleteExam (examId) {
            $.ajax({
                'url': '/manager/applicant/exam/' + examId + '/delete',
                'method': 'post',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };
       
        var startSign = function (id) {
            $.ajax({
                url: '/manager/applicant/exam/' + id + '/change/1',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('报名开始成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };
        var endSign = function (id) {
            $.ajax({
                url: '/manager/applicant/exam/' + id + '/change/2',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('结束报名成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };
        var gradeInput = function (id) {
            $.ajax({
                url: '/manager/applicant/exam/' + id + '/change/3',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('开启成绩录入成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };
        var endInput = function (id) {
            $.ajax({
                url: '/manager/applicant/exam/' + id + '/change/4',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('结束成绩录入成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };
        var endExam = function (id) {
            $.ajax({
                url: '/manager/applicant/exam/' + id + '/change/5',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('结束考试成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };

    </script>
@endsection
