
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">如需添加文章，请转至课程设置并选择相应的课程添加</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>文章标题</th>
                            <th>所属课程</th>
                            <th>状态</th>
                            <th>操作</th>
                            <th>操作</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article['articleName'] }}</td>
                                <td>{{ $article['courseName'] }}</td>
                                <td>{{ $article['isHidden'] ? '隐藏' : '显示'}}</td>
                                <td>
                                    @if($article['isHidden'])
                                        <button type="button" class="btn btn-block btn-success btn-xs"  onclick="showArticle({{ $article['id'] }});">显示</button>
                                    @else
                                        <button type="button" class="btn btn-block btn-danger btn-xs" onclick="hideArticle({{ $article['id'] }});">隐藏</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/applicant/article/'.$article['id']).'/edit' }}">
                                        <button type="button" class="btn btn-block btn-info btn-xs">编辑</button></a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-block btn-success btn-xs" onclick="if(confirm('确认要执行该项操作?此操作是不可恢复操作,是否继续?')) deleteArticle({{ $article['id'] }})">删除</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>文章标题</th>
                            <th>所属课程</th>
                            <th>状态</th>
                            <th>操作</th>
                            <th>操作</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
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
    var hideArticle = function hideArticle (articleId) {
        $.ajax({
            'url': '/admin/applicant/article/' + articleId + '/hide',
            'method': 'patch',
            'success': function (data) {
                window.location.reload();
            }
        });
    };

    var showArticle = function (articleId) {
        $.ajax({
            'url': '/admin/applicant/article/' + articleId + '/hide',
            'method': 'patch',
            'success': function (data) {
                window.location.reload();
            }
        });
    };

    var deleteArticle = function (articleId) {
        $.ajax({
            'url': '/admin/applicant/article/' + articleId + '/delete',
            'method': 'post',
            'success': function (data) {
                window.location.reload();
            }
        })
    }

</script>

