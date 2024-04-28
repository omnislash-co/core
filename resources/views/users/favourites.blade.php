<x-waterhole::user-profile :user="$user" :title="$user->name.'\'s Favourites'">
    
    @if (count($favourites) > 0)
        <div class="row gap-sm wrap">
            @foreach ($favourites as $game)
                <div class="rounded overflow-hidden" style="width: 125px; box-shadow: var(--shadow-sm)">
                    <a href="{{ route('games.show', $game->slug) }}">
                        <img src="{{ Storage::url('games/icons/'.$game->icon) }}" class="img-link">
                        <ui-tooltip>{{ $game->title }}</ui-tooltip>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="placeholder">
            @icon('tabler-heart', ['class' => 'placeholder__icon'])
            <h4>No Favourites</h4>
        </div>
    @endif

</x-waterhole::user-profile>