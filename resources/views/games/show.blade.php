@props(['game'])

<x-layout title="{{ $game->title }}">
    @if ($game->cover)
        <div class="game-cover" style="box-shadow: var(--shadow-sm); background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ Storage::url('games/covers/'.$game->cover) }});">
        </div>
    @endif
    <section class="section">
        <div class="container">
            
            <div class="with-sidebar">
                <div class="stack gap-gutter">
                    <div class="stack gap-md hide-lg-up" @style(['margin-top: -150px' => $game->cover])>
                        <img class="game-icon" src="{{ Storage::url('games/icons/'.$game->icon) }}" alt="{{ $game->title }}">
                        <h2>{{ $game->title }}</h2>
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
                    </div>

                    <h2 class="hide-md-down">{{ $game->title }}</h2>

                    {{-- MOBILE ONLY --}}
                    <div class="stack gap-xs hide-lg-up">
                        <details class="card">
                            <summary class="card__header">Information</summary>
                            <div class="card__body p-lg">
                                <x-games.info :$game />
                            </div>
                        </details>
                        <details class="card">
                            <summary class="card__header">Statistics</summary>
                            <div class="card__body p-lg">
                                <x-games.stats :$game />
                            </div>
                        </details>
                    </div>
                    {{-- END MOBILE ONLY --}}

                    <div class="stack gap-md">
                        <h3>Description</h3>
                        <div class="row gap-lg align-start">
                            <div class="card p-lg bg-fill stack gap-lg hide-md-down">
                                <div class="stack text-center" style="min-width: 75px">
                                    <div class="badge bg-accent">Score</div>
                                    <div class="weight-bold text-lg">
                                        {{ $game->score ? round($game->score) : '-' }}
                                    </div>
                                    <div class="text-xxs color-muted">
                                        {{ $game->ratings_count }} {{ Str::plural('rating', $game->ratings_count) }}
                                    </div>
                                </div>
                                <div class="stack text-center" style="min-width: 75px">
                                    <div class="badge bg-accent">Popularity</div>
                                    <div class="weight-bold text-lg">
                                        {{ $game->popularity_rank ? '#'.$game->popularity_rank : '-' }}
                                    </div>
                                    <div class="text-xxs color-muted">
                                        {{ $game->library_count ? $game->library_count : 0 }} {{ Str::plural('user', $game->library_count) }}
                                    </div>
                                </div>
                            </div>
                            <div class="stack gap-lg">
                                <div class="card p-lg bg-fill row grow gap-lg justify-center hide-lg-up">
                                    <div class="stack text-center" style="min-width: 75px">
                                        <div class="badge bg-accent">Score</div>
                                        <div class="weight-bold text-lg">
                                            {{ $game->score ? round($game->score) : '-' }}
                                        </div>
                                        <div class="text-xxs color-muted">
                                            {{ $game->ratings_count }} {{ Str::plural('rating', $game->ratings_count) }}
                                        </div>
                                    </div>
                                    <div class="stack text-center" style="min-width: 75px">
                                        <div class="badge bg-accent">Popularity</div>
                                        <div class="weight-bold text-lg">
                                            {{ $game->popularity_rank ? '#'.$game->popularity_rank : '-' }}
                                        </div>
                                        <div class="text-xxs color-muted">
                                            {{ $game->library_count ? $game->library_count : 0 }} {{ Str::plural('user', $game->library_count) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    {!! Str::markdown($game->description, [
                                        'html_input' => 'strip',
                                        'allow_unsafe_links' => false,
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stack gap-md">
                        @if ($game->series_count > 0 || $game->parents_count > 0 || $game->children_count > 0)
                            <h3>Relations</h3>

                            @if ($game->series_count > 0)
                                <div class="alert bg-fill">
                                    <span class="alert__icon">@icon('tabler-square-rounded-arrow-right')</span>
                                    <p>
                                        Series: 
                                        @foreach ($game->series as $series)
                                            <a href="{{ route('games.index', ['filter[series][]' => $series->name]) }}" class="weight-bold">{{ $series->name }}</a>@if (!$loop->last), @endif
                                        @endforeach
                                    </p>
                                </div>
                            @endif

                            @if ($game->parents_count > 0 || $game->children_count > 0)
                                <div class="grid gap-sm" style="--grid-min: 35ch;">
                                    @foreach ($game->parents as $parent)
                                        <div class="card row align-start align-stretch overlay-container overflow-hidden" style="max-height: 100px;">
                                            <div class="card__relation-icon" style="background-image: url('{{ Storage::url('games/icons/'.$parent->icon) }}')"></div>
                                            <div class="stack grow gap-xs p-sm">
                                                <div class="stack grow gap-xs">
                                                    <a href="{{ route('games.show', $parent->slug) }}" class="h6 has-overlay">{{ $parent->title }}</a>
                                                    <div class="row wrap gap-xxs">
                                                        <span class="badge">
                                                            @icon('tabler-calendar')
                                                            {{ $parent->initial_release_year }}
                                                        </span>
                                                        <span class="badge bg-warning-soft">
                                                            @icon('tabler-link')
                                                            {{ $parent->pivot->relationType->inverse_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach ($game->children as $child)
                                        <div class="card row align-start align-stretch overlay-container overflow-hidden" style="max-height: 100px;">
                                            <div class="card__relation-icon" style="background-image: url('{{ Storage::url('games/icons/'.$child->icon) }}')"></div>
                                            <div class="stack grow gap-xs p-sm">
                                                <div class="stack grow gap-xs">
                                                    <a href="{{ route('games.show', $child->slug) }}" class="h6 has-overlay">{{ $child->title }}</a>
                                                    <div class="row wrap gap-xxs">
                                                        <span class="badge">
                                                            @icon('tabler-calendar')
                                                            {{ $child->initial_release_year }}
                                                        </span>
                                                        <span class="badge bg-warning-soft">
                                                            @icon('tabler-link')
                                                            {{ $child->pivot->relationType->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="stack gap-md">
                        <div class="row justify-between">
                            <h3>Reviews</h3>
                            @if ($game->reviews_count > 0)
                                <div class="row gap-sm">
                                    <a class="btn btn--sm" href="{{ route('reviews.create', ['game' => $game->id]) }}">Create</a>
                                    @if ($game->reviews_count > 2)
                                        <a href="{{ route('reviews.index', ['filter[games][]' => $game->title]) }}" class="btn btn--sm">View More</a>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if ($game->reviews_count > 0)
                            <div class="grid gap-sm" style="--grid-min: 35ch;">
                                @foreach ($game->reviews as $review)
                                    <x-cards.review-mini :$review showUserAvatar="true" hideTitle="true" />
                                @endforeach
                            </div>
                        @else
                            <div class="placeholder">
                                @icon('tabler-note', ['class' => 'placeholder__icon'])
                                <p>Be the first to review <i>{{ $game->title }}</i>!</p>
                                <a class="btn" href="{{ route('reviews.create', ['game' => $game->id]) }}">Create</a>
                            </div>
                        @endif
                    </div>

                    <div class="stack gap-md">
                        <div class="row justify-between">
                            <h3>Recommendations</h3>
                            @if ($game->recommendations_count > 0)
                                <div class="row gap-sm">
                                    <a class="btn btn--sm" href="{{ route('recommendations.create', ['played' => $game->id]) }}">Create</a>
                                    @if ($game->recommendations_count > 2)
                                        <a href="{{ route('recommendations.index', ['filter[games][]' => $game->title]) }}" class="btn btn--sm">View More</a>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if ($game->recommendations_count > 0)
                            <div class="grid gap-sm" style="--grid-min: 35ch;">
                                @foreach ($game->recommendations as $recommendation)
                                    <x-cards.recommendation-mini :$recommendation />
                                @endforeach
                            </div>
                        @else
                            <div class="placeholder">
                                @icon('tabler-thumb-up', ['class' => 'placeholder__icon'])
                                <p>Be the first to make a recommendation!</p>
                                <a class="btn" href="{{ route('recommendations.create', ['played' => $game->id]) }}">Create</a>
                            </div>
                        @endif
                    </div>
                </div>

                <nav class="sidebar stack gap-gutter hide-md-down" @style(['margin-top: -150px' => $game->cover])>
                    <div class="stack gap-md">
                        <img class="game-icon" src="{{ Storage::url('games/icons/'.$game->icon) }}" alt="{{ $game->title }}">
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
                    </div>

                    <div class="stack gap-md hide-md-down">
                        <h3>Information</h3>
                        <div class="card p-lg">
                            <x-games.info :$game />
                        </div>
                    </div>

                    <div class="stack gap-md hide-md-down">
                        <h3>Statistics</h3>
                        <div class="card p-lg">
                            <x-games.stats :$game />
                        </div>
                    </div>
                </nav>
            </div>

        </div>
    </section>
</x-layout>