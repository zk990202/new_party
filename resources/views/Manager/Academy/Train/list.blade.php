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
                        <h3 class="box-title">总培训列表:注意,总培训开始,院级管理员才可以添加各个学院的培训,总培训一旦结束,各个学院的培训都全部结束!</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>培训名称</th>
                                <th>创建时间</th>
                                <th>培训状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trains as $train)
                                <tr>
                                    <td>{{ $train['name'] }}</td>
                                    <td>{{ $train['time'] }}</td>
                                    <td>
                                        {{--{{ $train['status']}}--}}
                                        @if(!$train['status'])
                                            开启
                                        @else
                                            关闭
                                        @endif
                                    </td>
                                    <td>
                                        @if($train['status'])
                                            无操作
                                        @else
                                            <button type="button" class="btn btn-block btn-success btn-xs" onclick="if(confirm('培训一旦关闭,则其子培训状态自动变为[考试结束],真的确定要关闭该期培训?')) closeTrain({{ $train['id'] }})">关闭</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>培训名称</th>
                                <th>创建时间</th>
                                <th>培训状态</th>
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
        var closeTrain = function closeTrain (id) {
            $.ajax({
                'url': '/manager/academy/train-list/' + id + '/close',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };
    </script>
@endsection
