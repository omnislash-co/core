<form wire:submit="save">
    <div class="stack gap-lg stacked-fields">

        <div class="divider color-accent">If you liked</div>
        <div class="field">
            <label class="field__label">Game:</label>
            <div class="grow stack gap-xs" style="position: relative;">
                @if ($playedGame)
                    <div class="input-container">
                        <div class="input">
                            {{ $playedGame->title }}
                        </div>
                        <span>
                            <button class="btn btn--icon btn--sm btn--transparent" wire:click.prevent="unsetPlayedGame">
                                @icon('tabler-x')
                            </button>
                        </span>
                    </div>
                @else
                    <input type="text" placeholder="Search for a game" wire:model.live.throttle="playedSearch">
                @endif

                @if (count($playedGames) > 0)
                    <div class="search-bar-results overflow-hidden">
                        @foreach ($playedGames as $game)
                            <div class="nav-link" wire:click="setPlayedGame({{ $game }})">{{ $game->title }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="text-xs color-danger">@error('form.playedGameId') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="divider color-accent">you may also like</div>
        <div class="field">
            <label class="field__label">Game:</label>
            <div class="grow stack gap-xs" style="position: relative;">
                @if ($game)
                    <div class="input-container">
                        <div class="input">
                            {{ $game->title }}
                        </div>
                        <span>
                            <button class="btn btn--icon btn--sm btn--transparent" wire:click.prevent="unsetGame">
                                @icon('tabler-x')
                            </button>
                        </span>
                    </div>
                @else
                    <input type="text" placeholder="Search for a game" wire:model.live.throttle="search">
                @endif

                @if (count($games) > 0)
                    <div class="search-bar-results overflow-hidden">
                        @foreach ($games as $game)
                            <div class="nav-link" wire:click="setGame({{ $game }})">{{ $game->title }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="text-xs color-danger">@error('form.gameId') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="field">
            <label class="field__label">Platform</label>
            <div class="grow stack gap-xs">
                <select wire:model="form.platformId" :disabled="{{ !$game}}">
                    <option value="null">Select a platform</option>
                    @if ($game)
                        @foreach ($game->platforms as $platform)
                            <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                        @endforeach
                    @endif
                </select>
                <div class="text-xs color-danger">@error('form.platformId') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="field">
            <label class="field__label">Recommendation</label>
            <div class="grow stack gap-xs">
                <x-waterhole::text-editor name="form.body" class="input" :value="$form->body" wire:model="form.body" />
                <div class="text-xs color-danger">@error('form.body') {{ $message }} @enderror</div>
            </div>
        </div>

        <div>
            <button class="btn btn--wide bg-accent" type="submit" wire:loading.attr="disabled">
                Create
            </button>
        </div>
    </div>
</form>