@props([
    'field',
])

@forelse($field->options as $label => $value)
    <label
        class="checkbox"
        for="{{ $field->id }}-{{ $loop->index }}"
    >
        <input
            @checked(in_array($value, (array) old($field->name, $field->value)))
            id="{{ $field->id }}-{{ $loop->index }}"
            name="{{ $field->name }}[]"
            type="checkbox"
            value="{{ $value }}"
        >

        {{ $label }}
    </label>
@empty
    <p class="help">
        {{ $field->noOptionsMessage }}
    </p>
@endforelse