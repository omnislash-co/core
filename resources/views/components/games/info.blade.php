@php
    $regionOrder = [
        'Japan' => 1,
        'North America' => 2,
        'Europe' => 3,
    ];
@endphp

@props(['game'])

<div class="stack gap-sm text-xs">

    <div class="row gap-xs align-start">
        <div>@icon('tabler-code')</div>
        <div class="stack gap-xxs">
            <div class="weight-medium">Developers</div>
            <div class="row wrap gap-xxs">
                @if (count($game->developers) > 0)
                    @foreach ($game->developers as $developer)
                        <a href="{{ route('games.index', ['filter[developers][]' => $developer->name]) }}" class="btn btn--sm btn--outline">
                            {{ $developer->name }}
                            <ui-tooltip>
                                {{ $developer->name }}
                            </ui-tooltip>
                        </a>
                    @endforeach
                @else
                    -
                @endif
            </div>
        </div>
    </div>

    <div class="row gap-xs align-start">
        <div>@icon('tabler-calendar')</div>
        <div class="stack gap-xxs">
            <div class="weight-medium">Initial Release Year</div>
            <div class="color-muted">{{ $game->initial_release_year }}</div>
        </div>
    </div>

    <div class="row gap-xs align-start">
        <div>@icon('tabler-tag')</div>
        <div class="stack gap-xxs">
            <div class="weight-medium">Genres</div>
            <div class="row wrap gap-xxs">
                @if (count($game->genres) > 0)
                    @foreach ($game->genres->sortBy('acronym') as $genre)
                        <a href="{{ route('games.index', ['filter[genres][]' => $genre->name]) }}" class="btn btn--sm btn--outline">
                            {{ $genre->acronym }}
                            <ui-tooltip>
                                {{ $genre->name }}
                            </ui-tooltip>
                        </a>
                    @endforeach
                @else
                    -
                @endif
            </div>
        </div>
    </div>

    <div class="row gap-xs align-start">
        <div>@icon('tabler-device-gamepad')</div>
        <div class="stack grow gap-sm">
            <div class="weight-medium">Platforms</div>

            @if (count($game->platforms) > 0)
                @foreach ($game->platforms as $platform)
                    <div class="stack gap-xxs">
                        <div>
                            <a href="{{ route('games.index', ['filter[platforms][]' => $platform->name]) }}" class="btn btn--sm btn--outline">
                                {{ Str::limit($platform->name, 23, '...')  }}
                                <ui-tooltip>
                                    {{ $platform->name }}
                                </ui-tooltip>
                            </a>
                        </div>
                        @if (count($platform->releases) > 0)
                            @php
                                $sortedReleases = $platform->releases->sortBy(
                                    fn ($release) => $regionOrder[$release->region->name] ?? 99
                                );
                            @endphp

                            @foreach ($sortedReleases as $release)
                                @php
                                    $badgeClass = match ($release->region->name) {
                                        'Japan' => 'badge bg-accent',
                                        'North America' => 'badge bg-accent-soft',
                                        default => 'badge',
                                    };
                                @endphp

                                <div class="row justify-between text-xs">
                                    <div class="{{ $badgeClass }}">{{ $release->region->acronym }}</div>
                                    <div class="row">
                                        @if ($release->alternate_title)
                                        <div>
                                            <button class="btn btn--sm btn--transparent">
                                                @icon('tabler-info-circle')
                                                <ui-tooltip>{{ $release->alternate_title }}</ui-tooltip>
                                            </button>
                                        </div>
                                        @endif
                                        <div>{{ Carbon\Carbon::parse($release->date)->toFormattedDateString() }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
            @else
                -
            @endif

        </div>
    </div>

</div>