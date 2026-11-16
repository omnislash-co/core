@props([
    'label', 
    'options', 
    'placeholder' => 'Select '.strtolower($label),
    'valueKey' => 'name',
    'contentKey' => 'name'
])

<div class="stack gap-sm">
    <label for="slim-select-{{ strtolower($label) }}" class="field__label">
        {{ $label }}
    </label>
    <select 
        multiple
        id="slim-select-{{ strtolower($label) }}" 
        name="filter[{{ strtolower($label) }}][]"  
        data-controller="slim-select" 
        data-slim-select-placeholder-value="{{ $placeholder }}">
        @foreach ($options as $option)
            <option
                value="{{ $option[$valueKey] }}" 
                @selected(request()->has('filter.'.strtolower($label)) ? in_array($option[$valueKey], request()->filter[strtolower($label)]) : "")>
                {{ $option[$contentKey] }}
            </option>
        @endforeach
    </select>
</div>