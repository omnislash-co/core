@props(['recommendation'])

<div class="card stack overlay-container overflow-hidden" style="max-height: 150px;">
    <div class="row overflow-hidden">
        <div class="card__game-icon-a-mini" 
            style="background-image: url('{{ Storage::url('games/icons/'.$recommendation->playedGame->icon) }}')">
        </div>
        <div class="stack grow gap-xs justify-between p-sm text-xs">
            <p style="line-height: var(--line-height-expanded);">
                "If you liked <span class="color-accent weight-medium">{{ $recommendation->playedGame->title }}</span>, you may also like <a href="{{ route('recommendations.show', $recommendation->id) }}" class="has-overlay color-accent weight-medium">{{ $recommendation->game->title }}</a>"
            </p>
        </div>
        <div class="card__game-icon-b-mini" 
            style="background-image: url('{{ Storage::url('games/icons/'.$recommendation->game->icon) }}')">
        </div>
    </div>

    <div class="row justify-between p-sm bg-fill">
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