@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/Trumbowyg/dist/ui/trumbowyg.min.css">
@endsection

@section('main')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" enctype="multipart/form-data">

                        <div class="box-header with-border">
                            <h3 class="box-title">题目添加</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group">
                                <label for="courseName">所属课程</label>
                                <select id="courseId" class="form-control">
                                    @foreach($courses as $course)
                                        <option value="{{ $course['id'] }}">{{ $course['courseName'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">类型</label>
                                <select id="type" class="form-control">
                                    <option value="">--单选/多选--</option>
                                    <option value="0">单选</option>
                                    <option value="1">多选</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea id="editor" name="editor" rows="10" cols="80">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="optionA">选项A</label>
                                <input type="text" class="form-control" id="optionA">
                            </div>
                            <div class="form-group">
                                <label for="optionB">选项B</label>
                                <input type="text" class="form-control" id="optionB">
                            </div>
                            <div class="form-group">
                                <label for="optionC">选项C</label>
                                <input type="text" class="form-control" id="optionC">
                            </div>
                            <div class="form-group">
                                <label for="optionD">选项D</label>
                                <input type="text" class="form-control" id="optionD">
                            </div>
                            <div class="form-group">
                                <label for="optionE">选项E</label>
                                <input type="text" class="form-control" id="optionE">
                            </div>
                            <div class="form-group">
                                <label for="answer">答案</label>
                                {{--<input type="text" class="form-control" id="answerLetter" value="{{ $exercises['answerLetter'] }}" placeholder="请根据类型(单选/多选)录入相对应的答案，不可录入无效数据">--}}
                                <select id="answerNumber" class="form-control">
                                    <option value="">--请根据类型(单选/多选)录入相对应的答案，不可录入无效数据--</option>
                                    @foreach($answers as $answer)
                                        <option value="{{ $answer['answerNumber'] }}">{{ $answer['answerLetter'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- /.box-body -->
                        {{--<input type="hidden" id="exerciseId" value="{{ $exercises['id'] }}">--}}
                    </form>
                    <div class="box-footer">
                        <button id="submitButton" type="button" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
@endsection

@section('func')
    <script src="/Trumbowyg/dist/trumbowyg.js"></script>
    <script src="/Trumbowyg/dist/plugins/upload/trumbowyg.upload.js"></script>
    <script>
        $(function(){
            // editor
            $('#editor').trumbowyg({
                btnsDef: {
                    // 设置上传的3种方法，远程上传，本地上传，图片64位加密
                    image: {
                        dropdown: ['insertImage', 'upload'],
                        ico: 'insertImage'
                    }
                },
                btns: [
                    ['viewHTML'],
                    ['formatting'],
                    'btnGrp-design',
                    ['superscript', 'subscript'],
                    'image',
                    'btnGrp-justify',
                    'btnGrp-lists',
                    ['horizontalRule'],
                    ['table'],
                    ['foreColor', 'backColor'],
                    ['removeformat'],
                    ['fullscreen']
                ],
                plugins: {
                    upload: {
                        serverPath: '/manager/file',
                        fileFieldName: 'upload',
                        usage : 'importantFilesImg'
                    }
                },
                autogrow: true
            });

//            $.ajax({
//                url : '/manager/applicant/exercise/'+$('#exerciseId').val(),
//                type: 'GET',
//                dataType: 'json',
//                success: function(data){
//                    if(data.success){
//                        var content = data.info.content;
////                        alert(content);
//                        $('#editor').trumbowyg('html', content);
//                    }
//                    else{
//                        alert(data.message);
//                    }
//                },
//                error: function(){
//                    alert('网络不稳，请刷新页面重试');
//                }
//            });
            $('#submitButton').click(function () {
                var form = new FormData();
                form.append('courseId', $('#courseId').val());
                form.append('type', $('#type').val());
                form.append('content', $('#editor').val());
                form.append('optionA', $('#optionA').val());
                form.append('optionB', $('#optionB').val());
                form.append('optionC', $('#optionC').val());
                form.append('optionD', $('#optionD').val());
                form.append('optionE', $('#optionE').val());
                form.append('answerNumber', $('#answerNumber').val());
                $.ajax({
                    url: '/manager/applicant/exercise/' + $('#courseId').val() + '/add',
                    type: 'POST',
                    data: form,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data.success){
                            alert('添加成功');
                            window.location.href = '/manager/applicant/exercise';
                        }
                        else{
                            alert(data.message);
                        }
                    },
                    error: function(){
                        alert(data.statusText);
                    }
                });
            })

        })
    </script>
@endsection
