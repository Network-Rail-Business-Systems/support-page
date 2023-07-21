<?php

namespace App\Http\Requests\Support;

use App\Forms\SupportDetail\Questions\TypeQuestion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
