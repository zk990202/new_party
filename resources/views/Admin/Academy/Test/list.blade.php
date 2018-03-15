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
                        <h3 class="box-title">如需查找指定期数的培训，请在右侧的搜索栏搜索</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>培训名称</th>
                                <th>所选期数</th>
                                <th>所属学院</th>
                                <th>开始时间</th>
                                <th>当前状态</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tests as $test)
                                <tr>
                                    <td>
                                        <a href="{{ url('manager/academy/test-list/'.$test['id'].'/detail') }}">{{ $test['name'] }}</a>
                                    </td>
                                    <td>{{ $test['trainName'] }}</td>
                                    <td>{{ $test['academyName'] }}</td>
                                    <td>{{ $test['time'] }}</td>
                                    <td>
                                        @if(!$test['status'])
                                            未开启
                                        @elseif($test['status'] == 1)
                                            报名开始
                                        @elseif($test['status'] == 2)
                                            报名截至
                                        @elseif($test['status'] == 3)
                                            成绩录入
                                        @elseif($test['status'] == 4)
                                            录入结束
                                        @elseif($test['status'] == 5)
                                            考试结束
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/academy/test-list/'.$test['id']).'/edit' }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">编辑</button></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-danger btn-xs" onclick="if(confirm('确认要执行该项操作?此操作是不可恢复操作,是否继续?')) deleteTest({{ $test['id'] }})">删除</button>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                                状态编辑
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @if($test['isDeleted'])
                                                    <li>
                                                        <a href="#">
                                                            无操作
                                                        </a>
                                                    </li>
                                                @else
                                                    @if(!$test['status'])
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要开启报名?')) startSign({{ $test['id'] }})">报名开始</a>
                                                        </li>
                                                    @elseif($test['status'] == 1)
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要截止报名?')) endSign({{ $test['id'] }})">截止报名</a>
                                                        </li>
                                                    @elseif($test['status'] == 2)
                                                        {{--这里权限待接入--}}
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要开启成绩录入?')) gradeInput({{ $test['id'] }})">成绩录入</a>
                                                        </li>
                                                    @elseif($test['status'] == 3)
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要结束成绩录入?')) endInput({{ $test['id'] }})">录入结束</a>
                                                        </li>
                                                    @elseif($test['status'] == 4)
                                                        <li>
                                                            <a href="#" onclick="if(confirm('确定要结束考试?')) endTest({{ $test['id'] }})">考试结束</a>
                                                        </li>
                                                    @elseif($test['status'] == 5)
                                                        <li>
                                                            <a href="#">
                                                                无操作
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>培训名称</th>
                                <th>所选期数</th>
                                <th>所属学院</th>
                                <th>开始时间</th>
                                <th>当前状态</th>
                                <th>操作</th>
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
        var deleteTest = function(id) {
            $.ajax({
                url: '/manager/academy/test-list/' + id + '/delete',
                method: 'patch',
                dataType : 'json',
                success: function (data) {
                    if(data.success){
                        alert('删除成功');
                        window.location.reload();
                    } else{
                        alert(data.message);
                    }
                }
            });
        };
        var startSign = function (id) {
            $.ajax({
                url: '/manager/academy/test-list/' + id + '/change/1',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('报名开始成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };
        var endSign = function (id) {
            $.ajax({
                url: '/manager/academy/test-list/' + id + '/change/2',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('结束报名成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };
        var gradeInput = function (id) {
            $.ajax({
                url: '/manager/academy/test-list/' + id + '/change/3',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('开启成绩录入成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };
        var endInput = function (id) {
            $.ajax({
                url: '/manager/academy/test-list/' + id + '/change/4',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('结束成绩录入成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };
        var endTest = function (id) {
            $.ajax({
                url: '/manager/academy/test-list/' + id + '/change/5',
                method: 'patch',
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        alert('结束考试成功');
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        };
    </script>
@endsection
