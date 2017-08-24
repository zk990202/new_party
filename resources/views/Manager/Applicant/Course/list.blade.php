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
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>课程名称</th>
                                <th>添加时间</th>
                                <th>状态</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>
                                        <a href="{{ url('manager/applicant/course/{id}/detail') }}">
                                            {{ $course['courseName'] }}
                                        </a>
                                    </td>
                                    <td>{{ $course['time'] }}</td>
                                    <td>{{ $course['isHidden'] ? '隐藏' : '显示'}}</td>
                                    <td>
                                        @if($course['isHidden'])
                                            <button type="button" class="btn btn-block btn-success btn-xs"  onclick="showCourses({{ $course['id'] }});">显示</button>
                                        @else
                                            <button type="button" class="btn btn-block btn-danger btn-xs" onclick="hideCourses({{ $course['id'] }});">隐藏</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/applicant/article/'.$course['id']).'/add' }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">添加文章</button></a>
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/applicant/exercise/'.$course['id']).'/add' }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">添加题目</button></a>
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/applicant/course/'.$course['id']).'/edit' }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">修改内容
                                            </button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>课程名称</th>
                                <th>添加时间</th>
                                <th>状态</th>
                                <th>操作</th>
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
        var hideCourses = function hideCourses (coursesId) {
            $.ajax({
                'url': '/manager/applicant/course/' + coursesId + '/hide',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var showCourses = function (coursesId) {
            $.ajax({
                'url': '/manager/applicant/course/' + coursesId + '/hide',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

    </script>
@endsection
