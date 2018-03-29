
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->

                    <div class="box-header with-border">
                        <h3 class="box-title">支部修改:支部修改只能修改支部的名称,其他信息不允许修改!</h3>
                    </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>支部编号</th>
                                    <th>支部名称</th>
                                    <th>支部类型</th>
                                    <th>所属年级</th>
                                    <th>创建时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
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
                                    <td>
                                        @if($branch['isDeleted'])
                                            已删除
                                        @else
                                            正常
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/party-branch/'.$branch['id'].'/admin') }}">
                                            <button type="button" class="btn btn-success btn-xs">管理支部</button>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    <form role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="academy">所属学院</label>
                                <input type="text" class="form-control" id="academyName" value="{{ $branch['academyName'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="type">支部类型</label>
                                @if($branch['type'] == 1)
                                    <input type="text" class="form-control" value="本科生" readonly>
                                    <input type="hidden" id="type" value="1">
                                @elseif($branch['type'] == 2)
                                    <input type="text" class="form-control" value="硕士生" readonly>
                                    <input type="hidden" id="type" value="2">
                                @elseif($branch['type'] == 3)
                                    <input type="text" class="form-control" value="博士生" readonly>
                                    <input type="hidden" id="type" value="3">
                                @elseif($branch['type'] == 4)
                                    <input type="text" class="form-control" value="混合" readonly>
                                    <input type="hidden" id="type" value="4">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="schoolYear">所属年级</label>
                                <input type="text" class="form-control" id="schoolYear" value="{{ $branch['schoolYear'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="childName">子名称</label>
                                <input type="text" class="form-control" id="childName" placeholder="如：第一">
                            </div>
                            <div class="form-group">
                                <label for="name">总名称</label>
                                <input type="text" class="form-control" id="name" value="{{ $branch['name'] }}" readonly>
                            </div>
                        </div>
                        <input type="hidden" id="branchId" value="{{ $branch['id'] }}">
                    </form>
                    <div class="box-footer">
                        <button id="submitButton" type="button" class="btn btn-primary">提交</button>
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

        $('#submitButton').click(function(){
            var form = new FormData;
            form.append('academyName', $('#academyName').val());
            form.append('type', $('#type').val());
            form.append('schoolYear', $('#schoolYear').val());
            form.append('childName', $('#childName').val());
            form.append('name', $('#name').val());
            $.ajax({
                url: '/admin/party-branch/' + $('#branchId').val() + '/edit',
                type: 'post',
                data: form,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.success){
                        alert('修改成功');
                        window.location.href = '/admin/party-branch/' + $('#branchId').val() + '/edit';
                    }
                    else{
                        alert(data.message);
                    }
                },
                error: function(){
                    alert(data.statusText);
                }
            })
        });

    </script>

