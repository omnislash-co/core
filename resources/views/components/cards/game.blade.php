@props(['game'])

<div class="card rotate-img-on-hover row align-start align-stretch overlay-container" style="max-height: 155px;">
    <img class="card" src="{{ Storage::url('games/icons/'.$game->icon) }}" alt="{{ $game->title }}" width="155px" style="box-shadow: var(--shadow-md)">
    <div class="stack grow gap-xs p-md">
        <a href="{{ route('games.show', $game->slug) }}" class="h4 color-accent has-overlay">{{ $game->title }}</a>
        <div class="row wrap gap-xxs">
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
        <p class="content text-xs overflow-hidden">
            {{ Str::limit($game->description, 140, '...')  }}
        </p>
    </div>
</div>