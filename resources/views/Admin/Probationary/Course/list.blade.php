
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">课程列表</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>课程名称</th>
                                <th>所属期数</th>
                                <th>开课时间</th>
                                <th>地点</th>
                                <th>主讲人/视频名称</th>
                                <th>类型</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>成绩录入状态</th>
                                <th>成绩录入</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>
                                        @if(!$course['type'])
                                            <a href="{{ url('admin/probationary/course/'.$course['id'].'/detail/compulsory') }}">
                                                {{ $course['name'] }}
                                            </a>
                                        @else
                                            <a href="{{ url('admin/probationary/course/'.$course['id'].'/detail/elective') }}">
                                                {{ $course['name'] }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $course['trainName'] }}</td>
                                    <td>{{ $course['time'] }}</td>
                                    <td>{{ $course['place'] }}</td>
                                    <td>{{ $course['speaker'] }}</td>
                                    <td>
                                        @if($course['type'])
                                            选修
                                        @else
                                            必修
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$course['type'])
                                            <a href="{{ url('admin/probationary/course/'.$course['id'].'/edit/compulsory') }}">
                                                <button type="button" class="btn btn-block btn-info btn-xs">编辑</button>
                                            </a>
                                        @else
                                            <a href="{{ url('admin/probationary/course/'.$course['id'].'/edit/elective') }}">
                                                <button type="button" class="btn btn-block btn-info btn-xs">编辑</button>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-warning btn-xs"
                                        onclick="if(confirm('确认要删除课程吗？该操作不可恢复')) deleteCourse({{ $course['id'] }})">删除</button>
                                    </td>
                                    <td>
                                        @if($course['canInsert'])
                                            开启
                                        @else
                                            关闭
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$course['canInsert'] && $course['isInserted'])
                                            无操作
                                        @elseif(!$course['canInsert'] && !$course['isInserted'])
                                            <button type="button" class="btn btn-block btn-success btn-xs"
                                            onclick="if(confirm('真的要开启成绩录入功能吗？')) openGradeInput({{ $course['id'] }})">开启</button>
                                        @else
                                            <button type="button" class="btn btn-block btn-danger btn-xs"
                                            onclick="if(confirm('真的要关闭成绩录入功能吗？')) closeGradeInput({{ $course['id'] }})">关闭</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>课程名称</th>
                                <th>所属期数</th>
                                <th>开课时间</th>
                                <th>地点</th>
                                <th>主讲人/视频名称</th>
                                <th>类型</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>成绩录入状态</th>
                                <th>成绩录入</th>
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

        var deleteCourse = function (id) {
            $.ajax({
                url: '/admin/probationary/course/' + id + '/delete',
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('删除成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };

        var openGradeInput = function(id) {
            $.ajax({
                url: '/admin/probationary/course/' + id + '/open',
                method: 'post',
                data: 'form',
                dataType : 'json',
                success: function (data) {
                    if(data.success){
                        alert('开启录入成功！');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            });
        };
        var closeGradeInput = function(id) {
            $.ajax({
                url: '/admin/probationary/course/' + id + '/close',
                method: 'post',
                data: 'form',
                dataType : 'json',
                success: function (data) {
                    if(data.success){
                        alert('结束录入成功！');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            });
        };
    </script>

