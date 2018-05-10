
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">学生状态初始化</h3>
                </div>
                <div class="page-header">
                    <1>这里需要注意:可能您在其他页面勾选的人不会出现在这里:说明那些人已经进行过了初始化.每人只能进行一次初始化. <br>
                    <2>只有新生可以进行初始化操作,并且整个初始化的开放权在超管手中.会在相应的时间段开放初始化通道! <br>
                    <3>超管同样不能在本页面做初始化操作.如果有特殊情况,请在状态微调中对极少数学生进行状态修改操作!
                </div>
                <form method="POST" action="{{ url('admin/student-info/init') }}">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>专业</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($studentInfos as $studentInfo)
                            <tr>
                                <td>
                                    <input type="checkbox" name="sno[]" value="{{ $studentInfo['sno'] }}">{{ $studentInfo['sno'] }}
                                </td>
                                <td>{{ $studentInfo['studentName'] }}</td>
                                <td>{{ $studentInfo['academyName'] }}</td>
                                <td>{{ $studentInfo['majorName'] }}</td>
                                {{--<input type="hidden" name="entryId[]" value="{{ $studentInfo['id'] }}">--}}
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>专业</th>
                        </tr>
                        </tfoot>
                    </table>

                    <input type="text" name="status_applicant_book" value="1">
                    <input type="text" name="status_applicant_study" value="1">
                    <input type="text" name="status_applicant_exam" value="1">

                    <input type="text" name="status_thought_report[]" value="1">
                    <input type="text" name="status_thought_report[]" value="2">
                    <input type="text" name="status_thought_report[]" value="3">
                    <input type="text" name="status_thought_report[]" value="4">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-footer">
                        <button id="submitButton" type="submit" class="btn btn-primary">提交</button>
                    </div>
                </form>

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

