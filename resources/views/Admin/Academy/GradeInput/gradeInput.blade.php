<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">成绩录入</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{url('admin/academy/grade-input')}}" >
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>培训名称</th>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>学院</th>
                                <th>实践</th>
                                <th>论文</th>
                                <th>笔试</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < $count; $i++)
                                @foreach($entries[$i] as $entry[$i])
                                    <tr>
                                        <td>{{ $entry[$i]['testName'] }}</td>
                                        <td>
                                            {{ $entry[$i]['sno'] }}
                                            <input type="hidden" name="id[]" value="{{ $entry[$i]['id'] }}">
                                            <input type="hidden" name="sno[]" value="{{ $entry[$i]['sno'] }}">
                                            <input type="hidden" name="testId[]" value="{{ $entry[$i]['testId'] }}">
                                        </td>
                                        <td>{{ $entry[$i]['studentName'] }}</td>
                                        <td>{{ $entry[$i]['academyName'] }}</td>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" name="practiceGrade[]" value="{{ $entry[$i]['practiceGrade'] }}">
                                        </td>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" name="articleGrade[]" value="{{ $entry[$i]['articleGrade'] }}">
                                        </td>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" name="testGrade[]" value="{{ $entry[$i]['testGrade'] }}">
                                        </td>
                                    </tr>
                                @endforeach
                            @endfor
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>培训名称</th>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>学院</th>
                                <th>实践</th>
                                <th>论文</th>
                                <th>笔试</th>
                            </tr>
                            </tfoot>
                        </table>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary" onclick="if(confirm('确认要提交本页面的成绩列表吗？'))location.href='{{url('admin/academy/grade-input')}}'">提交</button>
                    </form>
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