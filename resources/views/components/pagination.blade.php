@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="row justify-between hide-md-up">
            @if ($paginator->onFirstPage())
                <button class="btn" disabled>
                    {!! __('pagination.previous') !!}
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <button class="btn" disabled>
                    {!! __('pagination.next') !!}
                </button>
            @endif
        </div>

        <div class="row justify-between hide-md-down" style="padding: var(--space-sm) 0;">
            <div>
                <p class="text-sm">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="weight-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="weight-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="weight-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>
            <div>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <button class="btn btn--sm btn--narrow" aria-hidden="true" disabled>
                            @icon('tabler-chevron-left')
                        </button>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn--sm btn--narrow" rel="prev" aria-label="{{ __('pagination.previous') }}">
                        @icon('tabler-chevron-left')
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <button class="btn btn--sm btn--wide" aria-disabled="true">
                            {{ $element }}
                        </button>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button class="btn bg-accent btn--sm btn--wide" aria-current="page">
                                    {{ $page }}
                                </button>
                            @else
                                <a href="{{ $url }}" class="btn btn--sm btn--wide" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn--sm btn--narrow" rel="next" aria-label="{{ __('pagination.next') }}">
                        @icon('tabler-chevron-right')
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <button class="btn btn--sm btn--narrow" aria-hidden="true" disabled>
                            @icon('tabler-chevron-right')
                        </button>
                    </span>
                @endif
            </div>
        </div>

    </nav>
@endif
