<div class="stack gap-gutter">
    
    <div class="stack gap-sm">
        <div class="row gap-sm">
            <div class="input-container grow">
                @icon('tabler-search', ['class' => 'no-pointer'])
                <input type="text" placeholder="Search" wire:model.live.debounce="search">
            </div>
            <button class="btn btn--narrow bg-accent" disabled>
                @icon('tabler-filter')
            </button>
        </div>
    </div>

    @if (count($this->games)>0)
        <div class="game-cards grid gap-md">
            @foreach ($this->games as $game)
                <x-cards.game :$game />
            @endforeach
        </div>
        {{ $this->games->links() }}
    @else
        <div class="alert bg-warning-soft">
            No games found.
        </div>
    @endif

</div>