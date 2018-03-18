<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">结业成绩查询：{{ $grades[0]['testName'] }}</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>专业</th>
                            <th>实践</th>
                            <th>论文</th>
                            <th>笔试</th>
                            <th>状态</th>
                            <th>系统添加</th>
                            <th>考试状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($grades as $grade)
                            <tr>
                                <td>{{ $grade['sno'] }}</td>
                                <td>{{ $grade['studentName'] }}</td>
                                <td>{{ $grade['academyName'] }}</td>
                                <td>{{ $grade['majorName'] }}</td>
                                <td>{{ $grade['practiceGrade'] }}</td>
                                <td>{{ $grade['articleGrade'] }}</td>
                                <td>{{ $grade['testGrade'] }}</td>
                                <td>
                                    @if($grade['isPassed'] == 2)
                                        优秀
                                    @elseif($grade['isPassed'] == 1)
                                        合格
                                    @elseif($grade['isPassed'] == 0)
                                        不合格
                                    @endif
                                </td>
                                <td>
                                    @if($grade['isSystemAdd'])
                                        是
                                    @else
                                        否
                                    @endif
                                </td>
                                <td>
                                    @if($grade['status'] == 0)
                                        未录入
                                    @elseif($grade['status'] == 1)
                                        正常
                                    @elseif($grade['status'] == 2)
                                        抄袭
                                    @elseif($grade['status'] == 3)
                                        违纪
                                    @elseif($grade['status'] == 4)
                                        缺考
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
                            <th>专业</th>
                            <th>实践</th>
                            <th>论文</th>
                            <th>笔试</th>
                            <th>状态</th>
                            <th>系统添加</th>
                            <th>考试状态</th>
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