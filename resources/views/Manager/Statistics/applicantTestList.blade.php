@extends('layouts.app')

@section('main')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#applicantTestList_chart" data-toggle="tab">LLLLL</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> 申请人结业统计</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="applicantTestList_chart" style="position: relative;"></div>
                    </div>
                </div>
            </section>

        </div>
        <!-- Main row -->
    </section>
@endsection

@section('func')
    <script>
        $.ajax({
            'url' : '/manager/statistics/applicantTestList',
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
                console.log(c_res);
                new Morris.Area({
                    element   : 'applicantTestList_chart',
                    resize    : true,
                    data      : c_res,
                    xkey      : 'name',
                    ykeys     : ['res_all', 'res_pass'],
                    labels    : ['参加考试人数', '通过考试人数'],
                    lineColors: ['#a0d0e0', '#3c8dbc'],
                    hideHover : 'auto'
                });

            }
        });

    </script>
@endsection