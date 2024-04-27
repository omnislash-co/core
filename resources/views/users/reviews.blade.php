<x-waterhole::user-profile :user="$user" :title="$user->name.'\'s Reviews'">
    
    @if (count($reviews) > 0)
        <div class="grid gap-sm" style="--grid-min: 35ch;">
            @foreach ($reviews as $review)
                <x-cards.review-game-img-simple :$review />
            @endforeach
        </div>
        {{ $reviews->links() }}
    @else
        <div class="placeholder">
            @icon('tabler-note', ['class' => 'placeholder__icon'])
            <h4>No Reviews</h4>
        </div>
    @endif

</x-waterhole::user-profile>