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
                        <h3 class="box-title">结业成绩列表</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>学院</th>
                                <th>考试期数</th>
                                <th>实践</th>
                                <th>论文</th>
                                <th>必修1</th>
                                <th>必修2</th>
                                <th>必修3</th>
                                <th>选修</th>
                                <th>是否通过</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($entries as $entry)
                                <tr>
                                    <td>{{ $entry['sno'] }}</td>
                                    <td>{{ $entry['studentName'] }}</td>
                                    <td>{{ $entry['academyName'] }}</td>
                                    <td>{{ $entry['trainName'] }}</td>
                                    <td>{{ $entry['practiceGrade'] }}</td>
                                    <td>{{ $entry['articleGrade'] }}</td>
                                    <td>{{ $entry['children'][0]['grade'] }}</td>
                                    <td>{{ $entry['children'][1]['grade'] }}</td>
                                    <td>{{ $entry['children'][2]['grade'] }}</td>
                                    <td>{{ $entry['children'][3]['grade'] }}</td>
                                    <td>
                                        @if($entry['isAllPassed'] == 1)
                                            通过
                                        @else
                                            未通过
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>学院</th>
                                <th>考试期数</th>
                                <th>实践</th>
                                <th>论文</th>
                                <th>必修1</th>
                                <th>必修2</th>
                                <th>必修3</th>
                                <th>选修</th>
                                <th>是否通过</th>
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

    </script>
@endsection
