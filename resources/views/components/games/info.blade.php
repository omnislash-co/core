@props(['game'])

<div class="data-set">
    <div class="data-set-item">
        @icon('tabler-code')
        <span>
            <span class="data-set-item__key">Developers</span>
            <span class="data-set-item__value">
                @if (count($game->developers) > 0)
                    <div class="row wrap gap-xxs">
                        @foreach ($game->developers->sortBy('name') as $developer)
                            <button class="btn btn--sm btn--outline">
                                {{ $developer->name }}
                            </button>
                        @endforeach
                    </div>
                @else
                    -
                @endif
            </span>
        </span>
    </div>
    <div class="data-set-item">
        @icon('tabler-calendar')
        <span>
            <span class="data-set-item__key">Initial Release Year</span>
            <span class="data-set-item__value">{{ $game->initial_release_year }}</span>
        </span>
    </div>
    <div class="data-set-item">
        @icon('tabler-tag')
        <span>
            <span class="data-set-item__key">Genres</span>
            <span class="data-set-item__value">
                @if (count($game->genres) > 0)
                    <div class="row wrap gap-xxs">
                        @foreach ($game->genres->sortBy('acronym') as $genre)
                            <button class="btn btn--sm btn--outline">
                                {{ $genre->acronym }}
                                <ui-tooltip>
                                    {{ $genre->name }}
                                </ui-tooltip>
                            </button>
                        @endforeach
                    </div>
                @else
                    -
                @endif
            </span>
        </span>
    </div>
    <div class="data-set-item">
        @icon('tabler-device-gamepad')
        <span>
            <span class="data-set-item__key">Platforms</span>
            <span class="data-set-item__value">
                @if (count($game->platforms) > 0)
                    <div class="row wrap gap-xxs">
                        @foreach ($game->platforms->sortBy('acronym') as $platform)
                            <button class="btn btn--sm btn--outline">
                                {{ $platform->acronym }}
                                <ui-tooltip>
                                    {{ $platform->name }}
                                </ui-tooltip>
                            </button>
                        @endforeach
                    </div>
                @else
                    -
                @endif
            </span>
        </span>
    </div>
</div>