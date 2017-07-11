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
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                            <div class="form-group" >
                                <label for="noticeTitle">公告标题</label>
                                <input type="text" class="form-control" id="noticeTitle" value="{{ $notice['title'] }}">
                            </div>
                            <div class="form-group">
                                <textarea id="editor" name="editor" rows="10" cols="80">
                                    {{ $notice['content'] }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">上传文件</label>
                                <input type="file" id="inputFile" name="file">

                                <p class="help-block">已有文件</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <input type="hidden" name="noticeId" value="{{ $notice['id'] }}">
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
                        usage : 'noticeImg'
                    }
                },
                autogrow: true
            });

            $('#inputFile').on('change', function (e) {
                console.log(e);
                console.log(e.target);
                return;
                var file = e.target.files[0];
                var data = new FormData();
                data.append('upload', file);
                data.append("usage", 'noticeFile');
                $.ajax({
                    url: '/manager/file',
                    type: 'POST',
                    data: data,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if(data.success){

                        }else{

                        }

                    },

                    error: function () {

                    }
                });
            });

            var showMessage = function(success, message){

            };


            $('#submitButton').click(function(){

                var file = $('#inputFile')[0].files[0];

                if(file){

                }
                else{

                }


            });


        })
    </script>
@endsection
