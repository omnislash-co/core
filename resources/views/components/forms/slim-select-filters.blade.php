@props(['label', 'options', 'placeholder' => 'Select '.strtolower($label)])

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
            	value="{{ $option->name }}" 
                @selected(request()->has('filter.'.strtolower($label)) ? in_array($option->name, request()->filter[strtolower($label)]) : "")>
                {{ $option->name }}
            </option>
        @endforeach
    </select>
</div>