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
                            <h3 class="box-title">补选课</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group" >
                                <label for="trainName">培训期数</label>
                                <input type="text" class="form-control" value="{{ $train[0]['name'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="courseName">课程</label>
                                <select id="courseId" class="form-control">
                                    @foreach($courses as $course)
                                        <option value="{{ $course['id'] }}">{{ $course['name'] }}
                                            (@if($course['type'] == 0) 必修
                                            @else 选修
                                            @endif)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="examTime">补考学生学号</label>
                                <input type="text" class="form-control" id="sno">
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
                        usage : 'fileUsage'
                    }
                },
                autogrow: true,
                removeformatPasted: true
            });


            $('#submitButton').click(function(){
                var form = new FormData();
                form.append('courseId', $('#courseId').val());
                form.append('sno', $('#sno').val());
                $.ajax({
                    url: '/manager/probationary/choose-course/makeup',
                    type: 'POST',
                    data: form,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data.success){
                            alert('补选课成功');
                            window.location.href = '/manager/probationary/choose-course/makeup';
                        }
                        else{
                            alert(data.message);
                        }
                    }
                });
            });
        })
    </script>
@endsection
