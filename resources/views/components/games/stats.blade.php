@props(['game'])

<div class="stack gap-sm text-xs">

    <div class="row gap-xs align-start">
        <div>@icon('tabler-star')</div>
        <div class="stack grow gap-xxs">
            <div class="row grow justify-between">
                <span class="weight-medium">Score</span>
                @if ($game->score_rank)
                    <span class="badge bg-fill">
                        #{{ $game->score_rank }}
                    </span>
                @endif
            </div>
            <div class="color-muted">
                @if ($game->score)
                    {{ round($game->score) }} ({{ $game->ratings_count }} {{ Str::plural('rating', $game->ratings_count) }})
                @else
                    No ratings
                @endif
            </div>
        </div>
    </div>

    <div class="row gap-xs align-start">
        <div>@icon('tabler-users-group')</div>
        <div class="stack grow gap-xxs">
            <div class="row grow justify-between">
                <span class="weight-medium">Popularity</span>
                @if ($game->popularity_rank)
                    <span class="badge bg-fill">
                        #{{ $game->popularity_rank }}
                    </span>
                @endif
            </div>
            <div class="color-muted">
                {{ $game->library_count ? $game->library_count : 0 }} {{ Str::plural('user', $game->library_count) }}
            </div>
        </div>
    </div>

    <div class="row gap-xs align-start">
        <div>@icon('tabler-heart')</div>
        <div class="stack gap-xxs">
            <div class="weight-medium">Favourites</div>
            <div class="color-muted">
                {{ $game->favoriters()->count() }} {{ Str::plural('user', $game->favoriters()->count()) }}
            </div>
        </div>
    </div>

    <div class="row gap-xs align-start">
        <div>@icon('tabler-note')</div>
        <div class="stack gap-xxs">
            <div class="weight-medium">Reviews</div>
            <div class="color-muted">{{ $game->reviews_count }} written</div>
        </div>
    </div>

    <div class="row gap-xs align-start">
        <div>@icon('tabler-note')</div>
        <div class="stack gap-xxs">
            <div class="weight-medium">Recommendations</div>
            <div class="color-muted">{{ $game->recommendations_count }} written</div>
        </div>
    </div>

</div>