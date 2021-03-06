
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
                <form method="POST" action="{{ url('admin/student-info/init') }}">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>专业</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($studentInfos as $studentInfo)
                            <tr>
                                <td>
                                    <input type="checkbox" name="sno[]" value="{{ $studentInfo['sno'] }}">{{ $studentInfo['sno'] }}
                                </td>
                                <td>{{ $studentInfo['studentName'] }}</td>
                                <td>{{ $studentInfo['academyName'] }}</td>
                                <td>{{ $studentInfo['majorName'] }}</td>
                                {{--<input type="hidden" name="entryId[]" value="{{ $studentInfo['id'] }}">--}}
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>学院</th>
                            <th>专业</th>
                        </tr>
                        </tfoot>
                    </table>

                    <div class="OwnInfo">
                        <h2>个人状态</h2>
                        <hr/>
                        <img class="flowChart" src="img3/flowChart.png" />
                        <div class="OwnFlow">
                            <div class="own1">
                                <div>
                                    <a href="#">递交入党申请书</a>
                                </div>
                                <img src="img3/finish.png">
                            </div>


                            <div class="own2">
                                <div class="finish">
                                    <div>
                                        <a href="">网上申请人党校学习</a>
                                    </div>
                                    <img src="img3/finish.png">
                                </div>
                                <div class="ready">
                                    <div>
                                        <a href="">通过结业考试</a>
                                    </div>
                                    <img src="img3/now.png">
                                </div>
                            </div>

                            <div class="own3">
                                <div class="finish">
                                    <div>
                                        <a href="">参加申请人学习小组</a>
                                    </div>
                                    <img src="img3/finish.png">
                                </div>

                                <div class="ready" id="special">
                                    <div>
                                        <a href="">团员推荐</a>
                                    </div>
                                    <img src="img3/now.png">
                                </div>
                                <div class="ready" id="Tspecial">
                                    <div>
                                        <a href="">团支部推优</a>
                                    </div>
                                    <img src="img3/now.png">
                                </div>
                            </div>


                            <div class="own2">
                                <div class="finish">
                                    <div>
                                        <a href="">递交第一季度思想汇报</a>
                                    </div>
                                    <img src="img3/finish.png">
                                </div>
                                <div class="finish">
                                    <div>
                                        <a>递交第二季度思想汇报</a>
                                    </div>
                                    <img src="img3/finish.png">
                                </div>
                                <div class="finish">
                                    <div>
                                        <a href="">递交第三季度思想汇报</a>
                                    </div>
                                    <img src="img3/finish.png">
                                </div>
                                <div class="ready">
                                    <div>
                                        <a href="">递交第四季度思想汇报</a>
                                    </div>
                                    <img src="img3/now.png">
                                </div>
                            </div>


                            <div class="own4">
                                <div class="finish">
                                    <div>
                                        <a href="#" >同意成为积极分子</a>
                                    </div>
                                    <img src="img3/finish.png">
                                </div>

                                <div class="ready" >
                                    <div>
                                        <a href="#">院级积极分子党校学习</a>
                                    </div>
                                    <img src="img3/now.png">
                                </div>
                            </div>


                            <div class="own5">
                                <div>
                                    <a href="">经支委会同意，准备近期发展，成为发展对象</a>
                                </div>
                                <div>
                                    <a href="">参加集中培训</a>
                                </div>
                                <div>
                                    <a href="">入党材料准备齐全</a>
                                </div>
                                <div>
                                    <a href="">支部向上级党组织汇报</a>
                                </div>
                                <div>
                                    <a href="">党员发展公示</a>
                                </div>
                                <div>
                                    <a href="">填写入党志愿书</a>
                                </div>
                                <div>
                                    <a href="">召开发展大会，党支部表决</a>
                                </div>
                                <div>
                                    <a href="">党委谈话，审批</a>
                                </div>
                                <div>
                                    <a href="">成为预备党员</a>
                                </div>
                            </div>

                            <div class="own6">
                                <div class="own7">
                                    <a href="">完成预备党员党校学习</a>
                                </div>


                                <div class="own8">
                                    <div>
                                        <a href="">递交第一季度个人小结</a>
                                    </div>
                                    <div>
                                        <a href="">递交第二季度个人小结</a>
                                    </div>
                                    <div>
                                        <a href="">递交第三季度个人小结</a>
                                    </div>
                                    <div>
                                        <a href="">递交第四季度个人小结</a>
                                    </div>
                                </div>


                                <div class="own9">
                                    <div>
                                        <a href="">按时参加党支部组织生活及党内活动</a>
                                    </div>
                                </div>
                            </div>

                            <div class="own5" id="OwnEnough">
                                <div>
                                    <a href="">递交转正申请</a>
                                </div>
                                <div>
                                    <a href="">党员转正公示</a>
                                </div>
                                <div>
                                    <a href="">党支部召开转正大会，表决通过</a>
                                </div>
                                <div>
                                    <a href="">党委审批</a>
                                </div>
                                <div>
                                    <a href="">成为中共正式党员</a>
                                </div>
                            </div>

                        </div>

                    <input type="text" name="status_applicant_book" value="1">
                    <input type="text" name="status_applicant_study" value="1">
                    <input type="text" name="status_applicant_exam_pass" value="1">

                    <input type="text" name="status_thought_report_1" value="1">
                    <input type="text" name="status_thought_report_2" value="1">
                    <input type="text" name="status_thought_report_3" value="1">
                    <input type="text" name="status_thought_report_4" value="1">

                    <input type="text" name="status_applicant_group" value="1">
                    <input type="text" name="status_party_member_recommendation" value="1">
                    <input type="text" name="status_mission_branch_recommendation" value="1">

                    <input type="text" name="status_become_academy" value="1">
                    <input type="text" name="status_academy_study" value="1">

                    <input type="text" name="status_development_target" value="1">
                    <input type="text" name="status_centralized_training" value="1">
                    <input type="text" name="status_material_is_ready" value="1">
                    <input type="text" name="status_report_to_superior" value="1">
                    <input type="text" name="status_development_publicity" value="1">
                    <input type="text" name="status_volunteer_book" value="1">
                    <input type="text" name="status_party_branch_voting" value="1">
                    <input type="text" name="status_committee_approval" value="1">
                    <input type="text" name="status_probationary_member" value="1">

                    <input type="text" name="status_probationary_exam_pass" value="1">

                    <input type="text" name="status_personal_report_1" value="1">
                    <input type="text" name="status_personal_report_2" value="1">
                    <input type="text" name="status_personal_report_3" value="1">
                    <input type="text" name="status_personal_report_4" value="1">

                    <input type="text" name="status_join_party_activity" value="1">

                    <input type="text" name="status_correct_applicant" value="1">
                    <input type="text" name="status_correct_publicity" value="1">
                    <input type="text" name="status_vote_passed" value="1">
                    <input type="text" name="status_party_approval" value="1">
                    <input type="text" name="status_formal_member" value="1">

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

