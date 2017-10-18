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
                            <h3 class="box-title">理论视频修改:若要修改,则请上传,否认,只需修改标题即可!视频不得超过60M,若太大,可以联系程序员帮忙上传!不可录入无效数据!</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group" >
                                <label for="videoTitle">视频标题</label>
                                <input type="text" class="form-control" id="videosTitle" placeholder="视频标题请尽量简明扼要，不要太长">
                            </div>
                            <div class="form-group">
                                <label for="type">所属栏目</label>
                                <select id="type" class="form-control">
                                    <option value="8">视频</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">上传视频</label>
                                <input type="file" id="inputFile" name="file">

                                <p class="help-block">支持
                                    mp4, avi, wmv, png, jpeg, gif, jpg, bmp, mov</p>
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
                        usage : 'theoryStudyVideo'
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
                    data.append("usage", 'theoryStudyVideo');
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
                            form.append('title', $('#videosTitle').val());
                            form.append('content', $('#editor').val());
                            form.append('type', $('#type').val());
                            form.append('filePath', path);
                            $.ajax({
                                url: '/manager/theory-study/add/video',
                                type: 'POST',
                                data: form,
                                cache: false,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data){
                                    if(data.success){
                                        alert('添加成功');
                                        window.location.href = '/manager/theory-study/list/';
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
                    form.append('title', $('#videosTitle').val());
                    form.append('content', $('#editor').val());
                    form.append('type', $('#type').val());
                    $.ajax({
                        url: '/manager/theory-study/add/video',
                        type: 'POST',
                        data: form,
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(data.success){
                                alert('添加成功');
                                window.location.href = '/manager/theory-study/list/';
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
