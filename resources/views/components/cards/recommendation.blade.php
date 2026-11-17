@props(['recommendation'])

<div class="card row align-stretch overlay-container overflow-hidden">
    <div class="card__game-icon-a" style="background-image: url('{{ Storage::url('games/icons/'.$recommendation->playedGame->icon) }}')"></div>
    <div class="stack grow gap-sm p-sm justify-center">
        <p class="text-xs content">
            "If you liked <span class="color-accent weight-medium">{{ $recommendation->playedGame->title }}</span>, you may also like <span class="color-accent weight-medium">{{ $recommendation->game->title }}</span>"
            <a href="{{ route('recommendations.show', $recommendation->id) }}" class="has-overlay"></a>
        </p>
        <div class="row wrap gap-xs justify-between">
            <div class="row wrap gap-xxs">
                <span class="badge">
                    @icon('tabler-user')
                    {{ $recommendation->user->name }}
                </span>
                <span class="badge">
                    {{ $recommendation->created_at->diffForHumans() }}
                </span>
            </div>
            <div class="row wrap gap-xxs">
                <span class="badge bg-warning-soft">
                    {{ $recommendation->platform->acronym }}
                </span>
            </div>
        </div>
    </div>
    <div class="card__game-icon-b push-end" style="background-image: url('{{ Storage::url('games/icons/'.$recommendation->game->icon) }}')"><a href="{{ route('recommendations.show', $recommendation->id) }}" class="has-overlay"></a></div>
</div>