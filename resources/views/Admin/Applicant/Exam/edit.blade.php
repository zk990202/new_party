
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
                            <label for="examTitle">考试期数</label>
                            <input type="text" class="form-control" id="examTitle" value="{{ $exam['name'] }}">
                        </div>
                        <div class="form-group">
                            <label for="examTime">考试时间</label>
                            <input type="datetime" class="form-control" id="examTime" value="{{ $exam['time'] }}" placeholder="YYYY-MM-DD HH:MM:SS(请严格按照此格式输入)">
                        </div>
                        <div class="form-group">
                            <label for="examAttention">注意事项</label>
                            <textarea id="editor" name="editor" rows="10" cols="80">

                                </textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputFile">上传文件</label>
                            <input type="file" id="inputFile" name="file">
                            <p class="help-block">
                                @if($exam['fileName'])
                                    已有附件：{{ $exam['fileName'] }}，如不更改请勿重新添加
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" id="examId" value="{{ $exam['id'] }}">
                </form>
                <div class="box-footer">
                    <button id="submitButton" type="button" class="btn btn-primary">提交</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./row -->
</section>

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
                    usage : 'fileUsage'
                }
            },
            autogrow: true,
            removeformatPasted: true
        });

        $.ajax({
            url : '/admin/applicant/exam/'+$('#examId').val(),
            type: 'GET',
            dataType: 'json',
            success: function(data){
                if(data.success){
                    var attention = data.info.attention;
//                        alert(content);
                    $('#editor').trumbowyg('html', attention);
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
                data.append("usage", 'applicantFile');
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
                        var path = data.file;
                        var file_name = data.info.name;
                        var form = new FormData();
                        form.append('name', $('#examTitle').val());
                        form.append('time', $('#examTime').val());
                        form.append('attention', $('#editor').val());
                        form.append('filePath', path);
                        form.append('fileName', file_name);
                        $.ajax({
                            url: '/admin/applicant/exam/' + $('#examId').val() + '/edit',
                            type: 'POST',
                            data: form,
                            cache: false,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(data){
                                if(data.success){
                                    alert('修改成功');
                                    window.location.href = '/admin/applicant/exam/' + $('#examId').val() + '/edit';
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
                form.append('name', $('#examTitle').val());
                form.append('time', $('#examTime').val());
                form.append('attention', $('#editor').val());
                $.ajax({
                    url: '/admin/applicant/exam/' + $('#examId').val() + '/edit',
                    type: 'POST',
                    data: form,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data.success){
                            alert('修改成功');
                            window.location.href = '/admin/applicant/exam/' + $('#examId').val() + '/edit';
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

