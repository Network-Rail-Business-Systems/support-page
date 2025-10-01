<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\UrlRequest;

/** @property SupportDetailForm $form */
class UrlQuestion extends Question
{
    public static function key(): string
    {
        return 'url';
    }

    public function fields(): array
    {
        return [
            Field::input(
                'url',
                $this->form->model->type === TypeQuestion::GUIDES_AND_RESOURCES
                    ? 'What is the link to the guide or resource?'
                    : 'What is the link to the enquiry form?',
            )
                ->setHint('Make sure the link is accessible to anyone in Network Rail.'),
        ];
    }

    public function formRequest(): string
    {
        return UrlRequest::class;
    }

    public function isNotRequired(): bool
    {
        return $this->form->model->type !== TypeQuestion::SYSTEM_QUESTIONS;
    }

    public function cannotStart(): bool
    {
        return $this->form->model->type === null;
    }
}
