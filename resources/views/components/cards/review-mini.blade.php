@props(['review', 'showUserAvatar' => false, 'hideTitle' => false])

<div class="card stack overlay-container overflow-hidden" style="max-height: 150px;">
    <div class="row align-stretch overflow-hidden">
        @if ($showUserAvatar == true)
            <div class="card__relation-icon" 
                style="background-image: url('{{ Storage::url('avatars/'.$review->user->avatar) }}')">
            </div>
        @else
            <div class="card__relation-icon" 
                style="background-image: url('{{ Storage::url('games/icons/'.$review->game->icon) }}')">
            </div>
        @endif
        <div class="stack grow gap-xs justify-between p-sm text-xs">
            <div class="stack gap-xs">
                @if ($hideTitle != true)
                    <span class="h6 color-accent ">{{ $review->game->title }}</span>
                @endif
                <p style="line-height: var(--line-height-expanded);">
                    {{ Str::limit($review->summary, 100, '...')  }}
                    <a href="{{ route('reviews.show', $review->id) }}" class="has-overlay">Read more</a>
                </p>
            </div>
        </div>    
    </div>

    <div class="row justify-between p-sm bg-fill">
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