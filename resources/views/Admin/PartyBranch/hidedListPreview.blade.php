
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">查看已隐藏的支部</h3>
                </div>
                <form method="GET" action="{{ url('admin/party-branch/hided-list') }}">
                    <div class="form-group">
                        <label for="academyName">学院</label>
                        <select name="academyId" class="form-control">
                            <option value="">--(可选项)--</option>
                            @foreach($colleges as $college)
                                <option value="{{ $college['id'] }}">{{ $college['shortname'] }}</option>
                            @endforeach
                        </select>
                    </div>
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

