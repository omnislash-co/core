<form wire:submit="save">
    <div class="stack gap-lg stacked-fields">

        <div class="divider color-accent">If you liked</div>
        <div class="field">
            <label class="field__label">Game:</label>
            <div class="grow stack gap-xs">
                @if ($playedGame)
                    <div wire:key="{{ $playedGame->id }}" class="input-container">
                        <div class="input">
                            {{ $playedGame->title }}
                        </div>
                        <span>
                            <button class="btn btn--icon btn--sm bg-danger-soft" wire:click.prevent="unsetPlayedGame">
                                @icon('tabler-x')
                            </button>
                        </span>
                    </div>
                @else
                    <div wire:key="{{ 0 }}" style="position: relative;">
                        <div class="input-container">
                            @icon('tabler-search', ['class' => 'no-pointer'])
                            <input type="text" name="played-search" 
                                placeholder="Search for a game"
                                wire:model.live.throttle="playedSearch"
                                wire:focus="togglePlayedOptions(true)" 
                                wire:blur="togglePlayedOptions(false)">
                        </div>
                        @if ($showPlayedOptions)
                            <div class="menu filters-menu text-sm" wire:transition.in.origin.top>
                                @forelse ($playedGames as $game)
                                    <div class="nav-link" wire:key="{{ $game->id }}" wire:click="setPlayedGame({{ $game }})">{{ $game->title }}</div>
                                @empty
                                    <div class="p-xs" wire:key="{{ 0 }}">No games found.</div>
                                @endforelse
                            </div>
                        @endif
                    </div>
                @endif
                <div class="text-xs color-danger">@error('form.playedGameId') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="divider color-accent">you may also like</div>
        <div class="field">
            <label class="field__label">Game:</label>
            <div class="grow stack gap-xs">
                @if ($game)
                    <div wire:key="{{ $game->id }}" class="input-container">
                        <div class="input">
                            {{ $game->title }}
                        </div>
                        <span>
                            <button class="btn btn--icon btn--sm bg-danger-soft" wire:click.prevent="unsetGame">
                                @icon('tabler-x')
                            </button>
                        </span>
                    </div>
                @else
                    <div wire:key="{{ 0 }}" style="position: relative;">
                        <div class="input-container">
                            @icon('tabler-search', ['class' => 'no-pointer'])
                            <input type="text" name="search" 
                                placeholder="Search for a game"
                                wire:model.live.throttle="search"
                                wire:focus="toggleOptions(true)" 
                                wire:blur="toggleOptions(false)">
                        </div>
                        @if ($showOptions)
                            <div class="menu filters-menu text-sm" wire:transition.in.origin.top>
                                @forelse ($games as $game)
                                    <div class="nav-link" wire:key="{{ $game->id }}" wire:click="setGame({{ $game }})">{{ $game->title }}</div>
                                @empty
                                    <div class="p-xs" wire:key="{{ 0 }}">No games found.</div>
                                @endforelse
                            </div>
                        @endif
                    </div>
                @endif
                <div class="text-xs color-danger">@error('form.gameId') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="field">
            <label class="field__label">Platform</label>
            <div class="grow stack gap-xs">
                @if ($game)
                    <select wire:model="form.platformId" wire:key="{{ $game->id }}">
                        <option value="null">Select a platform</option>
                        @foreach ($game->platforms as $platform)
                            <option value="{{ $platform->id }}" wire:key="{{ $platform->id }}">{{ $platform->name }}</option>
                        @endforeach
                    </select>
                @else
                    <select wire:key="{{ 0 }}" disabled>
                        <option>No game selected</option>
                    </select>
                @endif
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