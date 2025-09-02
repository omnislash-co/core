@props(['game'])

<x-app-layout title="{{ $game->title }}">

    @if ($game->cover)
        <div class="game-cover" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ Storage::url('games/covers/'.$game->cover) }});">
        </div>
    @endif
    <div class="section container stack gap-gutter">
        <section class="with-sidebar">
            <nav class="sidebar" @style(['margin-top: -150px' => $game->cover])>
                <div class="stack grow gap-gutter">
                    <div class="stack gap-md">
                        <img class="game-icon" src="{{ Storage::url('games/icons/'.$game->icon) }}">
                        <h2 class="hide-lg-up">{{ $game->title }}</h2>
                        <div class="row gap-md">
                            @auth
                                <a href="{{ route('library.index', $game->slug) }}" data-turbo-frame="modal" class="btn bg-accent btn--narrow">
                                    {{ $game->hasUserPlayed() ? 'Edit' : 'Add to' }} Library
                                </a>
                                <x-games.favorite :$game />
                            @endauth
                            @guest
                                <a href="{{ route('waterhole.login') }}" class="btn bg-accent btn--narrow">
                                    Add to Library
                                </a>
                                <a href="{{ route('waterhole.login') }}" class="btn bg-danger btn--narrow">
                                    @icon('tabler-heart')    
                                </a>
                            @endguest
                        </div>

                        {{-- MOBILE ONLY --}}
                        <details class="card hide-lg-up">
                            <summary class="card__header">Info</summary>
                            <div class="card__body p-xs">
                                <x-games.info :$game />
                            </div>
                        </details>
                        <details class="card hide-lg-up" style="margin-bottom: var(--space-sm)">
                            <summary class="card__header">Statistics</summary>
                            <div class="card__body p-xs">
                                <x-games.stats :$game />
                            </div>
                        </details>
                        {{-- END MOBILE ONLY --}}

                        {{-- DESKTOP ONLY --}}
                        <div class="card hide-md-down">
                            <x-games.info :$game />
                        </div>
                        {{-- END DESKTOP ONLY --}}
                    </div>

                    {{-- DESKTOP ONLY --}}
                    <div class="stack gap-md hide-md-down">
                        <h3>Statistics</h3>
                        <div class="card">
                            <x-games.stats :$game />
                        </div>
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

                {{ $slot }}

            </div>
        </section>
    </div>
    
</x-app-layout>