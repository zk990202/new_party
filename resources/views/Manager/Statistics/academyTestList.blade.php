@extends('layouts.app')

@section('main')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#academyTestListChart" data-toggle="tab">^_^</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> 积极分子结业统计</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="academyTestListChart" style="position: relative;"></div>
                    </div>
                </div>
            </section>
            <form action="{{ url('/manager/statistics/academyTestListPage') }}" class="form-horizontal" method="get">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="add-on">编号</span>
                            <select name="test_parent" class="input-large" >
                                @foreach($test as $i => $v)
                                    @if($v->test_id == $test_parent)
                                        <option value="{{$v->test_id}}" selected>{{$v->test_name}}</option>
                                    @else
                                        <option value="{{$v->test_id}}">{{$v->test_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="submit" class="btn btn-success btn-small">
                        </div>

                    </div>
                </div>
            </form>

        </div>
        <!-- Main row -->
    </section>
@endsection

@section('func')
    <script>
        $.ajax({
            'url' : '/manager/statistics/academyTestList',
            'method' : 'get',
            'success' : function(data){
                console.log(data);
                var c_res = [];
                for(var i = 0; i < data.res_all.length; i ++){
                    c_res[i] = {
                        name: data.res_all[i][0],
                        res_all : data.res_all[i][1],
                        res_pass : data.res_pass[i][1]
                    }
                }
//                console.log(c_res);
                new Morris.Bar({
                    element: 'academyTestListChart',
                    resize: true,
                    data: c_res,
                    barColors: ['#00a65a', '#f56954'],
                    xkey: 'name',
                    ykeys: ['res_all', 'res_pass'],
                    labels: ['参加考试人数', '通过考试人数'],
                    hideHover: 'auto'
                });

            }
        });

    </script>
@endsection