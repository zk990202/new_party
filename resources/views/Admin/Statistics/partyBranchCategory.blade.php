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
        $(function () {
            $.ajax({
                'url' : '/manager/statistics/party-branch/3',
                'method' : 'get',
                'success' : function(data){
                    console.log(data);
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

                }
            });
        })

    </script>
@endsection