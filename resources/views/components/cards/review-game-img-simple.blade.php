@props(['review'])

<div class="card row p-md gap-md overlay-container">
    <div style="flex-basis: 64px;">
        <img class="rounded" src="{{ Storage::url('games/icons/'.$review->game->icon) }}" style="width: 64px"/>
    </div>
    <div class="stack grow gap-xs text-xs">
        <span class="h5 color-accent ">{{ $review->game->title }}</span>
        <p class="content">
            {{ Str::limit($review->summary, 60, '...')  }}
            <a href="{{ route('reviews.show', $review->id) }}" class="has-overlay no-underline">Read more</a>
        </p>
        <div class="row justify-between">
            <div class="row wrap gap-xxs">
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
                    @icon('tabler-star')
                    {{ $review->score }}%
                </span>
            </div>
        </div>
    </div>
</div>