
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $train[0]['name'] }} 课程成绩录入</h3>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{url('admin/probationary/course-gradeInput')}}" >
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>学号</th>
                                    <th>姓名</th>
                                    <th>学院</th>
                                    <th>课程名称</th>
                                    <th>成绩</th>
                                    <th>状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($entries as $entry)
                                    <tr>
                                        <td>
                                            {{ $entry['sno'] }}
                                            <input type="hidden" name="id[]" value="{{ $entry['id'] }}">
                                            <input type="hidden" name="sno[]" value="{{ $entry['sno'] }}">
                                            <input type="hidden" name="courseId[]" value="{{ $entry['courseId'] }}">
                                        </td>
                                        <td>{{ $entry['studentName'] }}</td>
                                        <td>{{ $entry['academyName'] }}</td>
                                        <td>{{ $entry['courseName'] }}</td>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" name="grade[]" value="{{ $entry['grade'] }}">
                                        </td>
                                        <td>
                                            <select name="status[]" class="form-control">
                                                @if($entry['status'] == 1)
                                                    <option value="1" selected>正常</option>
                                                    <option value="2">抄袭</option>
                                                    <option value="3">缺考</option>
                                                @elseif($entry['status'] == 2)
                                                    <option value="1">正常</option>
                                                    <option value="2" selected>抄袭</option>
                                                    <option value="3">缺考</option>
                                                @else
                                                    <option value="1">正常</option>
                                                    <option value="2">抄袭</option>
                                                    <option value="3" selected>缺考</option>
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>学号</th>
                                    <th>姓名</th>
                                    <th>学院</th>
                                    <th>课程名称</th>
                                    <th>成绩</th>
                                    <th>状态</th>
                                </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary" onclick="if(confirm('确认要提交本页面的成绩列表吗？'))location.href='{{url('admin/probationary/course-gradeInput')}}'">提交</button>
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

