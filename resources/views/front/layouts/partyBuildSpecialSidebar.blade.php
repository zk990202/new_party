<nav class="find">
    <div class="active">党建专项</div>
    <div class="btn">
        <a href="{{ url('partyBuildSpecial/hero') }}"><p {{ isset($heroNews) ? 'class=' . $heroNews : '' }}>身边的英雄</p></a>
        <a href="{{ url('partyBuildSpecial/spirit') }}"><p {{ isset($spiritNews) ? 'class=' . $spiritNews : '' }}>中央精神</p></a>
        <a href="{{ url('partyBuildSpecial/massLine') }}"><p {{ isset($massLineNews) ? 'class=' . $massLineNews: '' }}>群众路线</p></a>
        <a href="{{ url('partyBuildSpecial/ChinaDream') }}"><p {{ isset($ChinaDreamNews) ? 'class=' . $ChinaDreamNews : '' }}></p>中国梦</a>
    </div>
</nav>