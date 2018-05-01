
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="callout callout">
                    <h4>{{ $title }}</h4>

                    <p>{{ $message }}</p>

                    {{--<button type="button" class="btn btn-info">--}}
                        {{--<a href="{{ $href }}">返回</a>--}}
                    {{--</button>--}}
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

