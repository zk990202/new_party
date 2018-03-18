<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">


                <div class="box-header with-border">
                    <h3 class="box-title">培训详情</h3>
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
                        <th>培训名称</th>
                        <td style="text-align:left;padding-left:10px;">{{ $test[0]['name'] }}</td>
                    </tr>
                    <tr>
                        <th>所属学院</th>
                        <td style="text-align:left;padding-left:10px;">{{ $test[0]['academyName'] }}</td>
                    </tr>
                    <tr>
                        <th>所属期数</th>
                        <td style="text-align:left;padding-left:10px;">{{ $test[0]['trainName'] }}</td>
                    </tr>
                    <tr>
                        <th>开始时间</th>
                        <td style="text-align:left;padding-left:10px;">{{ $test[0]['time'] }}</td>
                    </tr>
                    <tr>
                        <th>当前状态</th>
                        <td style="text-align:left;padding-left:10px;">{{ $test[0]['status'] }}</td>
                    </tr>
                    <tr>
                        <th>开课简介</th>
                        <td style="text-align:left;padding-left:10px;">{!! $test[0]['introduction'] !!}</td>
                    </tr>
                    <tr>
                        <th>注意事项</th>
                        <td style="text-align:left;padding-left:10px;">{!! $test[0]['attention'] !!}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!-- ./row -->
</section>
<!-- /.content -->