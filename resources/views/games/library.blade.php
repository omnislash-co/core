<x-app-layout :title="'Library - '.$game->title">

    <turbo-frame id="modal">
        <div class="section container measure" style="width: 80vw">
            <div class="dialog" aria-labelledby="dialog-title">
                <div class="dialog__header">
                    <div class="row grow justify-between">
                        <h1 class="h3" id="dialog-title">Library - {{ $game->title }}</h1>
                        <a href="{{ url()->previous() }}" class="btn btn--icon" data-action="modal#hide">
                            @icon('tabler-x')
                        </a>
                    </div>
                </div>
                <div class="dialog__body">

                    <turbo-frame id="library">
                        <div class="stack gap-lg">
                            @if (count($libraries) > 0)
                                <div class="table-container full-width">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Platform</th>
                                                <th>Play Status</th>
                                                <th>Score</th>
                                                <th>Hours Played</th>
                                                <th>Notes</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($libraries as $entry)
                                                <tr>
                                                    <td>{{ $entry->platform->acronym }}</td>
                                                    <td>
                                                        <span class="badge {{ $entry->playStatus->css_class }}">{{ $entry->playStatus->name }}</span>
                                                    </td>
                                                    <td>{{ $entry->score ? $entry->score : '-' }}</td>
                                                    <td>{{ $entry->hours ? $entry->hours : '-' }}</td>
                                                    <td>
                                                        @if ($entry->notes)
                                                            <button class="btn">
                                                                @icon('tabler-notes')
                                                                <ui-tooltip>{{ $entry->notes }}</ui-tooltip>
                                                            </button>
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                    <td class="row gap-xxs justify-end">
                                                        <a href="{{ route('library.edit', ['game' => $game->slug, 'library' => $entry->id]) }}" class="btn">@icon('tabler-edit')</a>
                                                        <form action="{{ route('library.destroy', ['game' => $game->slug, 'library' => $entry->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn bg-danger" type="submit">@icon('tabler-trash')</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                    </turbo-frame>

                </div>
            </div>
        </div>
    </turbo-frame>
    
</x-app-layout>