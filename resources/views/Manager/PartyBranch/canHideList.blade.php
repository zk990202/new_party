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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>支部名称</th>
                                <th>支部类型</th>
                                <th>所属年级</th>
                                <th>预备党员</th>
                                <th>正式党员</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($branches as $branch)
                                <tr>
                                    <td>{{ $branch['name'] }}</td>
                                    <td>
                                        @if($branch['type'] == 1)
                                            本科
                                        @elseif($branch['type'] == 2)
                                            硕士
                                        @elseif($branch['type'] == 3)
                                            博士
                                        @elseif($branch['type'] == 4)
                                            混合
                                        @else
                                            暂无
                                        @endif
                                    </td>
                                    <td>
                                        @if($branch['schoolYear'])
                                            {{ $branch['schoolYear'] }}
                                        @else
                                            暂无
                                        @endif
                                    </td>
                                    <td>暂无</td>
                                    <td>暂无</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="if(confirm('确认要隐藏该党支部吗？隐藏后将不可恢复！')) hide({{ $branch['id'] }})">隐藏</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>支部名称</th>
                                <th>支部类型</th>
                                <th>所属年级</th>
                                <th>预备党员</th>
                                <th>正式党员</th>
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

        var hide = function (branchId) {
            $.ajax({
                url: '/manager/party-branch/' + branchId + '/hide',
                method: 'patch',
                success: function (data) {
                    if(data.success){
                        alert('隐藏成功！');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        }

    </script>
@endsection
