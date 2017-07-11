@extends('layouts.app')

@section('main')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#partyBranchChart" data-toggle="tab">类型</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> 支部统计</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="partyBranchChart" style="position: relative;"></div>
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
            'url' : '/manager/statistics/partyBranch/3',
            'method' : 'get',
            'success' : function(data){
                console.log(data);
//                var c_res = [];
//                for(var i = 0; i < data.res_category.length; i ++){
//                    c_res[i] = {
//                        undergraduate : data.res_category[i].undergraduate,
//                        master: data.res_category[i].master,
//                        doctor: data.res_category[i].doctor,
//                        mix: data.res_category[i].mix
//                    }
//                }
               // console.log(c_res);
                new Morris.Donut({
                    element: 'partyBranchChart',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a","#FF69B4"],
                    data: [
                        {label: "本科生", value: data.res_category.undergraduate},
                        {label: "硕士生", value: data.res_category.master},
                        {label: "博士生", value: data.res_category.doctor},
                        {label: "混合党支部", value: data.res_category.mix}
                    ],
                    hideHover: 'auto'
                });
//                new Morris.Donut({
//                    element: 'partyBranchChart',
//                    resize: true,
//                    colors: ["#3c8dbc", "#f56954", "#00a65a","#FF69B4"],
//                    data: [
//                        {label: "本科生", value: 1},
//                        {label: "硕士生", value: 2},
//                        {label: "博士生", value: 3},
//                        {label: "混合党支部", value: 4}
//                    ],
//                    hideHover: 'auto'
//                });
//                new Morris.Bar({
//                    element: 'partyBranchChart',
//                    resize: true,
//                    data: c_res,
//                    barColors: ['#00a65a', '#f56954', '	#FF8C00'],
//                    xkey: 'grade',
//                    ykeys: ['undergraduate', 'master', 'doctor'],
//                    labels: ['本科生', '硕士生', '博士生'],
//                    hideHover: 'auto'
//                });

            }
        });

    </script>
@endsection