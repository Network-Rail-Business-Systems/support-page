<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions;

use AnthonyEdmonds\GovukLaravel\Forms\Question;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion as GovukQuestionHelper;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\LabelRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

class LabelQuestion extends Question
{
    public static function key(): string
    {
        return 'label';
    }

    /**
     * @param  SupportDetail  $subject
     */
    public function getQuestion(Model $subject): GovukQuestion|array
    {
        return GovukQuestionHelper::input(
            'What is the label for this Support Detail?',
            self::key(),
        );
    }

    /**
     * @param  SupportDetail  $subject
     */
    public function store(Request $request, Model $subject, string $mode): void
    {
        $subject->label = $request->label;
    }

    protected function getFormRequest(): FormRequest
    {
        return new LabelRequest();
    }
}
