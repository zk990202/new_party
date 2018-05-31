<nav class="find" style="width: 150px">
    <div class="active">我的支部</div>
    <div class="btn">
        <p {{ isset($status) ? 'class=' . $status : '' }}><a href="{{ url('personal/status') }}">个人状态</a></p>
        <p {{ isset($partyBranch) ? 'class=' . $partyBranch : '' }}><a href="{{ url('personal/partyBranch') }}">支部详情</a></p>
        <p><a href="{{ url('personal/members') }}">支部成员列表</a></p>
        <p><a href="#">我的学习小组</a></p>
        <p><a href="#">上传文献查看</a></p>
        <ul>
            <li><a href="{{ url('personal/fileWatch/1/1') }}">入党申请书</a></li>
            <li><a href="{{ url('personal/fileWatch/2/5') }}">思想汇报</a></li>
            <li><a href="{{ url('personal/fileWatch/6/9') }}">个人小结</a></li>
            <li><a href="{{ url('personal/fileWatch/10/10') }}">入党志愿书</a></li>
            <li><a href="{{ url('personal/fileWatch/11/11') }}">转正申请</a></li>
        </ul>
        <p><a href="MyNews.html">我的消息</a></p>
        <p><a href="#">我的申诉</a></p>
    </div>
</nav>