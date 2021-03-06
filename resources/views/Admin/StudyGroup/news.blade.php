
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">学习小组</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>发布时间</th>
                            <th>发布人</th>
                            <th>备注</th>
                            <th>状态</th>
                            <th>操作</th>
                            <th>操作</th>
                            <th>置顶</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($newses as $news)
                            <tr>
                                <td>{{ $news['title'] }}</td>
                                <td>{{ $news['time'] }}</td>
                                <td>{{ $news['authorName']}}</td>
                                <td>{!!   $news['imgPath'] ? '<a target="_blank" href="' .  $news['imgPath']  .'">有图片</a>' : '无图片' !!}</td>
                                <td>{{ $news['isHidden'] ? '隐藏' : '显示'}}</td>
                                <td>
                                    @if($news['isHidden'])
                                        <button type="button" class="btn btn-block btn-success btn-xs"  onclick="showNews({{ $news['id'] }});">显示</button>
                                    @else
                                        <button type="button" class="btn btn-block btn-danger btn-xs" onclick="hideNews({{ $news['id'] }});">隐藏</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/study-group/'.$news['id'].'/edit') }}">
                                        <button type="button" class="btn btn-block btn-info btn-xs">编辑</button></a>
                                </td>
                                <td>
                                    @if($news['isTop'])
                                        <button type="button" class="btn btn-block btn-warning btn-xs" onclick="downNews({{ $news['id'] }})">取消</button>
                                    @else
                                        <button type="button" class="btn btn-block btn-success btn-xs" onclick="topUpNews({{ $news['id'] }})">置顶</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>标题</th>
                            <th>发布时间</th>
                            <th>发布人</th>
                            <th>备注</th>
                            <th>状态</th>
                            <th>操作</th>
                            <th>操作</th>
                            <th>置顶</th>
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
    var hideNews = function hideNews (newsId) {
        $.ajax({
            'url': '/admin/study-group/' + newsId + '/hide',
            'method': 'patch',
            'success': function (data) {
                window.location.reload();
            }
        });
    };

    var showNews = function (newsId) {
        $.ajax({
            'url': '/admin/study-group/' + newsId + '/hide',
            'method': 'patch',
            'success': function (data) {
                window.location.reload();
            }
        });
    };

    var topUpNews = function (newsId) {
        $.ajax({
            'url': '/admin/study-group/' + newsId + '/top-up',
            'method': 'patch',
            'success': function (data) {
                window.location.reload();
            }
        });
    };

    var downNews = function (newsId) {
        $.ajax({
            'url': '/admin/study-group/' + newsId + '/top-up',
            'method': 'patch',
            'success': function (data) {
                window.location.reload();
            }
        });
    };
</script>
