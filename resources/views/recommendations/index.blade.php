<x-app-layout title="Recommendations">
    
    <div class="section container">
        <section class="stack gap-gutter">
            <div class="row justify-between">
                <h2>Recommendations</h2>
                <a class="btn bg-accent" href="{{ route('recommendations.create') }}">Create a Recommendation</a>
            </div>

            @if (count($recommendations)>0)
                <div class="game-cards grid gap-md">
                    @foreach ($recommendations as $recommendation)
                        <x-cards.recommendation :$recommendation />
                    @endforeach
                </div>
                {{ $recommendations->links() }}
            @else
                <div class="placeholder">
                    @icon('tabler-thumb-up', ['class' => 'placeholder__icon'])
                    <h4>No Recommendations</h4>
                </div>
            @endif

        </section>
    </div>

</x-app-layout>