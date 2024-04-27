<button class="btn bg-danger btn--narrow" wire:click="toggle" wire:loading.attr="disabled">
    @if ($status)
        @icon('tabler-heart-filled')
    @else
        @icon('tabler-heart')    
    @endif
</button>