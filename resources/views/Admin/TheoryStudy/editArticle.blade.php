
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
                            <label for="noticeTitle">文件标题</label>
                            <input type="text" class="form-control" id="contentsTitle" value="{{ $contents['title'] }}">
                        </div>
                        <div class="form-group">
                                <textarea id="editor" name="editor" rows="10" cols="80">

                                </textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputFile">上传文件</label>
                            <input type="file" id="inputFile" name="file">
                            <p class="help-block">
                                @if($contents['filePath'])
                                    已有文件：<a target="_blank" href="{{$contents['filePath'].'/download/'.$contents['title']}}">点击下载</a>，如不更改请勿重新添加<br/>
                                @endif
                                支持文件格式：
                                {{ \App\Http\Service\FileService::allowedFileExtension('importantFilesFile') }}
                            </p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" id="contentsId" value="{{ $contents['id'] }}">
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
                    serverPath: '/admin/file',
                    fileFieldName: 'upload',
                    usage : 'importantFilesImg'
                }
            },
            autogrow: true
        });

        $.ajax({
            url : '/admin/theory-study/'+$('#contentsId').val(),
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

        $('#submitButton').click(function(){
            var file = $('#inputFile')[0].files[0];
            if(file){
                console.log(file);
                var data = new FormData();
                data.append('upload', file);
                data.append("usage", 'importantFilesFile');
                $.ajax({
                    url: '/admin/file',
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
                        var path = data.info.path;
                        var file_name = data.info.name;
                        var form = new FormData();
                        form.append('title', $('#contentsTitle').val());
                        form.append('content', $('#editor').val());
                        form.append('filePath', path);
                        $.ajax({
                            url: '/admin/theory-study/edit/article/' + $('#contentsId').val(),
                            type: 'POST',
                            data: form,
                            cache: false,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(data){
                                if(data.success){
                                    alert('修改成功');
                                    window.location.href = '/admin/theory-study/list';
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
                form.append('title', $('#contentsTitle').val());
                form.append('content', $('#editor').val());
                $.ajax({
                    url: '/admin/theory-study/edit/article/' + $('#contentsId').val(),
                    type: 'POST',
                    data: form,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data.success){
                            alert('修改成功');
                            window.location.href = '/admin/theory-study/list';
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

