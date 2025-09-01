@props(['game'])

<form action="{{ route('games.toggleFavorite', $game) }}" method="POST">
    @csrf
    <button class="btn bg-danger btn--narrow" type="submit">
        @if ( $game->hasUserFavorited() )
            @icon('tabler-heart-filled')
        @else
            @icon('tabler-heart')    
        @endif
    </button>
</form>
