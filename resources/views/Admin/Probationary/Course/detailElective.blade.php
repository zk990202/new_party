
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">


                    <div class="box-header with-border">
                        <h3 class="box-title">课程详情</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <table class="table table-striped table-bordered table-condensed">
                        <style>
                            table th{
                                width: 100px;
                                height: 30px;
                            }
                        </style>
                        <tr>
                            <th>课程名称</th>
                            <td style="text-align:left;padding-left:10px;">{{ $course['name'] }}</td>
                        </tr>
                        <tr>
                            <th>课程类型</th>
                            <td style="text-align:left;padding-left:10px;">
                                @if($course['type'])
                                    选修
                                @else
                                    必修
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>所属期数</th>
                            <td style="text-align:left;padding-left:10px;">{{ $course['trainName'] }}</td>
                        </tr>
                        <tr>
                            <th>选择视频</th>
                            <td style="text-align:left;padding-left:10px;">{{ $course['movieName'] }}</td>
                        </tr>
                        <tr>
                            <th>课程介绍</th>
                            <td style="text-align:left;padding-left:10px;">{!! $course['introduction'] !!}</td>
                        </tr>
                        <tr>
                            <th>课程要求</th>
                            <td style="text-align:left;padding-left:10px;">{!! $course['requirement'] !!}</td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
