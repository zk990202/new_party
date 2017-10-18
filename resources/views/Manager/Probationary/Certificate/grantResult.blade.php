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
                        <h3 class="box-title">证书发放</h3>
                    </div>
                    <div>
                        @if($res_type == 1)
                            <h1>证书发放成功</h1>
                        @elseif($res_type == 0)
                            <h1>发放失败，请检查学生勾选、领取人、存放点是否为空</h1>
                        @endif
                    </div>
                    <div>
                        <h3>
                            <a href="{{ url('manager/probationary/certificate/grant') }}">返回证书发放页面</a>
                        </h3>
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
