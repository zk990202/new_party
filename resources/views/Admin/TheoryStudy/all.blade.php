
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">理论学习</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>文件类型</th>
                            <th>发布时间</th>
                            <th>备注</th>
                            <th>状态</th>
                            <th>操作</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contents as $content)
                            <tr>
                                <td>{{ $content['title'] }}</td>
                                <td>
                                    @if($content['type'] == 7)
                                        文章
                                    @elseif($content['type'] == 8)
                                        视频
                                    @elseif($content['type'] == 9)
                                        电子书
                                    @endif
                                </td>
                                <td>{{ $content['time'] }}</td>
                                <td>{!!   $content['filePath'] ? '<a target="_blank" href="' .  $content['filePath']   .'">有附件</a>' : '无附件' !!}</td>

                                <td>{{ $content['isHidden'] ? '隐藏' : '显示'}}</td>
                                <td>
                                    @if($content['isHidden'])
                                        <button type="button" class="btn btn-block btn-success btn-xs"  onclick="showContents({{ $content['id'] }});">显示</button>
                                    @else
                                        <button type="button" class="btn btn-block btn-danger btn-xs" onclick="hideContents({{ $content['id'] }});">隐藏</button>
                                    @endif
                                </td>
                                <td>
                                    @if($content['type'] == 7)
                                        <a href="{{ url('admin/theory-study/edit/article/'.$content['id']) }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">编辑</button></a>
                                    @elseif($content['type'] == 8)
                                        <a href="{{ url('admin/theory-study/edit/video/'.$content['id']) }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">编辑</button></a>
                                    @elseif($content['type'] == 9)
                                        <a href="{{ url('admin/theory-study/edit/eBook/'.$content['id']) }}">
                                            <button type="button" class="btn btn-block btn-info btn-xs">编辑</button></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>标题</th>
                            <th>文件类型</th>
                            <th>发布时间</th>
                            <th>备注</th>
                            <th>状态</th>
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
    var hideContents = function hideContents (contentsId) {
        $.ajax({
            'url': '/admin/theory-study/' + contentsId + '/hide',
            'method': 'patch',
            'success': function (data) {
                window.location.reload();
            }
        });
    };

    var showContents = function (contentsId) {
        $.ajax({
            'url': '/admin/theory-study/' + contentsId + '/hide',
            'method': 'patch',
            'success': function (data) {
                window.location.reload();
            }
        });
    };

</script>

