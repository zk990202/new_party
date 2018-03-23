
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">支部查询</h3>
                </div>
                <form method="GET" action="{{ url('admin/party-branch/hide') }}">
                    <div class="form-group">
                        <label for="academyName">学院</label>
                        <select name="academyId" class="form-control">
                            <option value="">--(可选项)--</option>
                            @foreach($colleges as $college)
                                <option value="{{ $college['id'] }}">{{ $college['shortname'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="schoolYear">年级</label>
                        <select name="schoolYear" class="form-control">
                            <option value="">--(可选项)--</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade }}">{{ $grade }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">支部类型</label>
                        <select name="type" class="form-control">
                            <option value="">--(可选项)--</option>
                            <option value="1">本科生党支部</option>
                            <option value="2">硕士生党支部</option>
                            <option value="3">博士生党支部</option>
                            <option value="4">混合党支部</option>
                        </select>
                    </div>
                    <div class="box-footer">
                        <button id="submitButton" type="submit" class="btn btn-primary">提交</button>
                    </div>
                    <div class="bottom-left">
                        <a href="{{ url('admin/party-branch/hided-list-preview') }}">
                            <button type="button" class="btn btn-success">查看已隐藏的支部</button>
                        </a>
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