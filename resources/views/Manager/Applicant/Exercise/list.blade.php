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
                        <h3 class="box-title">如需添加题目，请转至课程设置并选择相应的课程添加</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>题干</th>
                                <th>所属课程</th>
                                <th>类型</th>
                                <th>答案</th>
                                <th>状态</th>
                                <th>操作</th>
                                <th>操作</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exercises as $exercise)
                                <tr>
                                    <td>{!! $exercise['content'] !!}</td>
                                    <td>{{ $exercise['courseName'] }}</td>
                                    <td>
                                        @if($exercise['type'] == 0)
                                            单选
                                        @else
                                            多选
                                        @endif
                                    </td>
                                    <td>
                                        {{--@if($exercise['answerNumber'] == 1)A--}}
                                        {{--@elseif($exercise['answerNumber'] ==  2)B--}}
                                        {{--@elseif($exercise['answerNumber'] ==  4)C--}}
                                        {{--@elseif($exercise['answerNumber'] ==  8)D--}}
                                        {{--@elseif($exercise['answerNumber'] == 16)E--}}
                                        {{--@elseif($exercise['answerNumber'] ==  3)AB--}}
                                        {{--@elseif($exercise['answerNumber'] ==  5)AC--}}
                                        {{--@elseif($exercise['answerNumber'] ==  9)AD--}}
                                        {{--@elseif($exercise['answerNumber'] == 17)AE--}}
                                        {{--@elseif($exercise['answerNumber'] ==  6)BC--}}
                                        {{--@elseif($exercise['answerNumber'] == 10)BD--}}
                                        {{--@elseif($exercise['answerNumber'] == 18)BE--}}
                                        {{--@elseif($exercise['answerNumber'] == 12)CD--}}
                                        {{--@elseif($exercise['answerNumber'] == 20)CE--}}
                                        {{--@elseif($exercise['answerNumber'] == 24)DE--}}
                                        {{--@elseif($exercise['answerNumber'] ==  7)ABC--}}
                                        {{--@elseif($exercise['answerNumber'] == 11)ABD--}}
                                        {{--@elseif($exercise['answerNumber'] == 19)ABE--}}
                                        {{--@elseif($exercise['answerNumber'] == 13)ACD--}}
                                        {{--@elseif($exercise['answerNumber'] == 21)ACE--}}
                                        {{--@elseif($exercise['answerNumber'] == 25)ADE--}}
                                        {{--@elseif($exercise['answerNumber'] == 14)BCD--}}
                                        {{--@elseif($exercise['answerNumber'] == 22)BCE--}}
                                        {{--@elseif($exercise['answerNumber'] == 26)BDE--}}
                                        {{--@elseif($exercise['answerNumber'] == 28)CDE--}}
                                        {{--@elseif($exercise['answerNumber'] == 15)ABCD--}}
                                        {{--@elseif($exercise['answerNumber'] == 23)ABCE--}}
                                        {{--@elseif($exercise['answerNumber'] == 27)ABDE--}}
                                        {{--@elseif($exercise['answerNumber'] == 29)ACDE--}}
                                        {{--@elseif($exercise['answerNumber'] == 30)BCDE--}}
                                        {{--@elseif($exercise['answerNumber'] == 31)ABCDE--}}
                                        {{--@endif--}}
                                        {{ $exercise['answerLetter'] }}
                                    </td>
                                    <td>{{ $exercise['isHidden'] ? '隐藏' : '显示'}}</td>
                                    <td>
                                        @if($exercise['isHidden'])
                                            <button type="button" class="btn btn-block btn-success btn-xs"  onclick="showExercise({{ $exercise['id'] }});">显示</button>
                                        @else
                                            <button type="button" class="btn btn-block btn-danger btn-xs" onclick="hideExercise({{ $exercise['id'] }});">隐藏</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('manager/applicant/exercise/'.$exercise['id']).'/edit' }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">编辑</button></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-success btn-xs" onclick="if(confirm('确认要执行该项操作?此操作是不可恢复操作,是否继续?')) deleteExercise({{ $exercise['id'] }})">删除</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>题干</th>
                                <th>所属课程</th>
                                <th>类型</th>
                                <th>答案</th>
                                <th>状态</th>
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
        var hideExercise = function hideExercise (exerciseId) {
            $.ajax({
                'url': '/manager/applicant/exercise/' + exerciseId + '/hide',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var showExercise = function (exerciseId) {
            $.ajax({
                'url': '/manager/applicant/exercise/' + exerciseId + '/hide',
                'method': 'patch',
                'success': function (data) {
                    window.location.reload();
                }
            });
        };

        var deleteExercise = function (exerciseId) {
            $.ajax({
                'url': '/manager/applicant/exercise/' + exerciseId + '/delete',
                'method': 'post',
                'success': function (data) {
                    window.location.reload();
                }
            })
        }

    </script>
@endsection
