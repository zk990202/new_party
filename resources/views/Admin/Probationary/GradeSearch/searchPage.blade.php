
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">成绩查询</h3>
                    </div>
                    <form method="POST" action="{{ url('admin/probationary/grade-search') }}">
                        <div class="form-group">
                            <label for="trainName">培训期数</label>
                            <select name="trainId" class="form-control">
                                @foreach($trains as $train)
                                    <option value="{{ $train['id'] }}">{{ $train['name'] }}
                                        (@if($train['isEnd'] == 0) 已结束
                                        @else 进行中
                                        @endif)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="academyName">学院</label>
                            <select name="academyId" class="form-control">
                                @foreach($colleges as $college)
                                    <option value="{{ $college['id'] }}">{{ $college['shortname'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="entryIsAllPassed">培训状态</label>
                            <select name="entryIsAllPassed" class="form-control">
                                <option value="0">未通过</option>
                                <option value="1">通过</option>
                                <option value="" selected>全部</option>
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

