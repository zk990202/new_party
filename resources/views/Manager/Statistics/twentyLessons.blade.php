@extends('layouts.app')

@section('main')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#twentyLessons_week_chart" data-toggle="tab">过去一周</a></li>
                        <li ><a href="#twentyLessons_month_chart" data-toggle="tab">过去一月</a></li>
                        <li ><a href="#twentyLessons_year_chart" data-toggle="tab">过去一年</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> 20课统计</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="twentyLessons_week_chart" style="position: relative;"></div>
                        <div class="chart tab-pane" id="twentyLessons_month_chart" style="position: relative;"></div>
                        <div class="chart tab-pane" id="twentyLessons_year_chart" style="position: relative;"></div>
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
                'url' : '/manager/statistics/twenty-lessons',
                'method' : 'get',
                'success' : function(data){
                    console.log(data);
                    var c_week = [];
                    var c_month = [];
                    var c_year = [];
                    for(var i = 0; i < data.week.twenty_lessons.length; i ++){
                        c_week[i] = {
                            y: data.week.twenty_lessons[i].complete_time,
                            twenty_lessons : data.week.twenty_lessons[i].lessons_number
                        }
                    }
                    for(var i = 0; i < data.month.twenty_lessons.length; i ++){
                        c_month[i] = {
                            y: data.month.twenty_lessons[i].complete_time,
                            twenty_lessons : data.month.twenty_lessons[i].lessons_number
                        }
                    }
                    for(var i = 0; i < data.year.twenty_lessons.length; i ++){
                        c_year[i] = {
                            y: data.year.twenty_lessons[i].complete_time,
                            twenty_lessons : data.year.twenty_lessons[i].lessons_number
                        }
                    }

                    new Morris.Area({
                        element   : 'twentyLessons_week_chart',
                        resize    : true,
                        data      : c_week,
                        xkey      : 'y',
                        ykeys     : ['twenty_lessons'],
                        labels    : ['通过课数'],
                        lineColors: ['#a0d0e0'],
                        hideHover : 'auto'
                    });

                    new Morris.Area({
                        element   : 'twentyLessons_month_chart',
                        resize    : true,
                        data      : c_month,
                        xkey      : 'y',
                        ykeys     : ['twenty_lessons'],
                        labels    : ['通过课数'],
                        lineColors: ['#a0d0e0'],
                        hideHover : 'auto'
                    });
                    new Morris.Area({
                        element   : 'twentyLessons_year_chart',
                        resize    : true,
                        data      : c_year,
                        xkey      : 'y',
                        ykeys     : ['twenty_lessons'],
                        labels    : ['通过课数'],
                        lineColors: ['#a0d0e0'],
                        hideHover : 'auto'
                    });
                }
            });
        })

    </script>
@endsection