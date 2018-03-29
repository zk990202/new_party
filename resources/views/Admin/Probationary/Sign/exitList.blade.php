
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $train[0]['name'] }} 退报名名单</h3>
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
                                {{--<th>继续学习</th>--}}
                                <th>是否退选</th>
                                <th>操作</th>
                                <th>操作</th>
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
                                    <td>
                                        @if($sign['isExit'])
                                            是
                                        @else
                                            否
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$train[0]['isEndInsert'])
                                            @if($sign['isExit'])
                                                <button type="button" class="btn btn-block btn-danger btn-xs" onclick="if(confirm('确认恢复选课？')) inCourseChoose({{ $sign['id'] }})">恢复选课</button>
                                            @else
                                                <button type="button" class="btn btn-block btn-danger btn-xs" onclick="if(confirm('确认退出选课?')) exitCourseChoose({{ $sign['id'] }})">退出选课</button>
                                            @endif
                                        @else
                                            无操作
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-warning btn-xs" onclick="if(confirm('该操作不可恢复，确认要删除吗?')) deleteEntry({{ $sign['id'] }})">删除</button>
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
                                <th>报名时间</th>
                                {{--<th>继续学习</th>--}}
                                <th>是否退选</th>
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
        var inCourseChoose = function(id) {
            $.ajax({
                url: '/admin/probationary/sign/' + id + '/inCourseChoose',
                method: 'post',
                data: 'form',
                dataType : 'json',
                success: function (data) {
                    if(data.success){
                        alert('恢复选课成功！');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            });
        };
        var exitCourseChoose = function(id) {
            $.ajax({
                url: '/admin/probationary/sign/' + id + '/exitCourseChoose',
                method: 'post',
                data: 'form',
                dataType : 'json',
                success: function (data) {
                    if(data.success){
                        alert('退出选课成功！');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            });
        };
        var deleteEntry = function(id) {
            $.ajax({
                url: '/admin/probationary/sign/' + id + '/delete',
                method: 'post',
                data: 'form',
                dataType : 'json',
                success: function (data) {
                    if(data.success){
                        alert('删除成功！');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            });
        };
    </script>

