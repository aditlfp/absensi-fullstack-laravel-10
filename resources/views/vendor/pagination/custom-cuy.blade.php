<nav class="flex flex-col items-center justify-center sm:justify-between">
    <div class="bg-emerald-500 px-2 py-1 overflow-hidden hidden sm:block mb-1 rounded">
        <div class="text-sm text-slate-600 font-semibold">
            {{ __('Showing') }} {{ $paginator->firstItem() }} {{ __('to') }} {{ $paginator->lastItem() }}
            {{ __('of') }} {{ $paginator->total() }} {{ __('results') }}
        </div>
    </div>
    <ul class="flex  join justify-between no-underline">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled join-item no-underline relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-white border border-gray-300 cursor-default leading-5 rounded-l-md" aria-disabled="true" aria-label="@lang('pagination.previous')">
                {{-- <span aria-hidden="true">@lang('pagination.previous')</span> --}}
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="link join-item no-underline relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 hover:bg-slate-200 bg-white border border-gray-300 cursor-default leading-5 rounded-l-md transition ease-in-out .2s">&laquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled join-item no-underline relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-white border border-gray-300 cursor-default leading-5 active:bg-slate-200" aria-disabled="true">
                    <span>{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active join-item bg-slate-200 no-underline relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500  border border-gray-300 cursor-default leading-5 " aria-current="page">
                            <span>{{ $page }}</span>
                        </li>
                    @else
                        @if ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1)
                            <li>
                                <a href="{{ $url }}" class="link join-item no-underline relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-white border border-gray-300 cursor-default leading-5 hover:text-slate-500 hover:bg-slate-200 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out .2s">{{ $page }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="link join-item  no-underline relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-white border border-gray-300 cursor-default leading-5 rounded-r-md hover:text-slate-500 hover:bg-slate-200 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out .2s">&raquo;</a>
            </li>
        @else
            <li class="disabled join-item no-underline relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-white border border-gray-300 cursor-default leading-5 rounded-r-md" aria-disabled="true" aria-label="@lang('pagination.next')">
                {{-- <span aria-hidden="true">@lang('pagination.next')</span> --}}
            </li>
        @endif
    </ul>

    
</nav>
