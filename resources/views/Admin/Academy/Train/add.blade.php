<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" enctype="multipart/form-data">

                    <div class="box-header with-border">
                        <h3 class="box-title">总培训期数添加</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="form-group" >
                            <label for="trainName">培训期数</label>
                            <input type="text" class="form-control" id="name" >
                        </div>
                        <div class="form-group">
                            <label for="time">开始时间</label>
                            <input type="datetime" class="form-control" id="time" placeholder="YYYY-MM-DD HH:MM:SS(请严格按照此格式输入)">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    {{--<input type="hidden" id="articleId" value="{{ $articles['id'] }}">--}}
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
        $('#submitButton').click(function () {
            var form = new FormData();
            form.append('name', $('#name').val());
            form.append('time', $('#time').val());
            $.ajax({
                url: '/admin/academy/train-list/add',
                type: 'POST',
                data: form,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.success){
                        alert('添加成功');
                        window.location.href = '/admin/academy/train-list';
                    }
                    else{
                        alert(data.message);
                    }
                }
            });
        })

    })
</script>