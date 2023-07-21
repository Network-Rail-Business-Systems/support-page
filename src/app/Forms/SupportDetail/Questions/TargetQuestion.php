<?php

namespace Networkrailbusinesssystems\SupportPage\Forms\SupportDetail\Questions;

use AnthonyEdmonds\GovukLaravel\Forms\Question;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion as GovukQuestionHelper;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use Networkrailbusinesssystems\SupportPage\Http\Requests\Support\TargetRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Networkrailbusinesssystems\SupportPage\Models\SupportDetail;
use Spatie\Permission\Models\Role;

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

            $roles = Role::pluck('name', 'id')->toArray();

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
                    ],
                ],
            ];

            return GovukQuestionHelper::radios(
                'Who would you like to send system enquiries to?',
                'role',
                $roles
            )->hint('Select a system role or provide an email address')
                ->value($subject);

        } else {
            return GovukQuestionHelper::input(
                $subject->type === TypeQuestion::GUIDES_AND_RESOURCES
                    ? 'What is the link to the guide or resource?'
                    : 'What is the link to the enquiry form?',
                'url',
            )->hint('Make sure the link is accessible to anyone in Network Rail.')
                ->value($subject);
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
