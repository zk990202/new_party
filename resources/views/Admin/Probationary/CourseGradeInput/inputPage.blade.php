
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $train[0]['name'] }} 课程成绩录入 (选择课程后进行对应的成绩录入)</h3>
                    </div>
                    <form method="POST" action="{{ url('admin/probationary/course-gradeInput/filter') }}">
                        <div class="form-group">
                            <label for="courseName">课程名称</label>
                            <select name="courseId" class="form-control">
                                @foreach($courses as $course)
                                    <option value="{{ $course['id'] }}">{{ $course['name'] }}
                                        (@if($course['type'] == 0) 必修
                                        @else 选修
                                        @endif)
                                    </option>
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

