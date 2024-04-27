<x-waterhole::user-profile :user="$user" :title="$user->name.'\'s Recommendations'">
    
    @if (count($recommendations) > 0)
        <div class="grid gap-sm" style="--grid-min: 35ch;">
            @foreach ($recommendations as $recommendation)
                <x-cards.recommendation-simple :$recommendation />
            @endforeach
        </div>
        {{ $recommendations->links() }}
    @else
        <div class="placeholder">
            @icon('tabler-thumb-up', ['class' => 'placeholder__icon'])
            <h4>No Recommendations</h4>
        </div>
    @endif

</x-waterhole::user-profile>