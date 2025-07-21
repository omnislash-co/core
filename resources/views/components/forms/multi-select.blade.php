@props(['label', 'options'])

<div class="stack gap-sm" data-controller="multi-select" data-multi-select-hidden-class="hidden" data-multi-select-active-class="is-active">
    <div style="position: relative">
        <x-waterhole::field
            :name="strtolower($label)"
            :label="$label"
        >
            <div class="input-container">
                @icon('tabler-search', ['class' => 'no-pointer'])
                <input type="text" data-action="focus->multi-select#showMenu blur->multi-select#hideMenu input->multi-select#search">
            </div>        
        </x-waterhole::field>

        <div class="menu filters-menu hidden" data-multi-select-target="menu">
            @forelse ($options as $option)
                <button 
                    @class([
                        'menu-item',
                        'full-width',
                        'is-active' => request()->has('filter.'.strtolower($label)) ? in_array($option->name, request()->filter[strtolower($label)]) : "",
                    ])
                    role="menuitem"
                    type="button"
                    data-multi-select-target="item"
                    data-action="multi-select#add">
                    {{ $option->name }}
                    @icon('tabler-check', ['class' => 'menu-item__check'])
                </button>
            @empty
                <div class="p-xs">No {{ strtolower($label) }} found.</div>
            @endforelse
        </div>

        <select class="hidden" name="filter[{{ strtolower($label) }}][]" multiple data-action="change->multi-select#onChange">
            @foreach ($options as $option)
                <option data-multi-select-target="option" value="{{ $option->name }}" 
                    @selected(request()->has('filter.'.strtolower($label)) ? in_array($option->name, request()->filter[strtolower($label)]) : "")
                    >
                    {{ $option->name }}
                </option>
            @endforeach
        </select>

    </div>

    @if (request()->has('filter.'.strtolower($label)))
        <div class="row wrap gap-xs">
            @foreach (request()->filter[strtolower($label)] as $item)
                <div class="badge bg-warning-soft" style="padding-right: 0">
                    {{ $item }}
                    <button class="btn btn--icon btn--transparent btn--sm" data-action="multi-select#remove">
                        @icon('tabler-x')
                    </button>
                </div>
            @endforeach
        </div>
    @endif    
</div>