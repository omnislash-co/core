@props(['game'])

<div class="card row align-start align-stretch overlay-container overflow-hidden">
    <div class="card__game-icon" style="background-image: url('{{ url('/storage/games/icons/'.$game->icon) }}')"></div>
    <div class="stack grow gap-xs p-sm">
        <a href="{{ route('games.show', $game->slug) }}" class="h4 color-accent has-overlay">{{ $game->title }}</a>
        <div>
            @foreach ($game->developers as $developer)
                <span class="badge bg-emphasis">
                    {{ $developer->name }}
                </span>
            @endforeach
            <span class="badge">
                @icon('tabler-calendar-filled')
                {{ $game->initial_release_year }}
            </span>
            @foreach ($game->genres as $genre)
                <span class="badge">
                    @icon('tabler-tag')
                    {{ $genre->acronym }}
                </span>
            @endforeach
        </div>
        <p class="content text-xs">
            {{ Str::limit($game->description, 150, '...')  }}
        </p>
    </div>
</div>