
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#partyBranchChart" data-toggle="tab">年级</a></li>
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

    <script>
        $.ajax({
            'url' : '/admin/statistics/party-branch/2',
            'method' : 'get',
            'success' : function(data){
                console.log(data);
                var c_res = [];
                for(var i = 0; i < data.res_grade.length; i ++){
                    c_res[i] = {
                        grade: data.res_grade[i].grade,
                        undergraduate : data.res_grade[i].undergraduate,
                        master: data.res_grade[i].master,
                        doctor: data.res_grade[i].doctor
                    }
                }
                console.log(c_res);
                new Morris.Bar({
                    element: 'partyBranchChart',
                    resize: true,
                    data: c_res,
                    barColors: ['#00a65a', '#f56954', '	#FF8C00'],
                    xkey: 'grade',
                    ykeys: ['undergraduate', 'master', 'doctor'],
                    labels: ['本科生', '硕士生', '博士生'],
                    hideHover: 'auto'
                });

            }
        });

    </script>
