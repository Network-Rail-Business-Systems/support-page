<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\LabelRequest;

class LabelQuestion extends Question
{
    public static function key(): string
    {
        return 'label';
    }

    public function fields(): array
    {
        return [
            Field::input(
                self::key(),
                'What is the label for this Support Detail?',
            ),
        ];
    }

    public function formRequest(): string
    {
        return LabelRequest::class;
    }
}
