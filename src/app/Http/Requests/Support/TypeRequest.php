<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;

class TypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            TypeQuestion::key() => [
                'required',
                Rule::in(
                    array_keys(TypeQuestion::OPTIONS)
                ),
            ],
        ];
    }
}
