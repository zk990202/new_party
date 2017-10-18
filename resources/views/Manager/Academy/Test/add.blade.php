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
                            <h3 class="box-title">院级分党校课程添加</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group" >
                                <label for="name">培训名称</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="trainName">所属总培训</label>
                                <input type="text" class="form-control" id="trainName" value="{{ $train[0]['name'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="academyName">所属学院</label>
                                <select id="academyId" class="form-control">
                                    @foreach($colleges as $college)
                                        <option value="{{ $college['id'] }}">{{ $college['collegename'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="time">开始时间</label>
                                <input type="datetime" class="form-control" id="time">
                            </div>
                            <div class="form-group">
                                <label for="introduction">开课简介(必填,校级管理员需要知道你们的开课情况)</label>
                                <textarea id="introduction" name="editor" rows="10" cols="80">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="attention">注意事项</label>
                                <textarea id="attention" name="editor" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                        <input type="hidden" id="parent" value="{{ $train[0]['parent'] }}">
                        <input type="hidden" id="academyId" value="{{ $train[0]['academyId'] }}">
                        <input type="hidden" id="id" value="{{ $train[0]['id'] }}">
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
                        serverPath: '/manager/file',
                        fileFieldName: 'upload',
                        usage : 'importantFilesImg'
                    }
                },
                autogrow: true
            });
            $('#attention').trumbowyg({
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
                        usage : 'importantFilesImg'
                    }
                },
                autogrow: true
            });

//            $.ajax({
//                url : '/manager/academy/test-list/'+$('#id').val(),
//                type: 'GET',
//                dataType: 'json',
//                success: function(data){
//                    if(data.success){
//                        var introduction = data.info.introduction;
//                        var attention = data.info.attention;
//                        $('#introduction').trumbowyg('html', introduction);
//                        $('#attention').trumbowyg('html', attention);
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
                form.append('id', $('#id').val());
                form.append('name', $('#name').val());
                form.append('parent', $('#parent').val());
                form.append('academyId', $('#academyId').val());
                form.append('trainName', $('#trainName').val());
                form.append('time', $('#time').val());
                form.append('introduction', $('#introduction').val());
                form.append('attention', $('#attention').val());
                $.ajax({
                    url: '/manager/academy/test-list/add',
                    type: 'POST',
                    data: form,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data.success){
                            alert('添加成功');
                            window.location.href = '/manager/academy/test-list';
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
@endsection
