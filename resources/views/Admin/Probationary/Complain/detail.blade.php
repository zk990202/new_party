
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" enctype="multipart/form-data">

                        <div class="box-header with-border">
                            <h3 class="box-title">申诉管理详情</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <th>学号</th>
                                <td>{{ $grade[0]['sno'] }}</td>
                            </tr>
                            <tr>
                                <th>姓名</th>
                                <td>{{ $grade[0]['studentName'] }}</td>
                            </tr>
                            <tr>
                                <th>学院</th>
                                <td>{{ $grade[0]['academyName'] }}</td>
                            </tr>
                            <tr>
                                <th>考试成绩</th>
                                <td>{{ $grade[0]['practiceGrade'] }}</td>
                            </tr>
                            <tr>
                                <th>论文成绩</th>
                                <td>{{ $grade[0]['articleGrade'] }}</td>
                            </tr>
                            <tr>
                                <th>考试状态</th>
                                <td>
                                    @if($grade[0]['status'] == 1)
                                        正常
                                    @elseif($grade[0]['status'] == 2)
                                        论文抄袭
                                    @elseif($grade[0]['status'] == 3)
                                        考场违纪
                                    @elseif($grade[0]['status'] == 4)
                                        缺考
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>申诉标题</th>
                                <td> {{ $complain[0]['title'] }}</td>
                            </tr>
                            <tr>
                                <th>所属类别</th>
                                <td>院级积极分子党校</td>
                            </tr>
                            <tr>
                                <th>时间</th>
                                <td>{{ $complain[0]['time'] }}</td>
                            </tr>
                            <tr>
                                <th>内容</th>
                                <td>{{ $complain[0]['content'] }}</td>
                            </tr>
                        </table>
                        <div class="box-body">
                            <label for="title">回复标题</label>
                            <input type="text" class="form-control" id="title">
                        </div>
                        <div class="box-body">
                            <label for="dealWord">回复内容</label>
                            <div class="form-group">
                                <textarea id="editor" name="editor" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <input type="hidden" id="id" value="{{ $complain[0]['id'] }}">
                        <input type="hidden" id="sno" value="{{ $complain[0]['fromSno'] }}">
                        <input type="hidden" id="type" value="{{ $complain[0]['type'] }}">
                    </form>
                    <div class="box-footer">
                        <button id="submitButton" type="button"  class="btn btn-success">提交</button>
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

//            $.ajax({
//                url : '/admin/probationary/complain/'+$('#id').val(),
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
                form.append('sno', $('#sno').val());
                form.append('id', $('#id').val());
                form.append('title', $('#title').val());
                form.append('content', $('#editor').val());
                form.append('type', $('#type').val());
                $.ajax({
                    url: '/admin/probationary/complain/' + $('#id').val() + '/detail',
                    type: 'POST',
                    data: form,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data.success){
                            alert('回复成功');
                            window.location.href = '/admin/probationary/complain';
                        }
                        else{
                            alert(data.message);
                        }
                    }
                });
            });

        });
    </script>

