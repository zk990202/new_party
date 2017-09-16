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
                        <h3 class="box-title">证书列表</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>学院</th>
                                <th>专业</th>
                                <th>笔试</th>
                                <th>论文</th>
                                <th>证书编号</th>
                                <th>领取人</th>
                                <th>存放点</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($certificates as $certificate)
                                <tr>
                                    <td>{{ $certificate['sno'] }}</td>
                                    <td>{{ $certificate['studentName'] }}</td>
                                    <td>{{ $certificate['academyName'] }}</td>
                                    <td>{{ $certificate['majorName'] }}</td>
                                    <td>{{ $certificate['practiceGrade'] }}</td>
                                    <td>{{ $certificate['articleGrade'] }}</td>
                                    <td>{{ $certificate['certNumber'] }}</td>
                                    <td>{{ $certificate['getPerson'] }}</td>
                                    <td>{{ $certificate['place'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>学院</th>
                                <th>专业</th>
                                <th>笔试</th>
                                <th>论文</th>
                                <th>证书编号</th>
                                <th>领取人</th>
                                <th>存放点</th>
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
