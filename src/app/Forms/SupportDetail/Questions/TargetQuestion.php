<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use Illuminate\Foundation\Http\FormRequest;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TargetRequest;

/** @property SupportDetailForm $form */
class TargetQuestion extends Question
{
    public static function key(): string
    {
        return 'target';
    }

    public function fields(): array
    {
        $fields = [];

        if ($this->form->model->type === TypeQuestion::SYSTEM_QUESTIONS) {
            $roles = config('support-page.role_model')::query()
                ->whereNotIn('name', config('support-page.excluded_roles'))
                ->pluck('name', 'id')->toArray();

            $roles['divider'] = [
                'divider' => true,
                'label' => 'or',
            ];

            $roles['email'] = [
                'label' => 'Use an email address',
                'inputs' => [
                    [
                        'label' => 'Which email address would you like to use?',
                        'name' => 'email',
                        'hint' => 'Enter an email address including @networkrail.co.uk',
                        'value' => $this->form->model->targetIsEmail() === true
                            ? $this->form->model->target
                            : null,
                    ],
                ],
            ];

            $fields[] = Field::radios(
                'role',
                'Who would you like to send system enquiries to?',
                $roles,
            )->setHint('Select a system role or provide an email address');

        } else {
            $fields[] = Field::input(
                'url',
                $this->form->model->type === TypeQuestion::GUIDES_AND_RESOURCES
                    ? 'What is the link to the guide or resource?'
                    : 'What is the link to the enquiry form?',
            )->setHint('Make sure the link is accessible to anyone in Network Rail.');
        }

        return $fields;
    }

    public function getAnswer(string $fieldName): int|string|float|bool|null
    {
        return match ($fieldName) {
            'role' => $this->form->model->targetIsEmail() === true
                ? 'email'
                : $this->form->model->target,
            default => parent::getAnswer($fieldName),
        };
    }

    public function formRequest(): string
    {
        return TargetRequest::class;
    }

    public function applySave(FormRequest $formRequest): void
    {
        if ($this->form->model->type === TypeQuestion::SYSTEM_QUESTIONS) {
            $this->form->model->target = $formRequest->get('role') === 'email'
                ? $formRequest->get('email')
                : $formRequest->get('role');
        } else {
            $this->form->model->target = $formRequest->get('url');
        }
    }
}
