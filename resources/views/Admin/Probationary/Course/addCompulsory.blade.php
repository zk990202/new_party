
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" enctype="multipart/form-data">

                        <div class="box-header with-border">
                            <h3 class="box-title">添加必修课</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group" >
                                <label for="name">课程名称</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group" >
                                <label for="trainName">所属期数</label>
                                <select id="trainId" class="form-control">
                                    @foreach($trains as $train)
                                        <option value="{{ $train['id'] }}">{{ $train['name'] }}</option>
                                    @endforeach
                                </select>
                                {{--<input type="text" class="form-control" id="trainName" value="{{ $course['trainName'] }}">--}}
                            </div>
                            <div class="form-group" >
                                <label for="time">开课时间</label>
                                <input type="text" class="form-control" id="time" placeholder="请按照Y-m-d H:i:s格式输入">
                            </div>
                            <div class="form-group" >
                                <label for="place">课程地点</label>
                                <input type="text" class="form-control" id="place">
                            </div>
                            <div class="form-group" >
                                <label for="speaker">主讲老师</label>
                                <input type="text" class="form-control" id="speaker">
                            </div>
                            <div class="form-group" >
                                <label for="limitNum">人数上限</label>
                                <input type="text" class="form-control" id="limitNum">
                            </div>
                            <div class="form-group">
                                <label for="introduction">课程介绍</label>
                                <textarea id="introduction" name="editor" rows="10" cols="80">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="requirement">课程要求</label>
                                <textarea id="requirement" name="editor" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        {{--<input type="hidden" id="trainId" value="{{ $course['trainId'] }}">--}}
                        {{--<input type="hidden" id="id" value="{{ $course['id'] }}">--}}
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
            $('#introduction').trumbowyg({
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
                        usage : 'probationaryImg'
                    }
                },
                autogrow: true,
                removeformatPasted: true
            });

            $('#requirement').trumbowyg({
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
                        usage : 'probationaryImg'
                    }
                },
                autogrow: true,
                removeformatPasted: true
            });

//            $.ajax({
//                url : '/admin/probationary/course/'+$('#id').val(),
//                type: 'GET',
//                dataType: 'json',
//                success: function(data){
//                    if(data.success){
//                        var introduction = data.info.introduction;
//                        $('#introduction').trumbowyg('html', introduction);
//                        var requirement = data.info.requirement;
//                        $('#requirement').trumbowyg('html', requirement);
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
                var form = new FormData();
                form.append('name', $('#name').val());
                form.append('trainId', $('#trainId').val());
                form.append('time', $('#time').val());
                form.append('place', $('#place').val());
                form.append('speaker', $('#speaker').val());
                form.append('limitNum', $('#limitNum').val());
                form.append('introduction', $('#introduction').val());
                form.append('requirement', $('#requirement').val());
                $.ajax({
                    url: '/admin/probationary/course/add/compulsory',
                    type: 'POST',
                    data: form,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data.success){
                            alert('添加成功');
                            window.location.href = '/admin/probationary/course/list';
                        }
                        else{
                            alert(data.message);
                        }
                    },
                    error: function(){
                        alert(data.statusText);
                    }
                });
            });
        })
    </script>
