
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $signs[0]['testName'] }}（退考人员）</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>专业</th>
                            <th>报名时间</th>
                            <th>所在校区</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($signs as $sign)
                            <tr>
                                <td>{{ $sign['sno'] }}</td>
                                <td>{{ $sign['studentName'] }}</td>
                                <td>{{ $sign['academyName'] }}</td>
                                <td>{{ $sign['majorName'] }}</td>
                                <td>{{ $sign['time'] }}</td>
                                <td>{{ $sign['campus'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>专业</th>
                            <th>报名时间</th>
                            <th>所在校区</th>
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

