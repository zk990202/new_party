
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">学生状态查看</h3>
                </div>
                <div class="box-body">
                    <form method="GET" action="{{ url('admin/student-info/status-watch') }}">
                        <div class="form-group">
                            <label for="sno" >学号</label>
                            <input type="text" name="sno" class="form-control">
                        </div>

                        {{--<div class="form-group">--}}
                        {{--<--}}
                        {{--</div>--}}

                        <div class="box-footer">
                            <button id="submitButton" type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div>


                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
    </div>
    <!-- Main row -->
</section>

<script>

    $(function () {
        $('#example1').DataTable({
            "ordering" : false
        });
    });
</script>

