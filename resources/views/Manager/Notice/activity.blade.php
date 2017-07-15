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
                    <div class="box-header">
                        <h3 class="box-title">活动通知</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>标题</th>
                                <th>发布时间</th>
                                <th>发布人</th>
                                <th>备注</th>
                                <th>状态</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>置顶</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notices as $notice)
                                <tr>
                                    <td>{{ $notice['title'] }}</td>
                                    <td>{{ $notice['time'] }}</td>
                                    <td>{{ $notice['authorName']}}</td>
                                    <td>{{ $notice['filePath'] ? '有附件' : '无附件' }}</td>

                                    <td>{{ $notice['isHidden'] ? '隐藏' : '显示'}}</td>
                                    <td>
                                        @if($notice['isHidden'])
                                            <button type="button" class="btn btn-block btn-success btn-xs"  onclick="showNotice({{ $notice['id'] }});">显示</button>
                                        @else
                                            <button type="button" class="btn btn-block btn-danger btn-xs" onclick="hideNotice({{ $notice['id'] }});">隐藏</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/notice/activity/'.$notice['id'].'/edit') }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">编辑</button></a>
                                    </td>
                                    <td>
                                        @if($notice['isTop'])
                                            <button type="button" class="btn btn-block btn-warning btn-xs" onclick="downNotice({{ $notice['id'] }});">取消</button>
                                        @else
                                            <button type="button" class="btn btn-block btn-success btn-xs" onclick="topUpNotice({{ $notice['id'] }});">置顶</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>标题</th>
                                <th>发布时间</th>
                                <th>发布人</th>
                                <th>备注</th>
                                <th>状态</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>置顶</th>
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
        var hideNotice = function hideNotice (noticeId) {
            $.ajax({
                'url': '/manager/notice/activity/' + noticeId + '/hide',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var showNotice = function (noticeId) {
            $.ajax({
                'url': '/manager/notice/activity/' + noticeId + '/hide',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var topUpNotice = function (noticeId) {
            $.ajax({
                'url': '/manager/notice/activity/' + noticeId + '/topUp',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var downNotice = function (noticeId) {
            $.ajax({
                'url': '/manager/notice/activity/' + noticeId + '/topUp',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };
    </script>
@endsection
