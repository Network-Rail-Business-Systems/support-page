<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;

class LabelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            LabelQuestion::key() => [
                'required',
                'string',
            ],
        ];
    }
}
