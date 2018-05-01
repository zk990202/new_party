
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">学生状态初始化</h3>
                </div>
                <div class="page-header">
                    <1>这里需要注意:可能您在其他页面勾选的人不会出现在这里:说明那些人已经进行过了初始化.每人只能进行一次初始化. <br>
                    <2>只有新生可以进行初始化操作,并且整个初始化的开放权在超管手中.会在相应的时间段开放初始化通道! <br>
                    <3>超管同样不能在本页面做初始化操作.如果有特殊情况,请在状态微调中对极少数学生进行状态修改操作!
                </div>
                <form method="GET" action="{{ url('admin/student-info/status-reset') }}">
                    <div class="form-group">
                        <label for="academyName">学院</label>
                        <select name="collegeId" class="form-control">
                            @foreach($colleges as $college)
                                <option value="{{ $college['code'] }}">{{ $college['collegename'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="schoolYear">年级</label>
                        <select name="schoolYear" class="form-control">
                            @if($grade)
                                <option value="{{ $grade }}">{{ $grade }}</option>
                            @else
                                <option value="">--(只限于新生)--</option>
                            @endif
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

