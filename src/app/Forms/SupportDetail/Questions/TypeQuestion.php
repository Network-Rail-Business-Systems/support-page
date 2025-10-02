<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use Illuminate\Foundation\Http\FormRequest;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TypeRequest;

/** @property SupportDetailForm $form */
class TypeQuestion extends Question
{
    public const array OPTIONS = [
        self::GUIDES_AND_RESOURCES => 'Guides and resources',
        self::SYSTEM_QUESTIONS => 'Systems questions',
        self::TECHNICAL_ISSUES => 'Technical issues',
    ];

    public const array DESCRIPTIONS = [
        self::GUIDES_AND_RESOURCES => 'User guides and answers to common problems may be available.',
        self::SYSTEM_QUESTIONS => 'For general enquiries about this system you may contact the owners directly.',
        self::TECHNICAL_ISSUES => 'For technical support, such as errors and bugs, you may contact the Business Systems Support team.',
    ];

    public const string GUIDES_AND_RESOURCES = 'guides-and-resources';

    public const string SYSTEM_QUESTIONS = 'system-questions';

    public const string TECHNICAL_ISSUES = 'technical-issues';

    public static function key(): string
    {
        return 'type';
    }

    public function fields(): array
    {
        return [
            Field::radios(
                self::key(),
                'Which type of Support Detail is this?',
                self::OPTIONS,
            ),
        ];
    }

    public function formRequest(): string
    {
        return TypeRequest::class;
    }

    public function applySave(FormRequest $formRequest): void
    {
        $type = $formRequest->get('type');

        if ($this->form->model->type !== $type) {
            $this->form->model->type = $type;
            $this->form->model->target = null;
        }
    }
}
