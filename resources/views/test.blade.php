<html>
<body>
<div class="container">
    @foreach($notices as $notice)
        {{ $notice->notice_title }}
    @endforeach
</div>
{{ $notices->links() }}
</body>
</html>