<x-modals.library :$game>

    <div class="stack gap-lg">
        @if (count($libraries) > 0)
            <div class="text-xs">
                <div class="row">
                    <div class="p-sm weight-bold" style="flex: 1">Platform</div>
                    <div class="p-sm weight-bold hide-md-down" style="flex: 1">Play Status</div>
                    <div class="p-sm weight-bold text-center hide-md-down" style="flex: 0.5">Score</div>
                    <div class="p-sm weight-bold text-center hide-md-down" style="flex: 0.5">Hours</div>
                    <div class="p-sm weight-bold text-center hide-md-down" style="flex: 0.5">Notes</div>
                    <div class="p-sm weight-bold hide-md-down" style="flex: 1.5"></div>
                </div>
                @foreach ($libraries as $entry)
                    <div class="row align-center" style="border-top: 1px solid var(--color-fill);">
                        <div class="p-sm stack gap-xxs" style="flex: 1">
                            <div class="row wrap gap-xxs">
                                <span>{{ $entry->platform->acronym }}</span>
                                <span class="badge hide-lg-up {{ $entry->playStatus->css_class }}">{{ $entry->playStatus->name }}</span>
                            </div>
                            <div class="row wrap gap-xxs hide-lg-up">
                                @if ($entry->score)
                                    <span class="badge">
                                        @icon('tabler-heart')
                                        {{ $entry->score }}
                                    </span>
                                @endif
                                @if ($entry->hours)
                                    <span class="badge">
                                        @icon('tabler-clock')
                                        {{ $entry->hours.'hrs' }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                @if ($entry->notes)
                                    <span class="badge hide-lg-up">
                                        @icon('tabler-notes')
                                        Notes
                                        <ui-tooltip>{{ $entry->notes }}</ui-tooltip>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="p-sm hide-md-down" style="flex: 1">
                            <span class="badge {{ $entry->playStatus->css_class }}">{{ $entry->playStatus->name }}</span>
                        </div>
                        <div class="p-sm text-center hide-md-down" style="flex: 0.5">{{ $entry->score ? $entry->score : '-' }}</div>
                        <div class="p-sm text-center hide-md-down" style="flex: 0.5">{{ $entry->hours ? $entry->hours : '-' }}</div>
                        <div class="p-sm text-center hide-md-down" style="flex: 0.5">
                            @if ($entry->notes)
                                <button class="btn">
                                    @icon('tabler-notes')
                                    <ui-tooltip>{{ $entry->notes }}</ui-tooltip>
                                </button>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                        <div class="p-sm row wrap gap-xxs justify-end" style="flex: 1.5">
                            <a href="{{ route('library.edit', ['game' => $game->slug, 'library' => $entry->id]) }}" class="btn">@icon('tabler-edit')</a>
                            <form action="{{ route('library.destroy', ['game' => $game->slug, 'library' => $entry->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                @method('DELETE')
                                @csrf
                                <button class="btn bg-danger" type="submit">@icon('tabler-trash')</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row gap-sm">
                <a href="{{ route('library.create', $game->slug) }}" class="btn btn--wide">
                    Add Entry
                </a>
            </div>
        @else
            <div class="placeholder">
                @icon('tabler-books', ['class' => 'placeholder__icon'])
                <h4>No Entries</h4>
                <p>Add an entry to get started.</p>
                <a href="{{ route('library.create', $game->slug) }}" class="btn">Add Entry</a>
            </div>
        @endif
    </div>

</x-modals.library>