<div class="stack gap-sm">
    <div style="position: relative">
        <x-waterhole::field
            :name="strtolower($label)"
            :label="$label"
        >
            <div class="input-container">
                @icon('tabler-search', ['class' => 'no-pointer'])
                <input type="text" name="search" 
                    wire:model.live.debounce="search" 
                    wire:focus="toggleOptions(true)" 
                    wire:blur="toggleOptions(false)">
            </div>        
        </x-waterhole::field>

        @if ($showOptions)
            <div class="menu filters-menu" wire:transition.in.origin.top>
                @forelse ($this->filtered as $option)
                    <button 
                        @class([
                            'menu-item',
                            'full-width',
                            'is-active' => $this->isSelected($option->id),
                        ])
                        role="menuitem"
                        wire:click="add({{$option->id}})">
                        {{ $option->name }}
                        @icon('tabler-check', ['class' => 'menu-item__check'])
                    </button>
                @empty
                    <div class="p-xs">No {{ strtolower($label) }} found.</div>
                @endforelse
            </div>
        @endif
    </div>

    @if (count($selected) > 0)
        <div class="row wrap gap-xs">
            @foreach ($selected as $id)
                <div class="badge bg-warning-soft" style="padding-right: 0">
                    {{ $this->getOptionName($id) }}
                    <button class="btn btn--icon btn--transparent btn--sm" wire:click="remove({{ $id }})">
                        @icon('tabler-x')
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>