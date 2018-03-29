
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <form name="form" method="POST" action="{{ url('admin/party-branch/'.$branch['id'].'/member-delete') }}">
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

                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td colspan=6>
                                    <button type="button" class="btn btn-block">正式党员</button>
                                </td>
                            </tr>
                            <tr>
                                <th>选择</th>
                                <th>姓名</th>
                                <th>学号</th>
                                <th>学院</th>
                                <th>年级</th>
                                <th>职务</th>
                            </tr>
                            @foreach($real as $real_)
                                <tr>
                                    <td><input type="checkbox" name="sno[]" value="{{ $real_['sno'] }}"></td>
                                    <td>{{ $real_['studentName'] }}</td>
                                    <td>{{ $real_['sno'] }}</td>
                                    <td>{{ $real_['academyName'] }}</td>
                                    <td>{{ $branch['schoolYear'] }}</td>
                                    <td>--</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" align="center">共{{ $realNum }}人</td>
                            </tr>
                        </table>

                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td colspan=6>
                                    <button type="button" class="btn btn-block">预备党员--党委审批</button>
                                </td>
                            </tr>
                            <tr>
                                <th>选择</th>
                                <th>姓名</th>
                                <th>学号</th>
                                <th>学院</th>
                                <th>年级</th>
                                <th>职务</th>
                            </tr>
                            @foreach($ready as $ready_)
                                <tr>
                                    <td><input type="checkbox" name="sno[]" value="{{ $ready_['sno'] }}"></td>
                                    <td>{{ $ready_['studentName'] }}</td>
                                    <td>{{ $ready_['sno'] }}</td>
                                    <td>{{ $ready_['academyName'] }}</td>
                                    <td>{{ $branch['schoolYear'] }}</td>
                                    <td>--</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" align="center">共{{ $readyNum }}人</td>
                            </tr>
                        </table>

                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td colspan=6>
                                    <button type="button" class="btn btn-block">发展对象--谈话审批</button>
                                </td>
                            </tr>
                            <tr>
                                <th>选择</th>
                                <th>姓名</th>
                                <th>学号</th>
                                <th>学院</th>
                                <th>年级</th>
                                <th>职务</th>
                            </tr>
                            @foreach($develop as $develop_)
                                <tr>
                                    <td><input type="checkbox" name="sno[]" value="{{ $develop_['sno'] }}"></td>
                                    <td>{{ $develop_['studentName'] }}</td>
                                    <td>{{ $develop_['sno'] }}</td>
                                    <td>{{ $develop_['academyName'] }}</td>
                                    <td>{{ $branch['schoolYear'] }}</td>
                                    <td>--</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" align="center">共{{ $developNum }}人</td>
                            </tr>
                        </table>

                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td colspan=6>
                                    <button type="button" class="btn btn-block">积极分子</button>
                                </td>
                            </tr>
                            <tr>
                                <th>选择</th>
                                <th>姓名</th>
                                <th>学号</th>
                                <th>学院</th>
                                <th>年级</th>
                                <th>职务</th>
                            </tr>
                            @foreach($academy as $academy_)
                                <tr>
                                    <td><input type="checkbox" name="sno[]" value="{{ $academy_['sno'] }}"></td>
                                    <td>{{ $academy_['studentName'] }}</td>
                                    <td>{{ $academy_['sno'] }}</td>
                                    <td>{{ $academy_['academyName'] }}</td>
                                    <td>{{ $branch['schoolYear'] }}</td>
                                    <td>--</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" align="center">共{{ $academyNum }}人</td>
                            </tr>
                        </table>

                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td colspan=6>
                                    <button type="button" class="btn btn-block">团推优</button>
                                </td>
                            </tr>
                            <tr>
                                <th>选择</th>
                                <th>姓名</th>
                                <th>学号</th>
                                <th>学院</th>
                                <th>年级</th>
                                <th>职务</th>
                            </tr>
                            @foreach($excellent as $excellent_)
                                <tr>
                                    <td><input type="checkbox" name="sno[]" value="{{ $excellent_['sno'] }}"></td>
                                    <td>{{ $excellent_['studentName'] }}</td>
                                    <td>{{ $excellent_['sno'] }}</td>
                                    <td>{{ $excellent_['academyName'] }}</td>
                                    <td>{{ $branch['schoolYear'] }}</td>
                                    <td>--</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" align="center">共{{ $excellentNum }}人</td>
                            </tr>
                        </table>

                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td colspan=6>
                                    <button type="button" class="btn btn-block">团推优和积极分子</button>
                                </td>
                            </tr>
                            <tr>
                                <th>选择</th>
                                <th>姓名</th>
                                <th>学号</th>
                                <th>学院</th>
                                <th>年级</th>
                                <th>职务</th>
                            </tr>
                            @foreach($excellentAndAcademy as $excellentAndAcademy_)
                                <tr>
                                    <td><input type="checkbox" name="sno[]" value="{{ $excellentAndAcademy_['sno'] }}"></td>
                                    <td>{{ $excellentAndAcademy_['studentName'] }}</td>
                                    <td>{{ $excellentAndAcademy_['sno'] }}</td>
                                    <td>{{ $excellentAndAcademy_['academyName'] }}</td>
                                    <td>{{ $branch['schoolYear'] }}</td>
                                    <td>--</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" align="center">共{{ $excellentAndAcademyNum }}人</td>
                            </tr>
                        </table>

                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td colspan=6>
                                    <button type="button" class="btn btn-block">申请人--非申请人</button>
                                </td>
                            </tr>
                            <tr>
                                <th>选择</th>
                                <th>姓名</th>
                                <th>学号</th>
                                <th>学院</th>
                                <th>年级</th>
                                <th>职务</th>
                            </tr>
                            @foreach($apply as $apply_)
                                <tr>
                                    <td><input type="checkbox" name="sno[]" value="{{ $apply_['sno'] }}"></td>
                                    <td>{{ $apply_['studentName'] }}</td>
                                    <td>{{ $apply_['sno'] }}</td>
                                    <td>{{ $apply_['academyName'] }}</td>
                                    <td>{{ $branch['schoolYear'] }}</td>
                                    <td>--</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" align="center">共{{ $applyNum }}人</td>
                            </tr>
                        </table>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-footer">
                        <button type="submit" id="submitButton" class="btn btn-primary">提交</button>
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

    $('#submitButton').click(function(){
        if(window.confirm('被勾选的成员都将不会属于该支部了,确定要继续?')){
            return true;
        }//end of if
        else{
            return false;
        }
    });
</script>

