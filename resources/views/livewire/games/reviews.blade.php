<div class="stack gap-md">

    @if (count($this->reviews)>0)
        <div class="grid gap-sm" style="--grid-min: 35ch;">
            @foreach ($this->reviews as $review)
                <x-cards.review-user-img :$review />
            @endforeach
        </div>
        {{ $this->reviews->links('components.pagination') }}
    @else
        <div class="placeholder">
            @icon('tabler-note', ['class' => 'placeholder__icon'])
            <p>Be the first to review this game!</p>
            <a class="btn" href="{{ route('reviews.create') }}">Create a Review</a>
        </div>
    @endif

</div>
