<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions;

use AnthonyEdmonds\GovukLaravel\Forms\Question;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion as GovukQuestionHelper;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TargetRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

class TargetQuestion extends Question
{
    public static function key(): string
    {
        return 'target';
    }

    /**
     * @param  SupportDetail  $subject
     */
    public function getQuestion(Model $subject): GovukQuestion|array
    {
        if ($subject->type === TypeQuestion::SYSTEM_QUESTIONS) {
            $isEmail = str_contains($subject->target, '@');

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
                        'value' => $isEmail === true ? $subject->target : null,
                    ],
                ],
            ];

            return GovukQuestionHelper::radios(
                'Who would you like to send system enquiries to?',
                'role',
                $roles
            )->hint('Select a system role or provide an email address')
                ->value($isEmail === true ? 'email' : $subject->target);

        } else {
            return GovukQuestionHelper::input(
                $subject->type === TypeQuestion::GUIDES_AND_RESOURCES
                    ? 'What is the link to the guide or resource?'
                    : 'What is the link to the enquiry form?',
                'url',
            )->hint('Make sure the link is accessible to anyone in Network Rail.')
                ->value($subject->target);
        }
    }

    /**
     * @param  SupportDetail  $subject
     */
    public function store(Request $request, Model $subject, string $mode): void
    {
        if ($subject->type === TypeQuestion::SYSTEM_QUESTIONS) {
            $subject->target = $request->role === 'email'
                ? $request->email
                : $request->role;
        } else {
            $subject->target = $request->url;
        }
    }

    protected function getFormRequest(): FormRequest
    {
        return new TargetRequest();
    }
}
