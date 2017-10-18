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
                        <h3 class="box-title">证书补办</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>学院</th>
                                <th>专业</th>
                                <th>申请时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($certLosts as $certLost)
                                <tr>
                                    <td>{{ $certLost['sno'] }}</td>
                                    <td>{{ $certLost['studentName'] }}</td>
                                    <td>{{ $certLost['academyName'] }}</td>
                                    <td>{{ $certLost['majorName'] }}</td>
                                    <td>{{ $certLost['time'] }}</td>
                                    <td>
                                        @if($certLost['dealStatus'] == 0)
                                            未处理
                                        @elseif($certLost['dealStatus'] == 1)
                                            已通过补办
                                        @elseif($certLost['dealStatus'] == 2)
                                            驳回补办
                                        @endif
                                    </td>
                                    <td>
                                        @if($certLost['dealStatus'] == 0)
                                            <a href="{{ url('manager/probationary/certificate/last-grant/'.$certLost['lostId']).'/detail' }}">
                                                <button type="button" class="btn btn-block btn-danger btn-xs">进行处理</button>
                                            </a>
                                        @else
                                            无操作
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
                                <th>申请时间</th>
                                <th>状态</th>
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
    </script>
@endsection
