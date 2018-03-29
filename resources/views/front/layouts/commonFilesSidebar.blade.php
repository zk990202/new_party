<nav class="find">
    <div class="active">重要文件</div>
    <div class="btn">
        <p {{ isset($regulation) ? 'class=' . $regulation : '' }}><a href="{{ url('commonFiles/regulation') }}">规章制度</a></p>
        <p {{ isset($instrument) ? 'class=' . $instrument : '' }}><a href="{{ url('commonFiles/instrument') }}">常用文书</a></p>
        <p {{ isset($mustRead) ? 'class=' . $mustRead : '' }}><a href="{{ url('commonFiles/mustRead') }}">入党必读</a></p>
        <p {{ isset($manual) ? 'class=' . $manual : '' }}><a href="{{ url('commonFiles/manual') }}">系统手册</a></p>
    </div>
</nav>