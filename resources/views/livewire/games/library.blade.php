<div class="stack gap-lg">
    @if (count($this->libraries) > 0)
        <div class="table-container full-width">
            <table class="table">
                <thead>
                    <tr>
                        <th>Platform</th>
                        <th>Play Status</th>
                        <th>Score</th>
                        <th>Hours Played</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->libraries as $entry)
                        <tr>
                            <td>{{ $entry->platform->acronym }}</td>
                            <td>
                                <span class="badge {{ $entry->playStatus->css_class }}">{{ $entry->playStatus->name }}</span>
                            </td>
                            <td>{{ $entry->score ? $entry->score : '-' }}</td>
                            <td>{{ $entry->hours ? $entry->hours : '-' }}</td>
                            <td class="row gap-xxs justify-end">
                                <button class="btn btn--sm" wire:click="setEntry({{$entry->id}})">@icon('tabler-edit')</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($this->editMode)
            <div class="divider color-activity">Edit Entry</div>
        @else
            <div class="divider color-accent">New Entry</div>
        @endif
    @endif


    <form wire:submit="save">
        <div class="stack gap-sm stacked-fields">
    
            <div class="grid wrap gap-sm" style="--grid-min: 30ch;">
                <div class="field">
                    <label class="field__label">Platform</label>
                    <div class="grow stack gap-xs">
                        <select wire:model="form.platformId">
                            <option value="null">Select a platform</option>
                            @foreach ($game->platforms as $platform)
                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-xs color-danger">@error('form.platformId') {{ $message }} @enderror</div>
                    </div>
                </div>
        
                <div class="field">
                    <label class="field__label">Play Status</label>
                    <div class="grow stack gap-xs">
                        <select wire:model="form.playStatusId">
                            <option value="null">Select a play status</option>
                            @foreach ($this->playStatuses as $playStatus)
                                <option value="{{ $playStatus->id }}">{{ $playStatus->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-xs color-danger">@error('form.playStatusId') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="field">
                    <label class="field__label">Score</label>
                    <div class="grow stack gap-xs">
                        <select wire:model="form.score">
                            <option value="null">Select a score</option>
                            @for ($i = 0; $i < 11; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="text-xs color-danger">@error('form.score') {{ $message }} @enderror</div>
                    </div>
                </div>
        
                <div class="field">
                    <label class="field__label">Hours Played</label>
                    <div class="grow stack gap-xs">
                        <input type="number" min="0" wire:model="form.hours" />
                        <div class="text-xs color-danger">@error('form.hours') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="field__label">Notes</label>
                <div class="grow stack gap-xs">
                    <textarea wire:model="form.notes"></textarea>
                    <div class="text-xs color-danger">@error('form.notes') {{ $message }} @enderror</div>
                </div>
            </div>
    
            <div class="row gap-sm">
                <button class="btn btn--wide bg-accent" type="submit" wire:loading.attr="disabled">
                    Save
                </button>
                @if ($this->editMode)
                    <button class="btn btn--wide" wire:click.prevent="resetForm">
                        Cancel
                    </button>
                    <button class="btn btn--narrow bg-danger push-end" wire:loading.attr="disabled" wire:click.prevent="delete" wire:confirm="Are you sure you want to delete this entry?">@icon('tabler-trash')</button>
                @endif
            </div>
    
        </div>
    </form>

</div>
