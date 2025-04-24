@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4">
        <ul class="flex items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="px-4 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Trước</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Trước
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="px-4 py-2 text-gray-500">{{ $element }}</li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-4 py-2 bg-blue-500 text-white rounded">{{ $page }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-blue-500 hover:text-white">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Tiếp
                    </a>
                </li>
            @else
                <li class="px-4 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Tiếp</li>
            @endif
        </ul>
    </nav>
@endif
