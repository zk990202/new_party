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
                            <h3 class="box-title">添加培训</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group" >
                                <label for="name">培训名称</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group" >
                                <label for="time">培训时间</label>
                                <input type="text" class="form-control" id="time" placeholder="请按照Y-m-d H:i:s格式输入">
                            </div>
                            <div class="form-group">
                                <textarea id="editor" name="editor" rows="10" cols="80">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">上传文件</label>
                                <input type="file" id="inputFile" name="file">
                                <p class="help-block">
                                    支持文件格式：zip, rar, tar, tar.gz, tar.bz, doc, docx
                                </p>
                            </div>
                        </div>
                        <!-- /.box-body -->
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
                        usage : 'probationaryImg'
                    }
                },
                autogrow: true,
                removeformatPasted: true
            });

//            $.ajax({
//                url : '/manager/probationary/train/'+$('#id').val(),
//                type: 'GET',
//                dataType: 'json',
//                success: function(data){
//                    if(data.success){
//                        var detail = data.info.detail;
//                        $('#editor').trumbowyg('html', detail);
//                    }
//                    else{
//                        alert(data.message);
//                    }
//                },
//                error: function(){
//                    alert('网络不稳，请刷新页面重试');
//                }
//            });

            $('#submitButton').click(function(){
                var file = $('#inputFile')[0].files[0];
                if(file){
                    console.log(file);
                    var data = new FormData();
                    data.append('upload', file);
                    data.append("usage", 'probationaryFile');
                    $.ajax({
                        url: '/manager/file',
                        type: 'POST',
                        data: data,
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        error: function (data) {
                            alert(data.statusText);
                        }
                    }).done(function(data){
                        if(data.success){
                            var path = data.file;
                            var file_name = data.info.name;
                            var form = new FormData();
                            form.append('name', $('#name').val());
                            form.append('time', $('#time').val());
                            form.append('detail', $('#editor').val());
                            form.append('filePath', path);
                            form.append('fileName', file_name);
                            $.ajax({
                                url: '/manager/probationary/train/add',
                                type: 'POST',
                                data: form,
                                cache: false,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data){
                                    if(data.success){
                                        alert('添加成功');
                                        window.location.href = '/manager/probationary/train/list';
                                    }
                                    else{
                                        alert(data.message);
                                    }
                                },
                                error: function(){
                                    alert(data.statusText);
                                }
                            });
                        }
                        else{
                            alert(data.message);
                        }
                    });
                }
                else{
                    var form = new FormData();
                    form.append('name', $('#name').val());
                    form.append('time', $('#time').val());
                    form.append('detail', $('#editor').val());
                    $.ajax({
                        url: '/manager/probationary/train/add',
                        type: 'POST',
                        data: form,
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(data.success){
                                alert('添加成功');
                                window.location.href = '/manager/probationary/train/list';
                            }
                            else{
                                alert(data.message);
                            }
                        },
                        error: function(){
                            alert(data.statusText);
                        }
                    });
                }
            });
        })
    </script>
@endsection
