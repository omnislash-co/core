<x-app-layout title="Reviews">
    
    <div class="section container">
        <section class="stack gap-gutter">
            <div class="row justify-between">
                <h2>Reviews</h2>
                <a class="btn bg-accent" href="{{ route('reviews.create') }}">Create a Review</a>
            </div>

            @if (count($reviews)>0)
                <div class="game-cards grid gap-sm">
                    @foreach ($reviews as $review)
                        <x-cards.review-game-img :$review />
                    @endforeach
                </div>
                {{ $reviews->links() }}
            @else
                <div class="placeholder">
                    @icon('tabler-note', ['class' => 'placeholder__icon'])
                    <h4>No Reviews</h4>
                </div>
            @endif

        </section>
    </div>

</x-app-layout>