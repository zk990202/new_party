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
                        <h3 class="box-title">混合党支部成员添加--选择查询条件,然后根据所出列表选择没有支部的学员,添加到该支部!</h3>
                    </div>
                    <form method="GET" action="{{ url('manager/party-branch/'.$branch['id']).'/member-add-mix' }}">
                        <div class="form-group">
                            <label for="academyName">学院</label>
                            <input type="text" class="form-control" value="{{ $branch['academyName'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="schoolYear">年级</label>
                            <select name="schoolYear" class="form-control">
                                <option value="">--(可选项)--</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade }}">{{ $grade }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">学历</label>
                            <select name="studentType" class="form-control">
                                <option value="">--(可选项)--</option>
                                <option value="1">本科生</option>
                                <option value="2">硕士生</option>
                                <option value="3">博士生</option>
                            </select>
                        </div>
                        <div class="box-footer">
                            <button id="submitButton" type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>

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
