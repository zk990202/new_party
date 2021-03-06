<div class="header">
    <div class="system">
        <img  src="/img3/partyBuilding.png"/>
    </div>
    <nav>
        <ul>
            <li class="list">
                <a href="{{ url('/') }}" class="menu">首页</a>
            </li>
            <li class="list"><a href="#" class="menu">网上党校</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('applicant/courseStudy') }}">申请人培训</a></li>
                    <li><a href="{{ url('academy/courseStudy') }}">积极分子培训</a></li>
                    <li><a href="{{ url('probationary/notice') }}">预备党员培训</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">我的支部</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('personal/status') }}">个人状态</a></li>
                    <li><a href="{{ url('personal/partyBranch') }}">支部详情</a></li>
                    <li><a href="{{ url('personal/members') }}">支部成员列表</a></li>
                    <li><a href="{{ url('personal/groupMembers') }}">我的学习小组</a></li>
                    <li><a href="{{ url('personal/fileWatch/1/1') }}">上传文献查看</a></li>
                    <li><a href="{{ url('personal/myMessage/received') }}">我的消息</a></li>
                    <li><a href="{{ url('personal/myComplain') }}">我的申诉</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">通知公告</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('notification/applicant') }}">申请人培训</a></li>
                    <li><a href="{{ url('notification/academy') }}">院积极分子培训</a></li>
                    <li><a href="{{ url('notification/probationary') }}">预备党员培训</a></li>
                    <li><a href="{{ url('notification/secretary') }}">党支部书记培训</a></li>
                    <li><a href="{{ url('notification/activity') }}">活动通知</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">党建专项</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('partyBuildSpecial/hero') }}">身边的英雄</a></li>
                    <li><a href="{{ url('partyBuildSpecial/spirit') }}">中央精神</a></li>
                    <li><a href="{{ url('partyBuildSpecial/massLine') }}">群众路线</a></li>
                    <li><a href="{{ url('partyBuildSpecial/ChinaDream') }}">中国梦</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">党校培训</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('news/partySchool') }}">新闻中心</a></li>
                </ul>
            </li>
            <li class="list"><a href="#" class="menu">重要文件</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('commonFiles/regulation') }}">规章制度</a></li>
                    <li><a href="{{ url('commonFiles/instrument') }}">常用文书</a></li>
                    <li><a href="{{ url('commonFiles/mustRead') }}">入党必读</a></li>
                    <li><a href="{{ url('commonFiles/manual') }}">系统手册</a></li>
                </ul>
            </li>



            <li class="list"><a href="#" class="menu">支部分采</a>
                <ul class="sub-menu">
                    <li><a href="#">我的社区</a></li>
                    <li><a href="#">全部社区</a></li>
                    <li><a href="#">全部社区话题</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="land">
        <img src="/img3/land.png" class="landImg"/>
        <a href="">登录</a>
    </div>
</div>
<div class="respond">
    <div>
        <a href="#" class="enable">
            <img src="/img3/menu.png" />
        </a>
    </div>
    <div class="child-list">
        <p><a href="{{ url('/') }}">首页</a></p>
        <p><a href="#">网上党校</a></p>
        <ul>
            <li><a href="{{ url('applicant/courseStudy') }}">申请人培训</a></li>
            <li><a href="{{ url('academy/courseStudy') }}">积极分子培训</a></li>
            <li><a href="{{ url('probationary/notice') }}">预备党员培训</a></li>
        </ul>

        <p><a href="#">我的支部</a></p>
        <ul>
            <li><a href="{{ url('personal/status') }}">个人状态</a></li>
            <li><a href="{{ url('personal/partyBranch') }}">支部详情</a></li>
            <li><a href="{{ url('personal/members') }}">支部成员列表</a></li>
            <li><a href="{{ url('personal/groupMembers') }}">我的学习小组</a></li>
            <li><a href="{{ url('personal/fileWatch/1/1') }}">上传文献查看</a></li>
            <li><a href="{{ url('personal/myMessage/received') }}">我的消息</a></li>
            <li><a href="{{ url('personal/myComplain') }}">我的申诉</a></li>
        </ul>

        <p><a href="#">通知公告</a></p>
        <ul>
            <li><a href="{{ url('notification/applicant') }}">申请人培训</a></li>
            <li><a href="{{ url('notification/academy') }}">院积极分子培训</a></li>
            <li><a href="{{ url('notification/probationary') }}">预备党员培训</a></li>
            <li><a href="{{ url('notification/secretary') }}">党支部书记培训</a></li>
            <li><a href="{{ url('notification/activity') }}">活动通知</a></li>
        </ul>

        <p><a href="#">党建专项</a></p>
        <ul>
            <li><a href="{{ url('partyBuildSpecial/hero') }}">身边的英雄</a></li>
            <li><a href="{{ url('partyBuildSpecial/spirit') }}">中央精神</a></li>
            <li><a href="{{ url('partyBuildSpecial/massLine') }}">群众路线</a></li>
            <li><a href="{{ url('partyBuildSpecial/ChinaDream') }}">中国梦</a></li>
        </ul>

        <p><a href="#">党建培训</a></p>
        <ul>
            <li><a href="{{ url('news/partySchool') }}">新闻中心</a></li>
        </ul>

        <p><a href="#">重要文件</a></p>
        <ul>
            <li><a href="{{ url('commonFiles/regulation') }}">规章制度</a></li>
            <li><a href="{{ url('commonFiles/instrument') }}">常用文书</a></li>
            <li><a href="{{ url('commonFiles/mustRead') }}">入党必读</a></li>
            <li><a href="{{ url('commonFiles/manual') }}">系统手册</a></li>
        </ul>
        <p><a href="#">理论学习</a></p>
        <ul>
            <li><a href="{{ url('theoryStudy') }}">理论经典</a></li>
        </ul>

        <p><a href="#">支部分采</a></p>
        <ul>
            <li><a href="#">我的社区</a></li>
            <li><a href="#">全部社区</a></li>
            <li><a href="#">全部社区话题</a></li>
        </ul>
    </div>
</div>