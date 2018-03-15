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
                        <h3 class="box-title">作弊违纪列表</h3>
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
                                <th>笔试</th>
                                <th>论文</th>
                                <th>状态</th>
                                <th>考试状态</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cheats as $cheat)
                                <tr>
                                    <td>{{ $cheat['sno'] }}</td>
                                    <td>{{ $cheat['studentName'] }}</td>
                                    <td>{{ $cheat['academyName'] }}</td>
                                    <td>{{ $cheat['majorName'] }}</td>
                                    <td>{{ $cheat['testName'] }}</td>
                                    <td>{{ $cheat['practiceGrade'] }}</td>
                                    <td>{{ $cheat['articleGrade'] }}</td>
                                    <td>不合格</td>
                                    <td>
                                        @if($cheat['status'] == 2)
                                            论文抄袭
                                        @else
                                            考场违纪
                                        @endif
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
                                <th>笔试</th>
                                <th>论文</th>
                                <th>状态</th>
                                <th>考试状态</th>
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
    </script>
@endsection
