
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">证书发放</h3>
                </div>
                <form method="POST" action="{{ url('admin/applicant/certificate/grant') }}">
                    <div class="form-group">
                        <label for="testName">考试期数</label>
                        <select name="testId" class="form-control">
                            @foreach($exams as $exam)
                                <option value="{{ $exam['id'] }}">{{ $exam['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="college">所在学院</label>
                        <select name="college" class="form-control">
                            @foreach($colleges as $college)
                                <option value="{{ $college['id'] }}">{{ $college['shortname'] }}</option>
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

