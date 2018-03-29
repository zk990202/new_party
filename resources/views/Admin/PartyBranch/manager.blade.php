
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>支部编号</th>
                            <th>支部名称</th>
                            <th>支部类型</th>
                            <th>所属年级</th>
                            <th>创建时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $branch['id'] }}</td>
                            <td>{{ $branch['name'] }}</td>
                            <td>
                                @if($branch['type'] == 1)
                                    本科
                                @elseif($branch['type'] == 2)
                                    硕士
                                @elseif($branch['type'] == 3)
                                    博士
                                @elseif($branch['type'] == 4)
                                    混合
                                @else
                                    暂无
                                @endif
                            </td>
                            <td>
                                @if($branch['schoolYear'])
                                    {{ $branch['schoolYear'] }}
                                @else
                                    暂无
                                @endif
                            </td>
                            <td>{{ $branch['establishTime'] }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>

                <div class="box-body">
                    <table class="table table-striped table-bordered table-condensed">
                        <tr>
                            <th>支部总人数</th>
                            <td>{{ $allNum }}</td>
                        </tr>
                        <tr>
                            <th>正式党员</th>
                            <td>{{ $realNum }}</td>
                        </tr>
                        <tr>
                            <th>预备党员</th>
                            <td>{{ $readyNum }}</td>
                        </tr>
                        <tr>
                            <th>发展对象</th>
                            <td>{{ $developNum }}</td>
                        </tr>
                        <tr>
                            <th>积极分子+团推优</th>
                            <td>{{ $excellentAndAcademyNum }}</td>
                        </tr>
                        <tr>
                            <th>积极分子</th>
                            <td>{{ $academyNum }}</td>
                        </tr>
                        <tr>
                            <th>团推优</th>
                            <td>{{ $excellentNum }}</td>
                        </tr>
                        <tr>
                            <th>申请人+非申请人</th>
                            <td>{{ $applyNum }}</td>
                        </tr>
                        <tr>
                            <th>支部书记</th>
                            <td>
                                @if($branch['secretary'])
                                    {{ $branch['secretaryName'] }}
                                @else
                                    无
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>组织委员</th>
                            <td>
                                @if($branch['organizer'])
                                    {{ $branch['organizerName'] }}
                                @else
                                    无
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>宣传委员</th>
                            <td>
                                @if($branch['propagator'])
                                    {{ $branch['propagatorName'] }}
                                @else
                                    无
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>支部干部操作</th>
                            <td>
                                @if(!$branch['secretary'])
                                    <a href="{{ url('admin/party-branch/'.$branch['id'].'/add-cadre/1') }}">
                                        <button type="button" class="btn btn-success btn-xs">支部书记添加</button>
                                    </a>
                                @else
                                    <button type="button" class="btn btn-danger btn-xs" onclick="if(confirm('只是解除该委员的职务成为普通成员,是否继续?')) deleteSecretary({{ $branch['id'] }})">支部书记卸任</button>
                                @endif
                                @if(!$branch['organizer'])
                                    <a href="{{ url('admin/party-branch/'.$branch['id'].'/add-cadre/2') }}">
                                        <button type="button" class="btn btn-success btn-xs">组织委员添加</button>
                                    </a>
                                @else
                                    <button type="button" class="btn btn-danger btn-xs" onclick="if(confirm('只是解除该委员的职务成为普通成员,是否继续?')) deleteOrganizer({{ $branch['id'] }})">组织委员卸任</button>
                                @endif
                                @if(!$branch['propagator'])
                                    <a href="{{ url('admin/party-branch/'.$branch['id'].'/add-cadre/3') }}">
                                        <button type="button" class="btn btn-success btn-xs">宣传委员添加</button>
                                    </a>
                                @else
                                    <button type="button" class="btn btn-danger btn-xs" onclick="if(confirm('只是解除该委员的职务成为普通成员,是否继续?')) deletePropagator({{ $branch['id'] }})">宣传委员卸任</button>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>支部成员操作</th>
                            <td>
                                @if($branch['type'] == 4)
                                    <a href="{{ url('admin/party-branch/'.$branch['id'].'/member-add-mix-preview') }}">
                                        <button type="button" class="btn btn-success btn-xs">成员添加</button>
                                    </a>
                                @else
                                    <a href="{{ url('admin/party-branch/'.$branch['id'].'/member-add') }}">
                                        <button type="button" class="btn btn-success btn-xs">成员添加</button>
                                    </a>
                                @endif
                                <a href="{{ url('admin/party-branch/'.$branch['id'].'/member-delete') }}">
                                    <button type="button" class="btn btn-danger btn-xs">删除成员</button>
                                </a>
                                <a href="{{ url('admin/party-branch/'.$branch['id'].'/member-list') }}">
                                    <button type="button" class="btn btn-info btn-xs">成员列表</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>支部操作</th>
                            <td>
                                <a href="{{ url('admin/party-branch/'.$branch['id'].'/edit') }}">
                                    <button type="button" class="btn btn-success btn-xs">编辑党支部</button>
                                </a>
                                <button type="button" class="btn btn-danger btn-xs" onclick="if(confirm('删除该党支部时:要求所有的学生都已经与该支部解绑.删除后,支部列表中无法查看到该支部信息.真的确定要删除该党支部吗?')) deleteBranch({{ $branch['id'] }})">删除党支部</button>
                            </td>
                        </tr>
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

    var deleteSecretary = function (branchId) {
        $.ajax({
            url: '/admin/party-branch/' + branchId + '/delete-cadre/1',
            method: 'patch',
            data: 'form',
            dataType: 'json',
            success: function (data){
                if(data.success){
                    alert('删除成功');
                    window.location.reload();
                }else{
                    alert(data.message);
                }
            }
        })
    };

    var deleteOrganizer = function (branchId) {
        $.ajax({
            url: '/admin/party-branch/' + branchId + '/delete-cadre/2',
            method: 'patch',
            data: 'form',
            dataType: 'json',
            success: function (data){
                if(data.success){
                    alert('删除成功');
                    window.location.reload();
                }else{
                    alert(data.message);
                }
            }
        })
    };

    var deletePropagator = function (branchId) {
        $.ajax({
            url: '/admin/party-branch/' + branchId + '/delete-cadre/3',
            method: 'patch',
            data: 'form',
            dataType: 'json',
            success: function (data){
                if(data.success){
                    alert('删除成功');
                    window.location.reload();
                }else{
                    alert(data.message);
                }
            }
        })
    };

    var deleteBranch = function (branchId) {
        $.ajax({
            url: '/admin/party-branch/' + branchId + '/delete',
            method: 'post',
            data: 'form',
            dataType: 'json',
            success: function (data){
                if(data.success){
                    alert('删除成功');
                    window.location.href = '/admin/party-branch/list';
                }else{
                    alert(data.message);
                }
            }
        })
    }
</script>

