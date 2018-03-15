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
                        <h3 class="box-title">证书列表</h3>
                    </div>
                    <div class="box-body">
                        {{--<form role="form" enctype="multipart/form-data">--}}
                        <form method="POST" action="{{ url('manager/probationary/certificate/grant-result') }}">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>学号</th>
                                    <th>姓名</th>
                                    <th>学院</th>
                                    <th>专业</th>
                                    <th>笔试</th>
                                    <th>论文</th>
                                    <th>考试状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($certificates as $certificate)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="sno[]" value="{{ $certificate['sno'] }}">{{ $certificate['sno'] }}
                                        </td>
                                        <td>{{ $certificate['studentName'] }}</td>
                                        <td>{{ $certificate['academyName'] }}</td>
                                        <td>{{ $certificate['majorName'] }}</td>
                                        <td>{{ $certificate['practiceGrade'] }}</td>
                                        <td>{{ $certificate['articleGrade'] }}</td>
                                        <td>
                                            @if($certificate['isPassed'] == 2)
                                                优秀
                                            @elseif($certificate['isPassed'] == 1)
                                                合格
                                            @elseif($certificate['isPassed'] == 0)
                                                不合格
                                            @endif
                                        </td>
                                        {{--<input type="hidden" name="entryId[]" value="{{ $certificate['id'] }}">--}}
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>学号</th>
                                    <th>姓名</th>
                                    <th>学院</th>
                                    <th>专业</th>
                                    <th>笔试</th>
                                    <th>论文</th>
                                    <th>考试状态</th>
                                </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="getPerson">领取人</label>
                                <input type="text" name="getPerson">
                            </div>
                            <div class="form-group">
                                <label for="place">存放点</label>
                                <input type="text" name="place">
                            </div>
                            <div class="box-footer">
                                <button id="submitButton" type="submit" class="btn btn-primary">提交</button>
                            </div>
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
@endsection

@section('func')
    <script src="/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>

        $(function () {
            $('#example1').DataTable({
                "ordering" : false
            });

//            $('#submitButton').click(function () {
//                var form = new FormData();
//                form.append('sno', $('#sno'));
//                form.append('getPerson', $('#getPerson'));
//                form.append('place', $('#place'));
//                $.ajax({
//                    url: '/manager/applicant/certificate/grant-result',
//                    type: 'POST',
//                    data: form,
//                    cache: false,
//                    dataType: 'json',
//                    processData: false,
//                    contentType: false,
//                    success: function(data){
//                        if(data.success){
//                            alert('证书发放成功');
//                            window.location.href = 'manager/applicant/certificate/grant'
//                        }
//                        else{
//                            alert(data.message);
//                        }
//                    }
//                });
//            })
        });
    </script>
@endsection
