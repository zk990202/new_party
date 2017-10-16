@extends('layouts.app')

@section('main')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#partyBranchChart" data-toggle="tab">学院</a></li>
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
            'url' : '/manager/statistics/party-branch/1',
            'method' : 'get',
            'success' : function(data){
                console.log(data);
                var c_res = [];
                for(var i = 0; i < data.res_college.length; i ++){
                    c_res[i] = {
                        college: data.res_college[i].college,
                        undergraduate : data.res_college[i].undergraduate,
                        master: data.res_college[i].master,
                        doctor: data.res_college[i].doctor,
                        mix: data.res_college[i].mix
                    }
                }
                console.log(c_res);
                new Morris.Bar({
                    element: 'partyBranchChart',
                    resize: true,
                    data: c_res,
                    barColors: ['#00a65a', '#f56954', '	#FF8C00', '#00FFFF'],
                    xkey: 'college',
                    ykeys: ['undergraduate', 'master', 'doctor', 'mix'],
                    labels: ['本科生', '硕士生', '博士生', '混合党支部'],
                    hideHover: 'auto'
                });

            }
        });

    </script>
@endsection