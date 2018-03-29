@if ($paginator->hasPages())
    <footer class="changePage">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="start" id="page-before"><</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="start" id="page-before"><</a>
        @endif
        <span id="navigator">
        {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="#">{{ $element }}</a>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="#" class="start">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            </span>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="start" id="page-next">></a>
        @else
            <a href="#" class="start" id="page-next">></a>
        @endif
    </footer>
@endif
