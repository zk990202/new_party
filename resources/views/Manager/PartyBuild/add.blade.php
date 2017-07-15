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
                                <label for="newsesTitle">新闻标题</label>
                                <input type="text" class="form-control" id="newsesTitle" placeholder="新闻标题请尽量简明扼要，不要太长">
                            </div>
                            <div class="form-group">
                                <label for="column">所属栏目</label>
                                <select id="column" class="form-control">
                                    @foreach($columns as $column)
                                        <option value="{{ $column['id'] }}">{{ $column['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editor">新闻内容</label>
                                <textarea id="editor" name="editor" rows="10" cols="80">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">上传图片</label>
                                <input type="file" id="inputFile" name="file">

                                <p class="help-block">支持png jpeg jpg bmp </p>
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
                        usage : 'noticeImg'
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
                    data.append("usage", 'noticeImg');
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
                            form.append('column', $('#column').val());
                            form.append('imgPath', path);
                            $.ajax({
                                url: '/manager/party-build/add',
                                type: 'POST',
                                data: form,
                                cache: false,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data){
                                    if(data.success){
                                        alert('修改成功');
                                        window.location.href = '/manager/party-build/list/';
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
                    form.append('column', $('#column').val());
                    $.ajax({
                        url: '/manager/party-build/add',
                        type: 'POST',
                        data: form,
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(data.success){
                                alert('添加成功');
                                window.location.href = '/manager/party-build/list/';
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
