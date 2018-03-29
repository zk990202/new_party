
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $train[0]['name'] }} 结业成绩调整</h3>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{url('admin/probationary/graduation/change')}}" >
                            <div class="box-body">
                                <label for="first">基本信息</label>
                                <table id="example1" class="table table-bordered table-striped">
                                    <tr>
                                        <th>学号</th>
                                        <th>姓名</th>
                                        <th>学院</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $entry[0]['sno'] }}</td>
                                        <td>{{ $entry[0]['studentName'] }}</td>
                                        <td>{{ $entry[0]['academyName'] }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="box-body">
                                <label for="second">培训信息</label>
                                <table id="example1" class="table table-bordered table-striped">
                                    <tr>
                                        <th>所属培训</th>
                                        <td>{{ $entry[0]['trainName'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>实践成绩</th>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" class="form-control" name="practiceGrade" value="{{ $entry[0]['practiceGrade'] }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>论文成绩</th>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" class="form-control" name="articleGrade" value="{{ $entry[0]['articleGrade'] }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>通过必修课</th>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" class="form-control" name="passCompulsory" value="{{ $entry[0]['passCompulsory'] }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>继承上期必修课</th>
                                        <td>
                                            @if($lastTrainEntry[0]['passCompulsory'])
                                                {{ $lastTrainEntry[0]['passCompulsory'] }}课
                                            @else
                                                0课
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>通过选修课</th>
                                        <td>
                                            <input type="text" style="width:50px;height:25px;" class="form-control" name="passElective" value="{{ $entry[0]['passElective'] }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>继承上期选修课</th>
                                        <td>
                                            @if($lastTrainEntry[0]['passElective'])
                                                {{ $lastTrainEntry[0]['passElective'] }}课
                                            @else
                                                0课
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>培训最终状态</th>
                                        <td>
                                            @if($entry[0]['isAllPassed'])
                                                通过
                                            @else
                                                未通过
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>结业状态</th>
                                        <td>
                                            <select name="status" style="width:100px;height:35px;" class="form-control">
                                                @if($entry[0]['status'] == 1)
                                                    <option value="1" selected>正常</option>
                                                    <option value="2">抄袭</option>
                                                    <option value="3">缺考</option>
                                                @elseif($entry[0]['status'] == 2)
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
                                    <tr>
                                        <th>作弊次数</th>
                                        <td>
                                            <input type="text" style="width:100px;height:35px;" class="form-control" name="countCheat" value="{{ $entry[0]['countCheat'] }}">
                                        </td>
                                    </tr>

                                </table>
                            </div>

                            <div class="box-body">
                                <label for="third">该学生的所有的选课记录</label>
                                <table id="example1" class="table table-bordered table-striped">
                                    <tr>
                                        <th>课程名称</th>
                                        <th>类型</th>
                                        <th>成绩</th>
                                        <th>状态</th>
                                    </tr>
                                    @foreach($children as $child)
                                        <tr>
                                            <td>{{ $child['courseName'] }}</td>
                                            <td>
                                                @if($child['courseType'])
                                                    选修
                                                @else
                                                    必修
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" style="width:50px;height:25px;" name="grade[]" value="{{ $child['grade'] }}">
                                                <input type="hidden" name="childEntryId[]" value="{{ $child['id'] }}">
                                            </td>
                                            <td>
                                                <select name="childStatus[]" class="form-control">
                                                    @if($child['status'] == 1)
                                                        <option value="1" selected>正常</option>
                                                        <option value="2">抄袭</option>
                                                        <option value="3">缺考</option>
                                                    @elseif($child['status'] == 2)
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
                                </table>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="sno" value="{{ $entry[0]['sno'] }}">
                            <input type="hidden" name="isAllPassed" value="{{ $entry[0]['isAllPassed']}}">
                            <input type="hidden" name="entryFormId" value="{{ $entry[0]['id'] }}">
                            <button type="submit" class="btn btn-primary" onclick="if(confirm('确认要提交本页面的成绩列表吗？'))location.href='{{url('admin/probationary/graduation/change')}}'">提交</button>
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

