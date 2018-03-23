
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" enctype="multipart/form-data">

                    <div class="box-header with-border">
                        <h3 class="box-title">添加支部干部</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        @if($res != null)
                            <h4>{{ $res }}</h4>
                        @else
                            <div class="form-group" >
                                <label for="sno">添加{{ $cadre }}的学号</label>
                                <input type="text" class="form-control" id="sno">
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" id="branchId" value="{{ $branch['id'] }}">
                    <input type="hidden" id="type" value="{{ $type }}">
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
        $('#submitButton').click(function () {
            var form = new FormData();
            form.append('sno', $('#sno').val());
//                form.append('branchId', $('#branchId').val());
//                form.append('type', $('#type').val());
            $.ajax({
                url: '/admin/party-branch/' + $('#branchId').val() + '/add-cadre/' + $('#type').val(),
                type: 'POST',
                data: form,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.success){
                        alert('添加成功');
                        window.location.href = '/admin/party-branch/' + $('#branchId').val() + '/admin';
                    }
                    else{
                        alert(data.message);
                    }
                },
                error: function(){
                    alert(data.statusText);
                }
            });
        })

    })
</script>

