
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" enctype="multipart/form-data">

                    <div class="box-header with-border">
                        <h3 class="box-title">补考报名</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="form-group" >
                            <label for="examTitle">考试期数</label>
                            <input type="text" class="form-control" id="examTitle" value="{{ $signs[0]['testName'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="examTime">补考学生学号</label>
                            <input type="text" class="form-control" id="sno">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" id="testId" value="{{ $test[0]['id'] }}">
                    <input type="hidden" id="id" value="{{ $signs[0]['id'] }}">
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
                    usage : 'fileUsage'
                }
            },
            autogrow: true,
            removeformatPasted: true
        });


        $('#submitButton').click(function(){
            var form = new FormData();
            form.append('id', $('#id').val());
            form.append('testId', $('#testId').val());
            form.append('testName', $('#examTitle').val());
            form.append('sno', $('#sno').val());
            $.ajax({
                url: '/admin/applicant/sign/makeup',
                type: 'POST',
                data: form,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.success){
                        alert('补考报名成功');
                        window.location.href = '/admin/applicant/sign/makeup';
                    }
                    else{
                        alert(data.message);
                    }
                }
            });
        });
    })
</script>

