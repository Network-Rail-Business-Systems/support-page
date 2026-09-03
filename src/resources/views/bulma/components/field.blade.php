@props([
    'field',
])

@use(AnthonyEdmonds\LaravelFormBuilder\Enums\InputType)

<div class="field">
    @if($field->isTitle === true)
        <h1 class="title is-4 mb-2">
    @endif

    <label for="{{ $field->id }}" class="label">
        {{ $field->label }}

        @if($field->optional === true)
            <span class="has-text-grey has-text-weight-normal">
                {{ $field->optionalLabel }}
            </span>
        @endif
    </label>

    @if($field->isTitle === true)
        </h1>
     @endif

    @empty($field->hint)
    @else
        <p class="help">
            {{ $field->hint }}
        </p>
    @endempty

    @error($field->name)
        <p class="help is-danger mb-2">
            {{ $message }}
        </p>
    @enderror

    <div class="control" style="max-width: 500px;">
        @switch($field->type)
            @case(InputType::Checkbox)
                <x-support-page::inputs.checkboxes :field="$field" />
                @break

            @case(InputType::Hidden)
                <x-support-page::inputs.hidden :field="$field" />
                @break

            @case(InputType::Radio)
                <x-support-page::inputs.radios :field="$field" />
                @break

            @case(InputType::Select)
                <x-support-page::inputs.select :field="$field" />
                @break

            @case(InputType::TextArea)
                <x-support-page::inputs.textarea :field="$field" />
                @break

            @default
                <x-support-page::inputs.input :field="$field" />
        @endswitch
    </div>
</div>
