
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>申诉类型</th>
                            <th>所属考试</th>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>回复</th>
                            <th>阅读</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($complains as $complain)
                            <tr>
                                <td>
                                    {{--这里进行判断，如果toSno不为空，则申诉已被回复，显示的页面不含有文本框--}}
                                    @if($complain['toSno'])
                                        <a href="{{ url('admin/applicant/complain/'.$complain['id'].'/detail_1') }}">
                                            {{ $complain['title'] }}
                                        </a>
                                        {{--未被回复的页面，含有编辑器--}}
                                    @else
                                        <a href="{{ url('admin/applicant/complain/'.$complain['id'].'/detail') }}">
                                            {{ $complain['title'] }}
                                        </a>
                                    @endif
                                </td>
                                <td>申请人党校</td>
                                <td>{{ $complain['testName']}}</td>
                                <td>{{ $complain['fromSno'] }}</td>
                                <td>{{ $complain['studentName'] }}</td>
                                <td>{{ $complain['academyName'] }}</td>
                                <td>
                                    @if($complain['toSno'])
                                        已回复
                                    @else
                                        未回复
                                    @endif
                                </td>
                                <td>
                                    @if($complain['isRead'])
                                        已读
                                    @else
                                        未读
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>标题</th>
                            <th>申诉类型</th>
                            <th>所属考试</th>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>回复</th>
                            <th>阅读</th>
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

