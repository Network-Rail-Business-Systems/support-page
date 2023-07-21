<?php

namespace App\Http\Requests\Support;

use Networkrailbusinesssystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use Illuminate\Foundation\Http\FormRequest;

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
