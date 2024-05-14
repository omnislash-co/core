<x-app-layout title="{{ $game->title }}">

    <div class="section container stack gap-gutter">
        <section class="with-sidebar">
            <nav class="sidebar">
                <div class="stack grow gap-gutter">
                    <div class="stack gap-md">
                        <img class="game-icon" src="{{ Storage::url('games/icons/'.$game->icon) }}">
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
                            <div class="card__body p-xs">
                                <x-games.info :$game />
                            </div>
                        </details>
                        <details class="card hide-lg-up" style="margin-bottom: var(--space-sm)">
                            <summary class="card__header">Stats</summary>
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
                        <h3>Stats</h3>
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