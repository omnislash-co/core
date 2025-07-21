<x-games.show :$game>

    @if (count($recommendations)>0)
        <div class="grid gap-sm" style="--grid-min: 35ch;">
            @foreach ($recommendations as $recommendation)
                <x-cards.recommendation-simple :$recommendation />
            @endforeach
        </div>
        {{ $recommendations->links() }}
    @else
        <div class="placeholder">
            @icon('tabler-thumb-up', ['class' => 'placeholder__icon'])
            <p>Be the first to make a recommendation!</p>
            <a class="btn" href="{{ route('recommendations.create') }}">Create a Recommendation</a>
        </div>
    @endif

</x-games.show>