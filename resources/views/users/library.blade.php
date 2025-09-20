<x-users.library :user="$user" :title="$user->name.'\'s Library'">

    @if (count($entries) > 0)
        <div class="card p-sm">
            <div class="table-container full-width overflow-visible" tabindex="0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Platform</th>
                            <th>Score</th>
                            <th>Hours Played</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entries->sortBy('game.title') as $entry)
                            <tr>
                                <td>
                                    <span class="tooltip-container">
                                        <img class="tooltip-content game-icon" src="{{ Storage::url('games/icons/'.$entry->game->icon) }}">
                                        <a href="{{ route('games.show', $entry->game->slug) }}">{{ $entry->game->title }}</a>
                                    </span>
                                </td>
                                <td>{{ $entry->platform->name }}</td>
                                <td>{{ $entry->score ? $entry->score : '-' }}</td>
                                <td>{{ $entry->hours ? $entry->hours : '-' }}</td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="placeholder">
            @icon('tabler-device-gamepad', ['class' => 'placeholder__icon'])
            <h4>No Games</h4>
        </div>
    @endif

</x-users.library>