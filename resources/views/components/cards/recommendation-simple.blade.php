@props(['recommendation'])

<div class="card row p-md gap-md overlay-container">
    <div style="flex-basis: 64px;">
        <img class="rounded" src="{{ url('/storage/games/icons/'.$recommendation->game->icon) }}" style="width: 64px"/>
    </div>
    <div class="stack grow gap-sm text-xs">
        <p class="content">
            "If you liked <span class="color-accent weight-medium">{{ $recommendation->playedGame->title }}</span>, you may also like <a href="{{ route('recommendations.show', $recommendation->id) }}" class="has-overlay color-accent weight-medium no-underline">{{ $recommendation->game->title }}</a>"
        </p>
        <div>
            <span class="badge">
                {{ $recommendation->user->name }}
            </span>
            <span class="badge">
                {{ $recommendation->created_at->diffForHumans() }}
            </span>
        </div>
    </div>
</div>