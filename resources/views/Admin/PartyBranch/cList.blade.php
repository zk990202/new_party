
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
                                    <a href="{{ url('admin/party-branch/'.$branch['id'].'/admin') }}">支部管理</a>
                                </td>
                                <td>
                                    <a href="{{ url('admin/party-branch/'.$branch['id'].'/edit') }}">编辑</a>
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
<script>

    $(function () {
        $('#example1').DataTable({
            "ordering" : false
        });
    });

</script>

