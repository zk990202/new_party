<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">证书详情</h3>
                </div>
                <form method="POST" action="{{ url('admin/academy/certificate/list') }}">
                    <div class="form-group">
                        <label for="testName">考试期数</label>
                        <select name="testId" class="form-control">
                            @foreach($tests as $test)
                                <option value="{{ $test['id'] }}">{{ $test['name'] }}</option>
                            @endforeach
                        </select>
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