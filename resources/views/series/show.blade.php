<x-app-layout title="{{ $series->name }} Series">

    <div class="section container">
        <section class="stack gap-gutter">
            <h2>{{ $series->name }} Series</h2>

            @if ($games->count() > 0)
                <div class="game-cards grid gap-md">
                    @foreach ($games as $game)
                        <x-cards.game :$game />
                    @endforeach
                </div>
                <div style="margin-top: var(--space-md)">
                    {{ $games->links() }}
                </div>
            @else
                <div class="alert bg-warning-soft">
                    No games found.
                </div>
            @endif

        </section>
    </div>

</x-app-layout>