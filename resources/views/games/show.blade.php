<x-app-layout title="{{ $game->title }}">

    <div class="section container stack gap-gutter">
        <section class="with-sidebar">
            <nav class="sidebar">
                <div class="stack grow gap-gutter">
                    <div class="stack gap-md">
                        <img class="rounded game-icon" src="{{ Storage::url('games/icons/'.$game->icon) }}">
                        <h2 class="hide-lg-up">{{ $game->title }}</h2>
                        <div class="row gap-md">
                            @auth
                                <a href="{{ route('games.library', $game->slug) }}" class="btn bg-accent btn--narrow" data-turbo-frame="modal">
                                    {{ $user_library_count > 0 ? 'Edit' : 'Add to' }} Library
                                </a>
                            @endauth
                            @guest
                                <a href="{{ route('waterhole.login') }}" class="btn bg-accent btn--narrow">
                                    Add to Library
                                </a>
                            @endguest
                            <livewire:games.favourite :$game />
                        </div>

                        {{-- MOBILE ONLY --}}
                        <details class="card hide-lg-up">
                            <summary class="card__header">Info</summary>
                            <div class="card__body">
                                <div class="stack gap-xs hide-lg-up">
                                    <div>
                                        @foreach ($game->developers as $developer)
                                            <span class="badge bg-emphasis">
                                                {{ $developer->name }}
                                            </span>
                                        @endforeach
                                        <span class="badge">
                                            @icon('tabler-calendar-filled')
                                            {{ $game->initial_release_year }}
                                        </span>
                                        @foreach ($game->genres as $genre)
                                            <span class="badge">
                                                @icon('tabler-tag')
                                                {{ $genre->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <div>
                                        @foreach ($game->platforms as $platform)
                                            <span class="badge">
                                                {{ $platform->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </details>
                        <details class="card hide-lg-up" style="margin-bottom: var(--space-sm)">
                            <summary class="card__header">Stats</summary>
                            <div class="card__body stack gap-sm">
                                <div class="data-set-item">
                                    @icon('tabler-star')
                                    <span>
                                        <span class="data-set-item__key">Ranked {{ $game->score_rank ? '#'.$game->score_rank : '' }}</span>
                                        <span class="data-set-item__value">{{ $game->score ? 'Average user score of '.round($game->score).'%' : '-' }}</span>
                                    </span>
                                </div>
                                <div class="data-set-item">
                                    @icon('tabler-heart')
                                    <span>
                                        <span class="data-set-item__key">Popularity {{ $game->popularity_rank ? '#'.$game->popularity_rank : '' }}</span>
                                        <span class="data-set-item__value">{{ $game->library_count ? $game->library_count : 0 }} {{ Str::plural('user', $game->library_count) }}</span>
                                    </span>
                                </div>
                                <div class="data-set-item">
                                    @icon('tabler-note')
                                    <span>
                                        <span class="data-set-item__key">Reviews</span>
                                        <span class="data-set-item__value">{{ $game->reviews_count }} {{ Str::plural('review', $game->reviews_count) }} written</span>
                                    </span>
                                </div>
                                <div class="data-set-item">
                                    @icon('tabler-thumb-up')
                                    <span>
                                        <span class="data-set-item__key">Recommendations</span>
                                        <span class="data-set-item__value">{{ $game->recommendations_count }} {{ Str::plural('recommendation', $game->recommendations_count) }} written</span>
                                    </span>
                                </div>
                            </div>
                        </details>
                        {{-- END MOBILE ONLY --}}

                        {{-- DESKTOP ONLY --}}
                        <ui-menu class="card text-xs p-xs no-pointer hide-md-down">
                            <span class="menu-item" role="menuitem">
                                @icon('tabler-code')
                                <span>
                                    <span class="menu-item__title">Developers</span>
                                    <span class="menu-item__description">
                                        @if (count($game->developers) > 0)
                                            {{ $game->developers->pluck('name')->implode(', ') }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </span>
                            </span>
                            <span class="menu-item" role="menuitem">
                                @icon('tabler-calendar')
                                <span>
                                    <span class="menu-item__title">Initial Release Year</span>
                                    <span class="menu-item__description">{{ $game->initial_release_year }}</span>
                                </span>
                            </span>
                            <span class="menu-item" role="menuitem">
                                @icon('tabler-tag')
                                <span>
                                    <span class="menu-item__title">Genres</span>
                                    <span class="menu-item__description">
                                        @if (count($game->genres) > 0)
                                            {{ $game->genres->pluck('acronym')->implode(', ') }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </span>
                            </span>
                            <span class="menu-item" role="menuitem">
                            @icon('tabler-device-gamepad')
                            <span>
                                <span class="menu-item__title">Platforms</span>
                                <span class="menu-item__description">
                                    @if (count($game->platforms) > 0)
                                        {{ $game->platforms->pluck('acronym')->implode(', ') }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </span>
                            </span>
                        </ui-menu>
                        {{-- END DESKTOP ONLY --}}
                    </div>

                    {{-- DESKTOP ONLY --}}
                    <div class="stack gap-md hide-md-down">
                        <h3>Stats</h3>
                        <ui-menu class="card text-xs p-xs no-pointer">
                            <span class="menu-item" role="menuitem">
                                @icon('tabler-star')
                                <span>
                                    <span class="menu-item__title">Ranked {{ $game->score_rank ? '#'.$game->score_rank : '' }}</span>
                                    <span class="menu-item__description">{{ $game->score ? 'Average user score of '.round($game->score).'%' : '-' }}</span>
                                </span>
                            </span>
                            <span class="menu-item" role="menuitem">
                                @icon('tabler-heart')
                                <span>
                                    <span class="menu-item__title">Popularity {{ $game->popularity_rank ? '#'.$game->popularity_rank : '' }}</span>
                                    <span class="menu-item__description">{{ $game->library_count ? $game->library_count : 0 }} {{ Str::plural('user', $game->library_count) }}</span>
                                </span>
                            </span>
                            <span class="menu-item" role="menuitem">
                                @icon('tabler-note')
                                <span>
                                    <span class="menu-item__title">Reviews</span>
                                    <span class="menu-item__description">{{ $game->reviews_count }} {{ Str::plural('review', $game->reviews_count) }} written</span>
                                </span>
                            </span>
                            <span class="menu-item" role="menuitem">
                                @icon('tabler-thumb-up')
                                <span>
                                    <span class="menu-item__title">Recommendations</span>
                                    <span class="menu-item__description">{{ $game->recommendations_count }} {{ Str::plural('recommendation', $game->recommendations_count) }} written</span>
                                </span>
                            </span>
                        </ui-menu>
                    </div>
                    {{-- END DESKTOP ONLY --}}
                </div>
            </nav>
        
            <div class="stack gap-gutter">
                <div class="stack gap-md">
                    <h2 class="hide-md-down">{{ $game->title }}</h2>
                    <nav aria-label="game-tabs">
                        <div class="tabs" role="list">
                            <a href="{{ route('games.show', $game->slug) }}" @class(['tab', 'is-active' => Route::is('games.show')])>Overview</a>
                            <a href="{{ route('games.reviews', $game->slug) }}" @class(['tab', 'is-active' => Route::is('games.reviews')])>Reviews</a>
                            <a href="{{ route('games.recommendations', $game->slug) }}" @class(['tab', 'is-active' => Route::is('games.recommendations')])>Recommendations</a>
                            <a href="{{ route('games.releases', $game->slug) }}" @class(['tab', 'is-active' => Route::is('games.releases')])>Releases</a>
                        </div>
                    </nav>
                </div>

                @if (Route::is('games.show'))
                    <x-games.overview :$game />
                @elseif (Route::is('games.reviews'))
                    <livewire:games.reviews :$game />
                @elseif (Route::is('games.recommendations'))
                    <livewire:games.recommendations :$game />
                @elseif (Route::is('games.releases'))
                    <x-games.releases :$game />
                @endif
            </div>
        </section>
    </div>
    
</x-app-layout>