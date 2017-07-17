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
                        <h3 class="box-title">重要文件</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>标题</th>
                                <th>所属类别</th>
                                <th>发布时间</th>
                                <th>备注</th>
                                <th>状态</th>
                                <th>操作</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>{{ $file['title'] }}</td>
                                    <td>
                                        @if($file['type'] == 1)
                                            党史文献
                                        @elseif($file['type'] == 2)
                                            规章制度
                                        @elseif($file['type'] == 3)
                                            经典导读
                                        @elseif($file['type'] == 4)
                                            常用文书
                                        @elseif($file['type'] == 5)
                                            入党必读
                                        @elseif($file['type'] == 6)
                                            系统手册
                                        @endif
                                    </td>
                                    <td>{{ $file['time'] }}</td>
                                    <td>{{ $file['filePath'] ? '有附件' : '无附件' }}</td>
                                    <td>{{ $file['isHidden'] ? '隐藏' : '显示'}}</td>
                                    <td>
                                        @if($file['isHidden'])
                                            <button type="button" class="btn btn-block btn-success btn-xs"  onclick="showFiles({{ $file['id'] }});">显示</button>
                                        @else
                                            <button type="button" class="btn btn-block btn-danger btn-xs" onclick="hideFiles({{ $file['id'] }});">隐藏</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/important-files/'.$file['id'].'/edit') }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">编辑</button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>标题</th>
                                <th>所属类别</th>
                                <th>发布时间</th>
                                <th>备注</th>
                                <th>状态</th>
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
        var hideFiles = function hideFiles (filesId) {
            $.ajax({
                'url': '/manager/important-files/' + filesId + '/hide',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var showFiles = function (filesId) {
            $.ajax({
                'url': '/manager/important-files/' + filesId + '/hide',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

    </script>
@endsection
