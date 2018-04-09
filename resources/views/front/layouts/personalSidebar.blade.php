<nav class="find" style="width: 150px">
    <div class="active">我的支部</div>
    <div class="btn">
        <p {{ isset($status) ? 'class=' . $status : '' }}><a href="{{ url('personal/status') }}">个人状态</a></p>
        <p {{ isset($partyBranch) ? 'class=' . $partyBranch : '' }}><a href="detial.html">支部详情</a></p>
        <p><a href="member-list.html">支部成员列表</a></p>
        <p><a href="#">我的学习小组</a></p>
        <p><a href="#">上传文献查看</a></p>
        <ul>
            <li><a href="PartyMembershipApplication.html">入党申请书</a></li>
            <li><a href="ThoughtReport.html">思想汇报</a></li>
            <li><a href="PartyVolunteer.html">入党志愿书</a></li>
            <li><a href="PersonalSummary.html">个人小结</a></li>
            <li><a href="CorrectionApplication.html">转正申请</a></li>
        </ul>
        <p><a href="MyNews.html">我的消息</a></p>
        <p><a href="#">我的申诉</a></p>
    </div>
</nav>