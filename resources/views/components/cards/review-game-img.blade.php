@props(['review'])

<div class="card row align-start align-stretch overlay-container overflow-hidden">
    <div class="card__game-icon" style="background-image: url('{{ Storage::url('games/icons/'.$review->game->icon) }}')"></div>
    <div class="stack grow gap-sm p-sm justify-between">
        <a href="{{ route('reviews.show', $review->id) }}" class="h4 color-accent has-overlay">
            {{ $review->game->title }}
        </a>
        <p class="text-xs">
            {{ Str::limit($review->summary, 150, '...')  }}
        </p>
        <div class="row justify-between">
            <div class="row wrap gap-xxs justify-end">
                <span class="badge">
                    {{ $review->user->name }}
                </span>
                <span class="badge">
                    {{ $review->created_at->diffForHumans() }}
                </span>
            </div>
            <div class="row wrap gap-xxs justify-end">
                <span class="badge">
                    {{ $review->platform->acronym }}
                </span>
                <span class="badge bg-accent">
                    @icon('tabler-heart')
                    {{ $review->score }}%
                </span>
            </div>
        </div>
    </div>
</div>