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

    </script>
@endsection
