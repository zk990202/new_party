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
                        <h3 class="box-title">非支部成员列表</h3>
                    </div>
                    <div class="box-body">
                        {{--<form role="form" enctype="multipart/form-data">--}}
                        <form method="POST" action="{{ url('manager/party-branch/'.$branch[0]['id'].'/member-add-mix') }}">
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
                                @foreach($members as $member)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="sno[]" value="{{ $member['sno'] }}">{{ $member['sno'] }}
                                        </td>
                                        <td>{{ $member['studentName'] }}</td>
                                        <td>{{ $member['academyName'] }}</td>
                                        <td>{{ $member['majorName'] }}</td>
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
                            <input type="hidden" name="schoolYear" value="{{ $schoolYear }}">
                            <input type="hidden" name="studentType" value="{{ $studentType }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
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
