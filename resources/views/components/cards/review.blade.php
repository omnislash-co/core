@props(['review', 'showUserAvatar' => false])

<div class="card rotate-img-on-hover row align-start align-stretch overlay-container" style="max-height: 155px;">
    @if ($showUserAvatar == true)
        <img class="card" src="{{ Storage::url('avatars/'.$review->user->avatar) }}" alt="{{ $review->user->name }}" width="155px" style="box-shadow: var(--shadow-md)">
    @else
        <img class="card" src="{{ Storage::url('games/icons/'.$review->game->icon) }}" alt="{{ $review->game->title }}" width="155px" style="box-shadow: var(--shadow-md)">
    @endif
    <div class="stack grow justify-between gap-xs p-md">
        <div class="stack gap-xs">
            <div class="h4 color-accent">{{ $review->game->title }}</div>
            <p class="text-xs overflow-hidden" style="line-height: var(--line-height-expanded);">
                {{ Str::limit($review->summary, 120, '...')  }}
                <a href="{{ route('reviews.show', $review->id) }}" class="has-overlay">Read more</a>
            </p>
        </div>
        <div class="row wrap gap-xs justify-between">
            <div class="row wrap gap-xxs">
                <span class="badge">
                    @icon('tabler-user')
                    {{ $review->user->name }}
                </span>
                <span class="badge">
                    {{ $review->created_at->diffForHumans() }}
                </span>
            </div>
            <div class="row wrap gap-xxs">
                <span class="badge">
                    {{ $review->platform->acronym }}
                </span>
                <span class="badge bg-warning-soft">
                    @icon('tabler-star')
                    {{ $review->score }}%
                </span>
            </div>
        </div>
    </div>
</div>