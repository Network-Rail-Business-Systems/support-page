<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

/** @property SupportDetail $model */
class UrlRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'target' => [
                'required',
                'string',
                'url',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'target.*' => 'Provide a valid URL starting with "https://".',
        ];
    }
}
