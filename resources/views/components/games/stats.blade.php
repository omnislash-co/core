@props(['game'])

<div class="data-set">
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