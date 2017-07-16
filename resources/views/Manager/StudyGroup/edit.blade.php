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
                            <h3 class="box-title">Quick Example</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group" >
                                <label for="noticeTitle">新闻标题</label>
                                <input type="text" class="form-control" id="newsesTitle" value="{{ $newses['title'] }}">
                            </div>
                            <div class="form-group">
                                <textarea id="editor" name="editor" rows="10" cols="80">
                                    {!! htmlspecialchars($newses['content']) !!}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">上传图片</label>
                                <input type="file" id="inputFile" name="file">
                                <p class="help-block">
                                    @if($newses['imgPath'])
                                        已有图片：{{ $newses['imgPath'] }}，如不更改请勿重新添加
                                    @endif
                                    支持图片格式：png, jpeg, jpg, bmp
                                </p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <input type="hidden" id="newsesId" value="{{ $newses['id'] }}">
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
                        usage : 'partyBuildImg'
                    }
                },
                autogrow: true
            });

            $('#submitButton').click(function(){
                var file = $('#inputFile')[0].files[0];
                if(file){
                    console.log(file);
                    var data = new FormData();
                    data.append('upload', file);
                    data.append("usage", 'partyBuildImg');
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
                            form.append('title', $('#newsesTitle').val());
                            form.append('content', $('#editor').val());
                            form.append('imgPath', path);
                            $.ajax({
                                url: '/manager/study-group/' + $('#newsesId').val() + '/edit',
                                type: 'POST',
                                data: form,
                                cache: false,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data){
                                    if(data.success){
                                        alert('修改成功');
                                        window.location.href = '/manager/study-group/' + $('#newsesId').val() + '/edit';
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
                    form.append('title', $('#newsesTitle').val());
                    form.append('content', $('#editor').val());
                    $.ajax({
                        url: '/manager/study-group/' + $('#newsesId').val() + '/edit',
                        type: 'POST',
                        data: form,
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(data.success){
                                alert('修改成功');
                                window.location.href = '/manager/study-group/' + $('#newsesId').val() + '/edit';
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
