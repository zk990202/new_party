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
                            <h3 class="box-title">文章修改</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group" >
                                <label for="articleName">文章名称</label>
                                <input type="text" class="form-control" id="articleName" value="{{ $articles['articleName'] }}">
                            </div>
                            <div class="form-group">
                                <label for="courseName">所属课程</label>
                                <select id="courseId" class="form-control">
                                        <option value="{{ $articles['courseId'] }} ">{{ $articles['courseName'] }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea id="editor" name="editor" rows="10" cols="80">
                                    
                                </textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <input type="hidden" id="articleId" value="{{ $articles['id'] }}">
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

            $.ajax({
                url : '/manager/applicant/article/'+$('#articleId').val(),
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    if(data.success){
                        var content = data.info.content;
//                        alert(content);
                        $('#editor').trumbowyg('html', content);
                    }
                    else{
                        alert(data.message);
                    }
                },
                error: function(){
                    alert('网络不稳，请刷新页面重试');
                }
            });
            $('#submitButton').click(function () {
                var form = new FormData();
                form.append('articleName', $('#articleName').val());
                form.append('courseId', $('#courseId').val());
                form.append('content', $('#editor').val());
                $.ajax({
                    url: '/manager/applicant/article/' + $('#articleId').val() + '/edit',
                    type: 'POST',
                    data: form,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data.success){
                            alert('修改成功');
                            window.location.href = '/manager/applicant/article';
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
