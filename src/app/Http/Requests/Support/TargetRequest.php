<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

/** @property SupportDetail $model */
class TargetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mode' => [
                'required',
                'string',
                Rule::in([
                    'email',
                    'role',
                ]),
            ],
            'email' => [
                'exclude_unless:mode,email',
                'required',
                'string',
                'email',
            ],
            'role' => [
                'exclude_unless:mode,role',
                'required',
                'string',
                'exists:roles,name',
            ],
        ];
    }
}
