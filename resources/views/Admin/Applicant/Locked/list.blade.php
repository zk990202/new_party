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
                    <div class="box-header with-border">
                        <h3 class="box-title">被锁人员名单</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>学院</th>
                                <th>专业</th>
                                <th>考试期数</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($locks as $lock)
                                <tr>
                                    <td>{{ $lock['sno'] }}</td>
                                    <td>{{ $lock['studentName'] }}</td>
                                    <td>{{ $lock['academyName'] }}</td>
                                    <td>{{ $lock['majorName'] }}</td>
                                    <td>{{ $lock['testName'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-danger btn-xs" onclick="if(confirm('确认要解锁该学生吗?')) unlock({{ $lock['id'] }})">解锁</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>学院</th>
                                <th>专业</th>
                                <th>考试期数</th>
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

        var unlock = function (Id) {
            $.ajax({
                'url': '/manager/applicant/locked/' + Id + '/unlock',
                'method': 'post',
                'success': function (data) {
                    window.location.reload();
                }
            })
        }
    </script>
@endsection
