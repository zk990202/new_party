<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">这里显示的是最近一期的院级党校的各个学院活跃的分党校报名情况。</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>考试期数</th>
                            <th>状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entries as $entry)
                            <tr>
                                <td>{{ $entry['sno'] }}</td>
                                <td>{{ $entry['studentName'] }}</td>
                                <td>{{ $entry['academyName'] }}</td>
                                <td>{{ $entry['testName'] }}</td>
                                <td>
                                    @if($entry['isSystemAdd'])
                                        后台补选
                                    @else
                                        正常
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
                            <th>考试期数</th>
                            <th>状态</th>
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