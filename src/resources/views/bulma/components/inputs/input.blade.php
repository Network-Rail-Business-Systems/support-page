@props([
    'field',
])

<input
    id="{{ $field->id }}"
    name="{{ $field->name }}"
    type="{{ $field->type->value ?? 'text' }}"
    value="{{ old($field->name, $field->value ?? '') }}"
    class="input @error($field->name) is-danger @enderror"
>
