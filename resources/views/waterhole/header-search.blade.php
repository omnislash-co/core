@if (Route::is('waterhole.*'))
    {{-- <x-waterhole::HeaderSearch /> --}}
    <a
        href="{{ route('waterhole.search') }}"
        class="btn btn--icon btn--transparent header-search__button"
    >
        @icon('tabler-search')
        <ui-tooltip>{{ __('waterhole::forum.search-button') }}</ui-tooltip>
    </a>
@endif