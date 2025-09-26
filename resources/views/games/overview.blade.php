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

    @if ($game->series_count > 0)
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

