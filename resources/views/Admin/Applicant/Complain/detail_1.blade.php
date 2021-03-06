
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
                            <td>申请人党校</td>
                        </tr>
                        <tr>
                            <th>时间</th>
                            <td>{{ $complain[0]['time'] }}</td>
                        </tr>
                        <tr>
                            <th>内容</th>
                            <td>{!! $complain[0]['content'] !!}</td>
                        </tr>
                    </table>
                </form>
            </div>

            <div class="box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">回复详情</h3>
                </div>
                <table class="table table-striped table-bordered table-condensed">
                    <tr>
                        <th>回复标题</th>
                        <td>{{ $reply[0]['title'] }}</td>
                    </tr>
                    <tr>
                        <th>回复时间</th>
                        <td>{{ $reply[0]['time'] }}</td>
                    </tr>
                    <tr>
                        <th>回复内容</th>
                        <td>{!! $reply[0]['content'] !!}</td>
                    </tr>
                </table>
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
//                url : '/admin/applicant/complain/'+$('#id').val(),
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

    });
</script>

