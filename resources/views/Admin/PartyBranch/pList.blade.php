

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
                            <th>学院名称</th>
                            <th>支部总数</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $branch)
                            <tr>
                                <td>{{ $branch['academyName'] }}</td>
                                <td>{{ $branch['count'] }}</td>
                                <td>
                                    <a href="{{ url('admin/party-branch/r-list/'.$branch['id']) }}">
                                        <button type="button" class="btn btn-block btn-info btn-xs">查看详情</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>学院名称</th>
                            <th>支部总数</th>
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

