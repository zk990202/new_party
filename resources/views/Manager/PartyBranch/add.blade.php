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
                        <h3 class="box-title">支部组建:在这里,你可以选择支部的所属学院,支部类型以及年级信息.若是多个年级一块,或者是学历混杂,则请选择混合党支部!</h3>
                    </div>
                    <form role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="academy">所属学院</label>
                                <select id="academyId" class="form-control">
                                    <option value="">--(必选项)--</option>
                                    @foreach($colleges as $college)
                                        <option value="{{ $college['id'] }}">{{ $college['shortname'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">支部类型</label>
                                <select id="type" class="form-control">
                                    <option value="">--(必选项)--</option>
                                    <option value="1">本科生</option>
                                    <option value="2">硕士生</option>
                                    <option value="3">博士生</option>
                                    <option value="4">混合</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="schoolYear">所属年级</label>
                                <select id="schoolYear" class="form-control">
                                    <option value="">--(必选项)--</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade }}">{{ $grade }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="childName">子名称</label>
                                <input type="text" class="form-control" id="childName" placeholder="如：第一">
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label for="name">总名称</label>--}}
                                {{--<input type="text" class="form-control" id="name" value="{{ $branch['name'] }}" readonly>--}}
                            {{--</div>--}}
                        </div>
                        {{--<input type="hidden" id="branchId" value="{{ $branch['id'] }}">--}}
                    </form>
                    <div class="box-footer">
                        <button id="submitButton" type="button" class="btn btn-primary">提交</button>
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

        $('#submitButton').click(function(){
            var form = new FormData;
            form.append('academyId', $('#academyId').val());
            form.append('type', $('#type').val());
            form.append('schoolYear', $('#schoolYear').val());
            form.append('childName', $('#childName').val());
//            form.append('name', $('#name').val());
            $.ajax({
                url: '/manager/party-branch/add',
                type: 'post',
                data: form,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.success){
                        alert('组建成功');
                        window.location.href = '/manager/party-branch/add';
                    }
                    else{
                        alert(data.message);
                    }
                },
                error: function(){
                    alert(data.statusText);
                }
            })
        });

    </script>
@endsection
