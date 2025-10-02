<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
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
        $options = [
            'role' => [
                'label' => 'Use a system role',
                'inputs' => [
                    [
                        'label' => 'Which role would you like to send requests to?',
                        'name' => 'role',
                        'options' => config('support-page.role_model')::query()
                            ->whereNotIn('name', config('support-page.excluded_roles'))
                            ->pluck('name', 'name')
                            ->toArray(),
                        'type' => InputType::Select,
                        'value' => $this->form->model->target,
                    ],
                ],
            ],
            'divider' => [
                'divider' => true,
                'label' => 'or',
            ],
            'email' => [
                'label' => 'Use an email address',
                'inputs' => [
                    [
                        'label' => 'Which email address would you like to use?',
                        'name' => 'email',
                        'hint' => 'Enter an email address including @networkrail.co.uk',
                        'value' => $this->form->model->target,
                        'width' => 20,
                    ],
                ],
            ],
        ];

        return [
            Field::radios(
                'mode',
                'Who would you like to send system enquiries to?',
                $options,
            )
                ->setDisplayName('Target')
                ->setHint('Select a system role or provide an email address'),
        ];
    }

    public function validationData(): array
    {
        return [
            'email' => $this->form->model->target,
            'role' => $this->form->model->target,
            'mode' => $this->form->model->mode,
        ];
    }

    public function getFormattedAnswer(string $fieldKey): string
    {
        return $this->form->model->target ?? $this->blankAnswerLabel($fieldKey);
    }

    public function formRequest(): string
    {
        return TargetRequest::class;
    }

    public function applySave(FormRequest $formRequest): void
    {
        $this->form->model->target = $formRequest->get('mode') === 'email'
            ? $formRequest->get('email')
            : $formRequest->get('role');
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
