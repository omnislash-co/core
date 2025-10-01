<x-games.show :$game>

    <div class="content">
        <h3>Description</h3>
        <blockquote>
            {!! Str::markdown($game->description, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]) !!}
        </blockquote>
    </div>

    @if ($game->series_count > 0 || $game->parents_count > 0 || $game->children_count > 0)
        <div class="stack gap-md">
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
                            <div class="card__game-relation-icon" style="background-image: url('{{ Storage::url('games/icons/'.$parent->icon) }}')"></div>
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
                            <div class="card__game-relation-icon" style="background-image: url('{{ Storage::url('games/icons/'.$child->icon) }}')"></div>
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
        </div>
    @endif

    <div class="stack gap-md">
        <h3>Recent Reviews</h3>
        @if ($game->reviews_count > 0)
            <div class="grid gap-sm" style="--grid-min: 35ch;">
                @foreach ($game->reviews as $review)
                    <x-cards.review-user-img :$review />
                @endforeach
            </div>
        @else
            <div class="placeholder">
                @icon('tabler-note', ['class' => 'placeholder__icon'])
                <p>Be the first to review this game!</p>
                <a class="btn" href="{{ route('reviews.create') }}">Create a Review</a>
            </div>
        @endif
    </div>

    <div class="stack gap-md">
        <h3>Recent Recommendations</h3>
        @if ($game->recommendations_count > 0)
            <div class="grid gap-sm" style="--grid-min: 35ch;">
                @foreach ($game->recommendations as $recommendation)
                    <x-cards.recommendation-simple :$recommendation />
                @endforeach
            </div>
        @else
            <div class="placeholder">
                @icon('tabler-thumb-up', ['class' => 'placeholder__icon'])
                <p>Be the first to make a recommendation!</p>
                <a class="btn" href="{{ route('recommendations.create') }}">Create a Recommendation</a>
            </div>
        @endif
    </div>

</x-games.show>

