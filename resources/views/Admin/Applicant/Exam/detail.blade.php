
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {{--<form role="form" enctype="multipart/form-data">--}}

                        <div class="box-header with-border">
                            <h3 class="box-title">考试详情</h3>
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
                                <th>考试期数</th>
                                <td style="text-align:left;padding-left:10px;">{{ $exam[0]['name'] }}</td>
                            </tr>
                            <tr>
                                <th>考试时间</th>
                                <td style="text-align:left;padding-left:10px;">{{ $exam[0]['time'] }}</td>
                            </tr>
                            <tr>
                                <th>当前状态</th>
                                <td style="text-align:left;padding-left:10px;">
                                    @if($exam[0]['status'] == 0)
                                        未开启
                                    @elseif($exam[0]['status'] == 1)
                                        报名开始
                                    @elseif($exam[0]['status'] == 2)
                                        报名截至
                                    @elseif($exam[0]['status'] == 3)
                                        成绩录入
                                    @elseif($exam[0]['status'] == 4)
                                        录入结束
                                    @elseif($exam[0]['status'] == 5)
                                        考试结束
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>注意事项</th>
                                <td>{!! $exam[0]['attention'] !!}</td>
                            </tr>
                            <tr>
                                <th>附件</th>
                                <td>
                                    @if($exam[0]['fileName'])
                                        {{--<a href="{{ url('admin/applicant/exam/'.$exam[0]['id'].'/download') }}">{{ $exam[0]['fileName'] }}</a>--}}
                                        {{--{{$exam[0]['filePath']}}--}}
                                        <a target="_blank" href="{{ $exam[0]['filePath'] .'/download/'. $exam[0]['fileName'] }}">{{ $exam[0]['fileName'] }}</a>
                                    @else
                                        无附件
                                    @endif
                                </td>
                            </tr>
                        </table>

                </div>
            </div>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->



