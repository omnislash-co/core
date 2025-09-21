<x-modals.library :$game>

    <form action="{{ route('library.update', ['game' => $game->slug, 'library' => $library->id]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="stack gap-sm stacked-fields">

            <div class="grid wrap gap-sm" style="--grid-min: 30ch;">
                <div class="field">
                    <label class="field__label">Platform</label>
                    <div class="grow stack gap-xs">
                        <select name="platform">
                            <option value="">Select a platform</option>
                            @foreach ($game->platforms as $platform)
                                <option value="{{ $platform->id }}" @if ($platform->id == old('platform', $library->platform->id))) selected @endif>{{ $platform->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-xs color-danger">@error('platform') {{ $message }} @enderror</div>
                    </div>
                </div>
        
                <div class="field">
                    <label class="field__label">Play Status</label>
                    <div class="grow stack gap-xs">
                        <select name="playStatus">
                            <option value="">Select a play status</option>
                            @foreach ($playStatuses as $playStatus)
                                <option value="{{ $playStatus->id }}" @if ($playStatus->id == old('playStatus', $library->playStatus->id)) selected @endif>{{ $playStatus->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-xs color-danger">@error('playStatus') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="field">
                    <label class="field__label">Score</label>
                    <div class="grow stack gap-xs">
                        <select name="score">
                            <option value="">Select a score</option>
                            @for ($i = 0; $i < 11; $i++)
                                <option value="{{ $i }}" @if ($i == old('score', $library->score) && !is_null(old('score', $library->score)))) selected @endif>{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="text-xs color-danger">@error('score') {{ $message }} @enderror</div>
                    </div>
                </div>
        
                <div class="field">
                    <label class="field__label">Hours Played</label>
                    <div class="grow stack gap-xs">
                        <input type="number" min="0" name="hours" value="{{ old('hours', $library->hours) }}" />
                        <div class="text-xs color-danger">@error('hours') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="field__label">Notes</label>
                <div class="grow stack gap-xs">
                    <textarea name="notes">{{ old('notes', $library->notes) }}</textarea>
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