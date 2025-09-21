<x-users.library :user="$user" :title="$user->name.'\'s Library'">

    @if (count($entries) > 0)
        <div class="card p-sm library-list">
            <div class="row library-header">
                <div class="title">Title</div>
                <div class="platform">Platform</div>
                <div class="score">Score</div>
                <div class="hours">Hours</div>
            </div>
            @foreach ($entries->sortBy('game.title') as $entry)
                <div class="row align-center library-entry tooltip-container">
                    <img class="tooltip-icon game-icon" src="{{ Storage::url('games/icons/'.$entry->game->icon) }}">
                    <div class="title row justify-between">
                        <a href="{{ route('games.show', $entry->game->slug) }}">{{ $entry->game->title }}</a>
                        <a href="{{ route('library.edit', ['game' => $entry->game->slug, 'library' => $entry->id]) }}" data-turbo-frame="modal" class="btn btn--sm tooltip-edit">@icon('tabler-edit')</a>
                    </div>
                    <div class="platform">{{ $entry->platform->name }}</div>
                    <div class="score">{{ $entry->score ? $entry->score : '-' }}</div>
                    <div class="hours">{{ $entry->hours ? $entry->hours : '-' }}</div>
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