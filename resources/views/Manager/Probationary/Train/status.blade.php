@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/Trumbowyg/dist/ui/trumbowyg.min.css">
@endsection

@section('main')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form method="post" action="{{ url('manager/probationary/train/'.$train['id'].'/status') }}">

                        <div class="box-header with-border">
                            <h3 class="box-title">培训状态控制:这里是控制培训的各个阶段的.请务必慎重操作,不可胡乱修改状态!</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group" >
                                <label for="name">培训名称</label>
                                <input type="text" class="form-control" name="name" value="{{ $train['name'] }}" readonly>
                            </div>
                            <div class="form-group" >
                                <label for="entryStatus">报名状态-></label>
                                @if($train['entryStatus'])
                                    开启
                                    <button type="button" class="btn btn-danger" onclick="entryStatus({{ $train['id'] }});">关闭</button>
                                @else
                                    关闭
                                    <button type="button" class="btn btn-success" onclick="entryStatus({{ $train['id'] }});">开启</button>
                                @endif
                            </div>
                            <div class="form-group" >
                                <label for="netChooseStatus">网上选课-></label>
                                @if($train['netChooseStatus'])
                                    开启
                                    <button type="button" class="btn btn-danger" onclick="netChooseStatus({{ $train['id'] }});">关闭</button>
                                @else
                                    关闭
                                    <button type="button" class="btn btn-success" onclick="netChooseStatus({{ $train['id'] }});">开启</button>
                                @endif
                            </div>
                            <div class="form-group" >
                                <label for="gradeSearchStatus">成绩查询-></label>
                                @if($train['gradeSearchStatus'])
                                    开启
                                    <button type="button" class="btn btn-danger" onclick="gradeSearchStatus({{ $train['id'] }});">关闭</button>
                                @else
                                    关闭
                                    <button type="button" class="btn btn-success" onclick="gradeSearchStatus({{ $train['id'] }});">开启</button>
                                @endif
                            </div>
                            <div class="form-group" >
                                <label for="endListShow">结业名单-></label>
                                @if($train['endListShow'])
                                    开启
                                    <button type="button" class="btn btn-danger" onclick="endListShow({{ $train['id'] }});">关闭</button>
                                @else
                                    关闭
                                    <button type="button" class="btn btn-success" onclick="endListShow({{ $train['id'] }});">开启</button>
                                @endif
                            </div>
                            <div class="form-group" >
                                <label for="goodMemberShow">优秀学员-></label>
                                @if($train['goodMemberShow'])
                                    开启
                                    <button type="button" class="btn btn-danger" onclick="goodMemberShow({{ $train['id'] }});">关闭</button>
                                @else
                                    关闭
                                    <button type="button" class="btn btn-success" onclick="goodMemberShow({{ $train['id'] }});">开启</button>
                                @endif
                            </div>
                            <div class="form-group" >
                                <label for="isEnd">培训状态-></label>
                                @if(!$train['isEnd'])
                                    进行中
                                    <button type="button" class="btn btn-danger" onclick="isEnd({{ $train['id'] }});">关闭</button>
                                @else
                                    结束
                                    <button type="button" class="btn btn-success" onclick="isEnd({{ $train['id'] }});">开启</button>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
@endsection

@section('func')
    <script src="/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>

        $(function () {
            $('#example1').DataTable({
                "ordering": false
            });
        });

        var entryStatus = function (id) {
            $.ajax({
                'url': '/manager/probationary/train/' + id + '/entryStatus',
                'method': 'post',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var netChooseStatus = function (id) {
            $.ajax({
                'url': '/manager/probationary/train/' + id + '/netChooseStatus',
                'method': 'post',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var gradeSearchStatus = function (id) {
            $.ajax({
                'url': '/manager/probationary/train/' + id + '/gradeSearchStatus',
                'method': 'post',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var endListShow = function (id) {
            $.ajax({
                'url': '/manager/probationary/train/' + id + '/endListShow',
                'method': 'post',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var goodMemberShow = function (id) {
            $.ajax({
                'url': '/manager/probationary/train/' + id + '/goodMemberShow',
                'method': 'post',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var isEnd = function (id) {
            $.ajax({
                'url': '/manager/probationary/train/' + id + '/isEnd',
                'method': 'post',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

    </script>
@endsection