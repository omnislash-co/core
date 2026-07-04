<x-users.library :user="$user" :title="$user->name.'\'s Library'">

    @if (count($entries) > 0)
{{--         <div class="row justify-between">
            <div class="input-container">
                @icon('tabler-search', ['class' => 'no-pointer'])
                <input type="text" placeholder="Search">
            </div>
            <div class="row gap-sm">
                <div class="text-xs">{{ count($entries) }} {{ count($entries) == 1 ? 'game' : 'games' }}</div>
                <button class="btn btn--sm">
                    @icon('tabler-list-check')
                    Columns
                </button>
            </div>
        </div> --}}

        <form action="{{ url()->current() }}" method="GET">

        <div class="table-container card full-width" tabindex="0">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            @if (request('sort') == 'title' || request('sort') == ('' || null))
                                <button class="btn btn--transparent" name="sort" value="-title" type="submit">
                                    Title
                                    @icon('tabler-sort-ascending')
                                </button>
                            @elseif (request('sort') == '-title')
                                <button class="btn btn--transparent" name="sort" value="title" type="submit">
                                    Title
                                    @icon('tabler-sort-descending')
                                </button>
                            @else
                                <button class="btn btn--transparent" name="sort" value="title" type="submit">
                                    Title
                                    @icon('tabler-arrows-sort')
                                </button>
                            @endif
                        </th>
                        <th style="text-align: center;">
                            @if (request('sort') == 'platform,title')
                                <button class="btn btn--transparent" name="sort" value="-platform,title" type="submit">
                                    Platform
                                    @icon('tabler-sort-ascending')
                                </button>
                            @elseif (request('sort') == '-platform,title')
                                <button class="btn btn--transparent" name="sort" value="platform,title" type="submit">
                                    Platform
                                    @icon('tabler-sort-descending')
                                </button>
                            @else
                                <button class="btn btn--transparent" name="sort" value="platform,title" type="submit">
                                    Platform
                                    @icon('tabler-arrows-sort')
                                </button>
                            @endif
                        </th>
                        <th style="text-align: right;">
                            @if (request('sort') == 'score,-title')
                                <button class="btn btn--transparent" name="sort" value="-score,title" type="submit">
                                    Score
                                    @icon('tabler-sort-ascending')
                                </button>
                            @elseif (request('sort') == '-score,title')
                                <button class="btn btn--transparent" name="sort" value="score,-title" type="submit">
                                    Score
                                    @icon('tabler-sort-descending')
                                </button>
                            @else
                                <button class="btn btn--transparent" name="sort" value="-score,title" type="submit">
                                    Score
                                    @icon('tabler-arrows-sort')
                                </button>
                            @endif
                        </th>
                        <th style="text-align: right;">
                            @if (request('sort') == 'main,-title')
                                <button class="btn btn--transparent" name="sort" value="-main,title" type="submit">
                                    Main Story
                                    @icon('tabler-sort-ascending')
                                </button>
                            @elseif (request('sort') == '-main,title')
                                <button class="btn btn--transparent" name="sort" value="main,-title" type="submit">
                                    Main Story
                                    @icon('tabler-sort-descending')
                                </button>
                            @else
                                <button class="btn btn--transparent" name="sort" value="-main,title" type="submit">
                                    Main Story
                                    @icon('tabler-arrows-sort')
                                </button>
                            @endif
                        </th>
                        <th style="text-align: right;">
                            @if (request('sort') == 'sides,-title')
                                <button class="btn btn--transparent" name="sort" value="-sides,title" type="submit">
                                    Main + Sides
                                    @icon('tabler-sort-ascending')
                                </button>
                            @elseif (request('sort') == '-sides,title')
                                <button class="btn btn--transparent" name="sort" value="sides,-title" type="submit">
                                    Main + Sides
                                    @icon('tabler-sort-descending')
                                </button>
                            @else
                                <button class="btn btn--transparent" name="sort" value="-sides,title" type="submit">
                                    Main + Sides
                                    @icon('tabler-arrows-sort')
                                </button>
                            @endif
                        </th>
                        <th style="text-align: right;">
                            @if (request('sort') == 'complete,-title')
                                <button class="btn btn--transparent" name="sort" value="-complete,title" type="submit">
                                    100%
                                    @icon('tabler-sort-ascending')
                                </button>
                            @elseif (request('sort') == '-complete,title')
                                <button class="btn btn--transparent" name="sort" value="complete,-title" type="submit">
                                    100%
                                    @icon('tabler-sort-descending')
                                </button>
                            @else
                                <button class="btn btn--transparent" name="sort" value="-complete,title" type="submit">
                                    100%
                                    @icon('tabler-arrows-sort')
                                </button>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entries as $entry)
                        @if ( 
                            ( request('sort') == ('platform,title') || request('sort') == ('-platform,title') )
                            && ($loop->index == 0 || $entries[$loop->index-1]->platform->name != $entry->platform->name)
                            )
                            <tr>
                                <td colspan="6" class="bg-warning-soft">
                                    {{ $entry->platform->name }}
                                </td>
                            </tr>
                        @endif
                        <tr class="list-entry tooltip-container">
                            <td style="min-width: 275px;">
                                <div class="row justify-between">
                                    <a href="{{ route('games.show', $entry->game->slug) }}" class="row gap-sm ">
                                        {{-- <img class="tooltip-icon game-icon" src="{{ Storage::url('games/icons/'.$entry->game->icon) }}"> --}}
                                        <img style="width: 32px; border-radius: .25rem;" src="{{ Storage::url('games/icons/'.$entry->game->icon) }}">
                                        {{ $entry->game->title }}
                                    </a>
                                    @auth
                                        @if ($user->id == $entry->user_id)
                                            <a href="{{ route('library.edit', ['game' => $entry->game->slug, 'library' => $entry->id]) }}" data-turbo-frame="modal" class="btn btn--sm tooltip-edit">@icon('tabler-edit')</a>
                                        @endif
                                    @endauth
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge">{{ $entry->platform->acronym }}</span>
                            </td>
                            <td style="text-align: right; padding-right: var(--space-lg);">
                                {{ $entry->score ? $entry->score : '-' }}
                            </td>
                            <td style="text-align: right; padding-right: var(--space-lg);">
                                {{ $entry->hours ? $entry->hours.'h' : '-' }}
                            </td>
                            <td style="text-align: right; padding-right: var(--space-lg);">
                                {{ $entry->hours_optional ? $entry->hours_optional.'h' : '-' }}
                            </td>
                            <td style="text-align: right; padding-right: var(--space-lg);">
                                {{ $entry->hours_complete ? $entry->hours_complete.'h' : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $entries->links() }}

        </form>
    @else
        <div class="placeholder">
            @icon('tabler-device-gamepad', ['class' => 'placeholder__icon'])
            <h4>No Games</h4>
        </div>
    @endif

</x-users.library>