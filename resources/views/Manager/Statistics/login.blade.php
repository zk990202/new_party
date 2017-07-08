@extends('layouts.app')

@section('main')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#login_week_chart" data-toggle="tab">过去一周</a></li>
                        <li ><a href="#login_month_chart" data-toggle="tab">过去一月</a></li>
                        <li ><a href="#login_year_chart" data-toggle="tab">过去一年</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> 登录统计</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="login_week_chart" style="position: relative;"></div>
                        <div class="chart tab-pane" id="login_month_chart" style="position: relative;"></div>
                        <div class="chart tab-pane" id="login_year_chart" style="position: relative;"></div>
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
            'url' : '/manager/statistics/login',
            'method' : 'get',
            'success' : function(data){
                var c_week = []
                var c_month = []
                var c_year = [];
                for(var i = 0; i < data.week.admin.length; i ++){
                    c_week[i] = {
                        y: data.week.admin[i].login_date,
                        user : data.week.user[i].login_num,
                        admin : data.week.admin[i].login_num
                    }
                }
                for(var i = 0; i < data.month.admin.length; i ++){
                    c_month[i] = {
                        y: data.month.admin[i].login_date,
                        user : data.month.user[i].login_num,
                        admin : data.month.admin[i].login_num
                    }
                }
                for(var i = 0; i < data.year.admin.length; i ++){
                    c_year[i] = {
                        y: data.year.admin[i].login_date,
                        user : data.year.user[i].login_num,
                        admin : data.year.admin[i].login_num
                    }
                }

                new Morris.Area({
                    element   : 'login_week_chart',
                    resize    : true,
                    data      : c_week,
                    xkey      : 'y',
                    ykeys     : ['user', 'admin'],
                    labels    : ['用户', '管理后台'],
                    lineColors: ['#a0d0e0', '#3c8dbc'],
                    hideHover : 'auto'
                });

                new Morris.Area({
                    element   : 'login_month_chart',
                    resize    : true,
                    data      : c_month,
                    xkey      : 'y',
                    ykeys     : ['user', 'admin'],
                    labels    : ['用户', '管理后台'],
                    lineColors: ['#a0d0e0', '#3c8dbc'],
                    hideHover : 'auto'
                });
                new Morris.Area({
                    element   : 'login_year_chart',
                    resize    : true,
                    data      : c_year,
                    xkey      : 'y',
                    ykeys     : ['user', 'admin'],
                    labels    : ['用户', '管理后台'],
                    lineColors: ['#a0d0e0', '#3c8dbc'],
                    hideHover : 'auto'
                });
            }
        });

    </script>
@endsection
