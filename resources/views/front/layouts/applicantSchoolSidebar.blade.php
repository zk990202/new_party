<nav class="find">
    <div class="active">网上党校</div>
    <div class="btn">
        <p><a href="#">申请人培训</a></p>
        <ul>
            <li class="{{ isset($course) ? $course : '' }}"><a href="{{ url('applicant/courseStudy') }}">课程学习</a></li>
            <li><a href="{{ url('applicant/signUp') }}">我要报名</a></li>
            <li><a href="{{ url('applicant/signResult') }}">报名结果</a></li>
            <li><a href="{{ url('applicant/grade') }}">成绩查询</a></li>
            <li>证书查询</li>
            <li><a href="{{ url('applicant/status') }}">账号状态</a></li>
        </ul>
        <p  class="nav1"><a href="#">积极分子培训</a></p>
        <ul>
            <li><a href="{{ url('academy/courseStudy') }}">课程设置</a></li>
            <li><a href="{{ url('academy/signUp') }}">报名培训</a></li>
            <li><a href="{{ url('academy/signResult') }}">我的报名表</a></li>
            <li><a href="{{ url('academy/grade') }}">成绩查询</a></li>
            <li>证书查询</li>
        </ul>
        <p><a href="#">预备党员培训</a></p>
        <ul >
            <li><a href="{{ url('probationary/notice') }}">党校公告</a></li>
            <li><a href="{{ url('probationary/signUp') }}">报名培训</a></li>
            <li><a href="{{ url('probationary/signResult') }}">我的报名表</a></li>
            <li><a href="{{ url('probationary/studyList') }}"> 我的课表 </a></li>
            <li><a href="QueryResults.html">成绩查询</a></li>
            <li>证书查询</li>
        </ul>
    </div>
</nav>