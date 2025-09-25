<x-modals.library :$game>

    <div class="stack gap-lg">
        @if (count($libraries) > 0)
            <div class="text-xs">
                <div class="row">
                    <div class="p-sm weight-bold" style="flex: 1">Platform</div>
                    <div class="p-sm weight-bold text-center hide-md-down" style="flex: 0.5">Score</div>
                    <div class="p-sm weight-bold text-center hide-md-down" style="flex: 0.5">Main Story (hrs)</div>
                    <div class="p-sm weight-bold text-center hide-md-down" style="flex: 0.5">Main + Optional (hrs)</div>
                    <div class="p-sm weight-bold text-center hide-md-down" style="flex: 0.5">100% (hrs)</div>
                    <div class="p-sm weight-bold hide-md-down" style="flex: 1.5"></div>
                </div>
                @foreach ($libraries as $entry)
                <div data-controller="element" data-element-hidden-class="hidden" >
                    <div class="row align-center" style="border-top: 1px solid var(--color-fill);">
                        <div class="p-sm stack gap-xxs" style="flex: 1">
                            <div class="row wrap gap-xxs">
                                <span>{{ $entry->platform->acronym }}</span>
                                <span class="badge {{ $entry->playStatus->css_class }}">{{ $entry->playStatus->name }}</span>
                            </div>
                            <div class="row wrap gap-xxs">
                                @if ($entry->score)
                                    <span class="badge hide-lg-up">
                                        @icon('tabler-heart')
                                        {{ $entry->score }}
                                    </span>
                                @endif
                                @if ($entry->hours)
                                    <span class="badge hide-lg-up">
                                        @icon('tabler-clock')
                                        Main: {{ $entry->hours.'hrs' }}
                                    </span>
                                @endif
                                @if ($entry->notes)
                                    <span class="badge">
                                        @icon('tabler-notes')
                                        Notes
                                        <ui-tooltip>{{ $entry->notes }}</ui-tooltip>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="p-sm text-center hide-md-down" style="flex: 0.5">{{ $entry->score ? $entry->score : '-' }}</div>
                        <div class="p-sm text-center hide-md-down" style="flex: 0.5">{{ $entry->hours ? $entry->hours : '-' }}</div>
                        <div class="p-sm text-center hide-md-down" style="flex: 0.5">{{ $entry->hours_optional ? $entry->hours_optional : '-' }}</div>                        
                        <div class="p-sm text-center hide-md-down" style="flex: 0.5">{{ $entry->hours_complete ? $entry->hours_complete : '-' }}</div>
                        <div class="p-sm row wrap gap-xxs justify-end" style="flex: 1.5">
                            @if ($entry->playStatus->name == 'Completed')
                                <button class="btn bg-accent" data-action="element#toggle">
                                    @icon('tabler-repeat')
                                    {{ $entry->replays->count() }}
                                </button>
                            @endif
                            <a href="{{ route('library.edit', ['game' => $game->slug, 'library' => $entry->id]) }}" class="btn">@icon('tabler-edit')</a>
                            <form action="{{ route('library.destroy', ['game' => $game->slug, 'library' => $entry->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                @method('DELETE')
                                @csrf
                                <button class="btn bg-danger" type="submit">@icon('tabler-trash')</button>
                            </form>
                        </div>
                    </div>
                    <div data-element-target="element" class="card replay-list hidden" style="margin-bottom: var(--space-md); box-shadow: var(--shadow-md)">
                        @foreach ($entry->replays as $replay)
                        <div>
                            <div class="row hide-md-down">
                                <div class="row gap-xxs p-sm wrap" style="flex:1">
                                    <span class="badge bg-emphasis hide-md-down">
                                        @icon('tabler-repeat') {{ $loop->iteration }}
                                    </span>
                                    @if ($replay->started_on || $replay->finished_on)
                                        <span class="badge">
                                            @icon('tabler-calendar')
                                            Dates
                                            <ui-tooltip>
                                                Started: Aug 1, 2025<br>
                                                Finished: Sept 2, 2025
                                            </ui-tooltip>
                                        </span>
                                    @endif
                                    @if ($replay->notes)
                                        <span class="badge">
                                            @icon('tabler-notes')
                                            Notes
                                            <ui-tooltip>{{ $replay->notes }}</ui-tooltip>
                                        </span>
                                    @endif
                                </div>
                                <div class="p-sm" style="flex:0.5"></div>
                                <div class="text-center weight-medium p-sm" style="flex:0.5">
                                    {{ $replay->hours ? $replay->hours : '-' }}
                                </div>
                                <div class="text-center weight-medium p-sm" style="flex:0.5">
                                    {{ $replay->hours_optional ? $replay->hours_optional : '-' }}
                                </div>
                                <div class="text-center weight-medium p-sm" style="flex:0.5">
                                    {{ $replay->hours_complete ? $replay->hours_complete : '-' }}
                                </div>
                                <div class="row gap-xxs justify-end p-sm" style="flex:1.5">
                                    <a href="{{ route('replay.edit', ['game' => $game->slug, 'library' => $entry->id, 'replay' => $replay->id]) }}" class="btn">@icon('tabler-edit')</a>
                                    <form action="{{ route('replay.destroy', ['game' => $game->slug, 'library' => $entry->id, 'replay' => $replay->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn bg-danger" type="submit">@icon('tabler-trash')</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row gap-xxs p-sm justify-between hide-lg-up">
                                <div class="row wrap gap-xxs">
                                    @if ($replay->started_on || $replay->finished_on)
                                        <span class="badge">
                                            @icon('tabler-calendar')
                                            Dates
                                            <ui-tooltip>
                                                Started: Aug 1, 2025<br>
                                                Finished: Sept 2, 2025
                                            </ui-tooltip>
                                        </span>
                                    @endif
                                    @if ($replay->notes)
                                        <span class="badge">
                                            @icon('tabler-notes')
                                            Notes
                                            <ui-tooltip>{{ $replay->notes }}</ui-tooltip>
                                        </span>
                                    @endif
                                    @if ($replay->hours)
                                        <div>
                                            <span class="badge">@icon('tabler-clock') Main: {{ $replay->hours }}hrs</span> 
                                        </div>
                                    @endif
                                    @if ($replay->hours_optional)
                                        <div>
                                            <span class="badge">@icon('tabler-clock') +Optional: {{ $replay->hours_optional }}hrs</span> 
                                        </div>
                                    @endif
                                    @if ($replay->hours_complete)
                                        <div>
                                            <span class="badge">@icon('tabler-clock') 100%: {{ $replay->hours_complete }}hrs</span> 
                                        </div>
                                    @endif
                                </div>
                                <div class="row gap-xxs">
                                    <a href="{{ route('replay.edit', ['game' => $game->slug, 'library' => $entry->id, 'replay' => $replay->id]) }}" class="btn">@icon('tabler-edit')</a>
                                    <form action="{{ route('replay.destroy', ['game' => $game->slug, 'library' => $entry->id, 'replay' => $replay->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn bg-danger" type="submit">@icon('tabler-trash')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="p-sm">
                            <a href="{{ route('replay.create', ['game' => $game->slug, 'library' => $entry->id]) }}" class="btn btn--wide btn--outline">
                                Add Replay
                            </a>
                        </div>
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