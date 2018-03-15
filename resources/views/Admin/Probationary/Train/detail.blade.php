@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/Trumbowyg/dist/ui/trumbowyg.min.css">
@endsection

@section('main')
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
                            <th>培训期数</th>
                            <td style="text-align:left;padding-left:10px;">{{ $train[0]['name'] }}</td>
                        </tr>
                        <tr>
                            <th>开始时间</th>
                            <td style="text-align:left;padding-left:10px;">{{ $train[0]['time'] }}</td>
                        </tr>
                        <tr>
                            <th>报名状态</th>
                            <td style="text-align:left;padding-left:10px;">
                                @if($train[0]['entryStatus'])
                                    开启
                                @else
                                    关闭
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>网上报名</th>
                            <td style="text-align:left;padding-left:10px;">
                                @if($train[0]['netChooseStatus'])
                                    开启
                                @else
                                    关闭
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>成绩查询</th>
                            <td style="text-align:left;padding-left:10px;">
                                @if($train[0]['gradeSearchStatus'])
                                    开启
                                @else
                                    关闭
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>结业名单查询</th>
                            <td style="text-align:left;padding-left:10px;">
                                @if($train[0]['endListShow'])
                                    开启
                                @else
                                    关闭
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>优秀学员名单查询</th>
                            <td style="text-align:left;padding-left:10px;">
                                @if($train[0]['goodMemberShow'])
                                    开启
                                @else
                                    关闭
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>是否结束</th>
                            <td style="text-align:left;padding-left:10px;">
                                @if($train[0]['isEnd'])
                                    未结束
                                @else
                                    已结束
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>课程介绍</th>
                            <td style="text-align:left;padding-left:10px;">
                                {!! $train[0]['detail'] !!}
                            </td>
                        </tr>
                        <tr>
                            <th>附件</th>
                            <td style="text-align:left;padding-left:10px;">
                                @if($train[0]['filePath'])
                                    <a href="{{ $train[0]['filePath'] }}">{{ $train[0]['fileName'] }}</a>
                                @else
                                    无附件
                                @endif
                            </td>
                        </tr>
                    </table>

                {{--<div class="box-body">--}}
                {{--<div class="form-group" >--}}
                {{--<label for="coursesName">课程名称</label>--}}
                {{--<label for="coursesName">{{$courses[0]['courseName']}}</label>--}}
                {{--</div>--}}
                {{--</div>--}}
                <!-- /.box-body -->
                    <input type="hidden" id="coursesId" value="{{ $train[0]['id'] }}">

                </div>
            </div>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
@endsection
