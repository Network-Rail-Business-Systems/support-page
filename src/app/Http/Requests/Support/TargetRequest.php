<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;

class TargetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->subject->type === TypeQuestion::SYSTEM_QUESTIONS
            ? [
                'email' => [
                    'exclude_unless:role,email',
                    'required',
                    'string',
                    'email',
                ],
                'role' => [
                    'exclude_if:role,email',
                    'required',
                    'integer',
                    'exists:roles,id',
                ],
            ]
            : [
                'url' => [
                    'required',
                    'string',
                    'url',
                ],
            ];
    }
}
