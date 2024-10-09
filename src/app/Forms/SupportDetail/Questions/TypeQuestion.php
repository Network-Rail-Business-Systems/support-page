<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions;

use AnthonyEdmonds\GovukLaravel\Forms\Question;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion as GovukQuestionHelper;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TypeRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

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

    /**
     * @param  SupportDetail  $subject
     */
    public function getQuestion(Model $subject): GovukQuestion|array
    {
        return GovukQuestionHelper::radios(
            'Which type of Support Detail is this?',
            self::key(),
            self::OPTIONS,
        )->value($subject);
    }

    /**
     * @param  SupportDetail  $subject
     */
    public function store(Request $request, Model $subject, string $mode): void
    {
        if ($subject->type !== $request->type) {
            $subject->target = null;
            $subject->type = $request->type;
        }
    }

    /**
     * @codeCoverageIgnore
     */
    protected function getFormRequest(): FormRequest
    {
        return new TypeRequest();
    }
}
