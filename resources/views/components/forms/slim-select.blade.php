@props([
    'label',
    'name',
    'options',
    'placeholder' => 'Select '.strtolower($label),
    'valueKey' => 'name',
    'contentKey' => 'name'
])

<div class="stack gap-sm">
	<label for="slim-select-{{ strtolower($name) }}" class="field__label">
		{{ $label }}
	</label>
    <select 
    	id="slim-select-{{ strtolower($name) }}" 
    	name="{{ strtolower($name) }}"  
    	data-controller="slim-select" 
    	data-slim-select-placeholder-value="{{ $placeholder }}">
        @foreach ($options as $option)
            <option
            	value="{{ $option[$valueKey] }}" 
                @selected($option[$valueKey] == old(strtolower($name),request(strtolower($name))))>
                {{ $option[$contentKey] }}
            </option>
        @endforeach
    </select>
    <div class="text-xs color-danger">@error(strtolower($name)) {{ $message }} @enderror</div>
</div>