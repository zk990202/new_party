<nav class="find">
    <div class="active">通知公告</div>
    <div class="btn">
        <p {{ isset($applicant) ? 'class=' . $applicant : '' }}><a href="{{ url('notification/applicant') }}">申请人培训</a></p>
        <p {{ isset($academy) ? 'class=' . $academy : '' }}><a href="{{ url('notification/academy') }}">院积极分子培训</a></p>
        <p {{ isset($probationary) ? 'class=' . $probationary: '' }}><a href="{{ url('notification/probationary') }}">预备党员培训</a></p>
        <p {{ isset($secretary) ? 'class=' . $secretary : '' }}><a href="{{ url('notification/secretary') }}">党支部书记培训</a></p>
        <p {{ isset($activity) ? 'class=' . $activity : '' }}><a href="{{ url('notification/activity') }}">活动通知</a></p>
    </div>
</nav>