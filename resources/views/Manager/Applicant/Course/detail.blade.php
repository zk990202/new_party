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
                                        <a href="{{ url('manager/applicant/article/'.$article['id'].'/edit') }}">{{ $article['articleName'] }}</a>
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
                                        <a href="{{ url('manager/applicant/exercise/'.$exercise['id'].'/edit') }}">{!! $exercise['content'] !!}</a>
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
@endsection

{{--@section('func')--}}
                {{--<script src="/Trumbowyg/dist/trumbowyg.js"></script>--}}
    {{--<script src="/Trumbowyg/dist/plugins/upload/trumbowyg.upload.js"></script>--}}
    {{--<script>--}}
        {{--$(function(){--}}
            {{--// editor--}}
            {{--$('#editor').trumbowyg({--}}
                {{--btnsDef: {--}}
                    {{--// 设置上传的3种方法，远程上传，本地上传，图片64位加密--}}
                    {{--image: {--}}
                        {{--dropdown: ['insertImage', 'upload'],--}}
                        {{--ico: 'insertImage'--}}
                    {{--}--}}
                {{--},--}}
                {{--btns: [--}}
                    {{--['viewHTML'],--}}
                    {{--['formatting'],--}}
                    {{--'btnGrp-design',--}}
                    {{--['superscript', 'subscript'],--}}
                    {{--'image',--}}
                    {{--'btnGrp-justify',--}}
                    {{--'btnGrp-lists',--}}
                    {{--['horizontalRule'],--}}
                    {{--['table'],--}}
                    {{--['foreColor', 'backColor'],--}}
                    {{--['removeformat'],--}}
                    {{--['fullscreen']--}}
                {{--],--}}
                {{--plugins: {--}}
                    {{--upload: {--}}
                        {{--serverPath: '/manager/file',--}}
                        {{--fileFieldName: 'upload',--}}
                        {{--usage : 'importantFilesImg'--}}
                    {{--}--}}
                {{--},--}}
                {{--autogrow: true--}}
            {{--});--}}

            {{--$.ajax({--}}
                {{--url : '/manager/applicant/course/'+$('#coursesId').val(),--}}
                {{--type: 'GET',--}}
                {{--dataType: 'json',--}}
                {{--success: function(data){--}}
                    {{--if(data.success){--}}
                        {{--var detail = data.info.detail;--}}
{{--//                        alert(content);--}}
                        {{--$('#editor').trumbowyg('html', detail);--}}
                    {{--}--}}
                    {{--else{--}}
                        {{--alert(data.message);--}}
                    {{--}--}}
                {{--},--}}
                {{--error: function(){--}}
                    {{--alert('网络不稳，请刷新页面重试');--}}
                {{--}--}}
            {{--});--}}

            {{--$('#submitButton').click(function(){--}}
                {{--var form = new FormData();--}}
                {{--form.append('courseName', $('#coursesName').val());--}}
                {{--form.append('detail', $('#editor').val());--}}
                {{--$.ajax({--}}
                    {{--url: '/manager/applicant/course/' + $('#coursesId').val() + '/edit',--}}
                    {{--type: 'POST',--}}
                    {{--data: form,--}}
                    {{--cache: false,--}}
                    {{--dataType: 'json',--}}
                    {{--processData: false,--}}
                    {{--contentType: false,--}}
                    {{--success: function(data){--}}
                        {{--if(data.success){--}}
                            {{--alert('修改成功');--}}
                            {{--window.location.href = '/manager/applicant/course';--}}
                        {{--}--}}
                        {{--else{--}}
                            {{--alert(data.message);--}}
                        {{--}--}}
                    {{--},--}}
                    {{--error: function(){--}}
                        {{--alert(data.statusText);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--})--}}
    {{--</script>--}}
{{--@endsection--}}
