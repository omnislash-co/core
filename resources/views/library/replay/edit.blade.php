<x-modals.library :$game>

    <form action="{{ route('replay.update', ['game' => $game->slug, 'library' => $library->id, 'replay' => $replay->id]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="badge" style="margin-bottom: var(--space-md);">
            @icon('tabler-repeat') {{ $library->platform->name }}
        </div>

        <div class="stack gap-sm stacked-fields">

            <div class="grid wrap gap-sm" style="--grid-min: 25ch;">
                <div class="field">
                    <label class="field__label">Main Story (hrs)</label>
                    <div class="grow stack gap-xs">
                        <input type="number" min="0" name="hours" value="{{ old('hours', $replay->hours) }}" />
                        <div class="text-xs color-danger">@error('hours') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="field">
                    <label class="field__label">Main + Optional (hrs)</label>
                    <div class="grow stack gap-xs">
                        <input type="number" min="0" name="hours_optional" value="{{ old('hours_optional', $replay->hours_optional) }}" />
                        <div class="text-xs color-danger">@error('hours_optional') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="field">
                    <label class="field__label">Completionist (hrs)</label>
                    <div class="grow stack gap-xs">
                        <input type="number" min="0" name="hours_complete" value="{{ old('hours_complete', $replay->hours_complete) }}" />
                        <div class="text-xs color-danger">@error('hours_complete') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="field__label">Notes</label>
                <div class="grow stack gap-xs">
                    <textarea name="notes">{{ old('notes', $replay->notes) }}</textarea>
                    <div class="text-xs color-danger">@error('notes') {{ $message }} @enderror</div>
                </div>
            </div>

            <div class="row gap-sm">
                <button class="btn btn--wide bg-accent" type="submit">
                    Update
                </button>
                <a href="{{ route('library.index', $game->slug) }}" class="btn btn--wide">
                    Cancel
                </a>
            </div>

        </div>
    </form>

</x-modals.library>