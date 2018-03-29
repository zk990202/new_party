
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">添加支部成员</h3>
                </div>
                <div>
                    <h1>{{ $res }}</h1>
                </div>
                <div>
                    <h3>
                        <a href="{{ url('admin/party-branch/'.$branch[0]['id'].'/member-add') }}">返回添加支部成员页面</a>
                    </h3>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
    </div>
    <!-- Main row -->
</section>
