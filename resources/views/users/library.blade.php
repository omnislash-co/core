<x-users.library :user="$user" :title="$user->name.'\'s Library'">

    @if (count($entries) > 0)
        <div class="card p-sm text-xs">
            <div class="row">
                <div class="p-sm weight-bold" style="flex: 8">Title</div>
                <div class="p-sm weight-bold" style="flex: 3">Platform</div>
                <div class="p-sm weight-bold text-center" style="flex: 1">Score</div>
                <div class="p-sm weight-bold text-center" style="flex: 1">Hours</div>
            </div>
            @foreach ($entries->sortBy('game.title') as $entry)
                <div class="row align-center list-entry tooltip-container">
                    <img class="tooltip-icon game-icon" src="{{ Storage::url('games/icons/'.$entry->game->icon) }}">
                    <div class="p-sm row justify-between" style="flex: 8">
                        <a href="{{ route('games.show', $entry->game->slug) }}">{{ $entry->game->title }}</a>
                        <a href="{{ route('library.edit', ['game' => $entry->game->slug, 'library' => $entry->id]) }}" data-turbo-frame="modal" class="btn btn--sm tooltip-edit">@icon('tabler-edit')</a>
                    </div>
                    <div class="p-sm" style="flex: 3">{{ $entry->platform->name }}</div>
                    <div class="p-sm text-center" style="flex: 1">{{ $entry->score ? $entry->score : '-' }}</div>
                    <div class="p-sm text-center" style="flex: 1">{{ $entry->hours ? $entry->hours : '-' }}</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="placeholder">
            @icon('tabler-device-gamepad', ['class' => 'placeholder__icon'])
            <h4>No Games</h4>
        </div>
    @endif

</x-users.library>