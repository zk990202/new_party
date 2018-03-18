
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" enctype="multipart/form-data">

                        <div class="box-header with-border">
                            <h3 class="box-title">证件补办详情</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <th>标题</th>
                                <td>{{ $certLost[0]['title'] }}</td>
                            </tr>
                            <tr>
                                <th>详情</th>
                                <td>{{ $certLost[0]['content'] }}</td>
                            </tr>
                            <tr>
                                <th>申请时间</th>
                                <td>{{ $certLost[0]['time'] }}</td>
                            </tr>
                            <tr>
                                <th>申请状态</th>
                                <td>
                                    @if($certLost[0]['dealStatus'] == 0)
                                        未处理
                                    @elseif($certLost[0]['dealStatus'] == 1)
                                        已通过补办
                                    @elseif($certLost[0]['dealStatus'] == 2)
                                        驳回补办
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>考试名称</th>
                                <td>{{ $certLost[0]['testName'] }}</td>
                            </tr>
                        </table>
                        <div class="box-body">
                            <label for="dealWord">无论是通过或者驳回补办,这里是填写给学生看的</label>
                            <div class="form-group">
                                <textarea id="editor" name="editor" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <input type="hidden" id="lostId" value="{{ $certLost[0]['lostId'] }}">
                        <input type="hidden" id="sno" value="{{ $certLost[0]['sno'] }}">
                        <input type="hidden" id="certType" value="{{ $certLost[0]['certType'] }}">
                        <input type="hidden" id="getPerson" value="{{ $certLost[0]['getPerson'] }}">
                        <input type="hidden" id="place" value="{{ $certLost[0]['place'] }}">
                    </form>
                    <div class="box-footer">
                        <button id="submitButtonPass" type="button"  class="btn btn-success">通过补办</button>
                        <button id="submitButtonReject" type="button" class="btn btn-danger">驳回补办</button>
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
                url : '/admin/probationary/certificate/last-grant/'+$('#lostId').val(),
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    if(data.success){
                        var dealWord = data.info.dealWord;
//                        alert(content);
                        $('#editor').trumbowyg('html', dealWord);
                    }
                    else{
                        alert(data.message);
                    }
                },
                error: function(){
                    alert('网络不稳，请刷新页面重试');
                }
            });
            $('#submitButtonPass').click(function () {
                if(confirm('是否确认通过补办？')){
                    var form = new FormData();
                    form.append('sno', $('#sno').val());
                    form.append('certType', $('#certType').val());
                    form.append('getPerson', $('#getPerson').val());
                    form.append('place', $('#place').val());
                    form.append('lostId', $('#lostId').val());
                    form.append('dealWord', $('#editor').val());
                    $.ajax({
                        url: '/admin/probationary/certificate/last-grant/' + $('#lostId').val() + '/detail',
                        type: 'POST',
                        data: form,
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(data.success){
                                alert('补办成功');
                                window.location.href = '/admin/probationary/certificate/last-grant';
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
            $('#submitButtonReject').click(function () {
                if(confirm('是否确认驳回补办？')){
                    var form = new FormData();
                    form.append('lostId', $('#lostId').val());
                    form.append('dealWord', $('#editor').val());
                    $.ajax({
                        url: '/admin/probationary/certificate/last-grant/' + $('#lostId').val() + '/reject',
                        type: 'POST',
                        data: form,
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            if (data.success) {
                                alert('驳回成功');
                                window.location.href = '/admin/probationary/certificate/last-grant';
                            }
                            else {
                                alert(data.message);
                            }
                        }
                    })
                }
            });

        });
    </script>

