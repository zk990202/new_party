
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $train[0]['name'] }} 结业成绩录入</h3>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{url('admin/probationary/graduation/input')}}" >
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>学号</th>
                                    <th>姓名</th>
                                    <th>学院</th>
                                    <th>专业</th>
                                    <th>培训期数</th>
                                    <th>实践</th>
                                    <th>论文</th>
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
                                            <input type="hidden" name="trainId[]" value="{{ $entry['trainId'] }}">
                                        </td>
                                        <td>{{ $entry['studentName'] }}</td>
                                        <td>{{ $entry['academyName'] }}</td>
                                        <td>{{ $entry['majorName'] }}</td>
                                        <td>{{ $entry['trainName'] }}</td>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" name="practiceGrade[]" value="{{ $entry['practiceGrade'] }}">
                                        </td>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" name="articleGrade[]" value="{{ $entry['articleGrade'] }}">
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
                                    <th>专业</th>
                                    <th>培训期数</th>
                                    <th>实践</th>
                                    <th>论文</th>
                                    <th>状态</th>
                                </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary" onclick="if(confirm('确认要提交本页面的成绩列表吗？'))location.href='{{url('admin/probationary/graduation/input')}}'">提交</button>
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

