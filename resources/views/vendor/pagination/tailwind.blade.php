@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        
        {{-- Mobile View --}}
        <div class="flex gap-2 items-center justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed rounded-full">
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-blue-600 bg-white border border-slate-200 rounded-full hover:bg-blue-50 hover:text-blue-700 transition">
                    Sebelumnya
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-blue-600 bg-white border border-slate-200 rounded-full hover:bg-blue-50 hover:text-blue-700 transition">
                    Berikutnya
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed rounded-full">
                    Berikutnya
                </span>
            @endif
        </div>

        {{-- Desktop View --}}
        <div class="hidden sm:flex sm:flex-col sm:gap-4 md:flex-row md:items-center md:justify-between mt-2">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Menampilkan
                    @if ($paginator->firstItem())
                        <span class="font-bold text-slate-800">{{ $paginator->firstItem() }}</span>
                        sampai
                        <span class="font-bold text-slate-800">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    dari
                    <span class="font-bold text-slate-800">{{ $paginator->total() }}</span>
                    event
                </p>
            </div>

            <div>
                <span class="inline-flex gap-1 shadow-sm rounded-full bg-white p-1 border border-slate-200/60">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true">
                            <span class="inline-flex items-center justify-center w-9 h-9 text-slate-300 bg-transparent cursor-not-allowed rounded-full">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-9 h-9 text-slate-600 bg-transparent hover:bg-blue-50 hover:text-blue-600 rounded-full transition-colors">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-slate-400 bg-transparent cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="inline-flex items-center justify-center w-9 h-9 text-sm font-bold text-white bg-blue-600 rounded-full shadow-md shadow-blue-200">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-slate-600 bg-transparent hover:bg-blue-50 hover:text-blue-600 rounded-full transition-colors">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-9 h-9 text-slate-600 bg-transparent hover:bg-blue-50 hover:text-blue-600 rounded-full transition-colors">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    @else
                        <span aria-disabled="true">
                            <span class="inline-flex items-center justify-center w-9 h-9 text-slate-300 bg-transparent cursor-not-allowed rounded-full">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif





