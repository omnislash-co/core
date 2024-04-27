<form wire:submit="save">
    <div class="stack gap-lg stacked-fields">

        <div class="field">
            <label class="field__label">Game</label>
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
            <label class="field__label">Review</label>
            <div class="grow stack gap-xs">
                <x-waterhole::text-editor name="form.body" class="input" :value="$form->body" wire:model="form.body" />
                <div class="text-xs color-danger">@error('form.body') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="field">
            <label class="field__label">Summary</label>
            <div class="grow stack gap-xs">
                <textarea placeholder="Write a short summary about your review (Maximum 255 characters)" wire:model="form.summary"></textarea>
                <div class="text-xs color-danger">@error('form.summary') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="field">
            <label class="field__label">Score</label>
            <div class="grow stack gap-xs">
                <input type="number" min="0" max="100" placeholder="0-100" wire:model="form.score" />
                <div class="text-xs color-danger">@error('form.score') {{ $message }} @enderror</div>
            </div>
        </div>

        <div>
            <button class="btn btn--wide bg-accent" type="submit" wire:loading.attr="disabled">
                Create
            </button>
        </div>
    </div>
</form>