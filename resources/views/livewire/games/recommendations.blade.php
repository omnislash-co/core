<div class="stack gap-md">

    @if (count($this->recommendations)>0)
        <div class="grid gap-sm" style="--grid-min: 35ch;">
            @foreach ($this->recommendations as $recommendation)
                <x-cards.recommendation-simple :$recommendation />
            @endforeach
        </div>
        {{ $this->recommendations->links('components.pagination') }}
    @else
        <div class="placeholder">
            @icon('tabler-thumb-up', ['class' => 'placeholder__icon'])
            <p>Be the first to make a recommendation!</p>
            <a class="btn" href="{{ route('recommendations.create') }}">Create a Recommendation</a>
        </div>
    @endif

</div>
