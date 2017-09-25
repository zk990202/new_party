@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('main')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">总培训列表</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>课程期数</th>
                                <th>培训时间</th>
                                <th>培训状态</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>结业成绩录入</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trains as $train)
                                <tr>
                                    <td>
                                        <a href="{{ url('manager/probationary/train/'.$train['id'].'/detail') }}">
                                            {{ $train['name'] }}
                                        </a>
                                    </td>
                                    <td>{{ $train['time'] }}</td>
                                    <td>
                                        {{--{{ $train['status']}}--}}
                                        @if($train['isEnd'])
                                            进行中
                                        @else
                                            已结束
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/probationary/train/'.$train['id'].'/edit') }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">编辑考试</button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/probationary/train/'.$train['id'].'/status') }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">修改状态</button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <button type="button" class="btn btn-block btn-info btn-xs">必修课添加</button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <button type="button" class="btn btn-block btn-info btn-xs">选修课添加</button>
                                        </a>
                                    </td>
                                    <td>
                                        @if($train['endInsert'])
                                            {{--<a href="{{ url('Manager/Probationary/train/'.$train['id'].'/open') }}">--}}
                                            <button type="button" class="btn btn-block btn-success btn-xs" onclick="if(confirm('注意:这里想要结束成绩录入,则必须所有的课程成绩录入都必须结束.而且一旦结束该成绩录入,所有的成绩将不能被修改.真的确定要结束成绩的录入吗?')) closeTrain({{ $train['id'] }})">结束录入</button>
                                        @elseif($train['isEndInsert'])
                                            无操作
                                        @else
                                            <button type="button" class="btn btn-block btn-danger btn-xs" onclick="if(confirm('成绩录入开启状态只能进行一次!一般都是等所有课程结束之后再进行本次结业成绩录入通道的开启,是否继续开启本通道?')) openTrain({{ $train['id'] }})">开启录入</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>课程期数</th>
                                <th>培训时间</th>
                                <th>培训状态</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>结业成绩录入</th>
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
@endsection

@section('func')
    <script src="/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>

        $(function () {
            $('#example1').DataTable({
                "ordering" : false
            });
        });
        var openTrain = function openTrain (id) {
            $.ajax({
                url: '/manager/probationary/train/' + id + '/open',
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
        var closeTrain = function closeTrain (id) {
            $.ajax({
                url: '/manager/probationary/train/' + id + '/close',
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
@endsection
