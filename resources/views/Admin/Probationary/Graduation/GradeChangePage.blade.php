
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $train[0]['name'] }} 结业成绩调整</h3>
                    </div>
                    <form method="POST" action="{{ url('admin/probationary/graduation/change1') }}">
                        <div class="form-group">
                            <label for="courseName">学号</label>
                            <input type="text" class="form-control" name="sno">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-footer">
                            <button id="submitButton" type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>

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

