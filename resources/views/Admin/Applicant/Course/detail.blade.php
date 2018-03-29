
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
                        <td style="text-align:left;padding-left:10px;">{{ $courses[0]['courseName'] }}</td>
                    </tr>
                    <tr>
                        <th>更新时间</th>
                        <td style="text-align:left;padding-left:10px;">{{ $courses[0]['time'] }}</td>
                    </tr>
                    <tr>
                        <th>课程介绍</th>
                        <td style="text-align:left;padding-left:10px;">{!! $courses[0]['detail'] !!}</td>
                    </tr>
                    <tr>
                        <th> </th>
                        <td> </td>
                    </tr>
                    @foreach($articles as $i => $article)
                        <tr>
                            <th>文章{{$i+1}}</th>
                            <td style="text-align:left;padding-left:10px;">
                                <a href="{{ url('admin/applicant/article/'.$article['id'].'/edit') }}">{{ $article['articleName'] }}</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th> </th>
                        <td> </td>
                    </tr>
                    @foreach($exercises as $i => $exercise)
                        <tr>
                            <th>题目{{$i+1}}</th>
                            <td style="text-align:left;padding-left:10px;">
                                <a href="{{ url('admin/applicant/exercise/'.$exercise['id'].'/edit') }}">{!! $exercise['content'] !!}</a>
                            </td>
                        </tr>
                    @endforeach
                </table>

            {{--<div class="box-body">--}}
            {{--<div class="form-group" >--}}
            {{--<label for="coursesName">课程名称</label>--}}
            {{--<label for="coursesName">{{$courses[0]['courseName']}}</label>--}}
            {{--</div>--}}
            {{--</div>--}}
            <!-- /.box-body -->
                <input type="hidden" id="coursesId" value="{{ $courses[0]['id'] }}">


            </div>
        </div>
    </div>
    <!-- ./row -->
</section>
<!-- /.content -->
