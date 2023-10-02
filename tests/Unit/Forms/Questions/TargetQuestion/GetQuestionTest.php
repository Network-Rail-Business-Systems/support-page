<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TargetQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class GetQuestionTest extends TestCase
{
    protected SupportDetail $subject;

    protected TargetQuestion $question;

    protected TypeQuestion $type;

    protected array $roles;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new TargetQuestion();
        $this->subject = new SupportDetail();
        $this->type = new TypeQuestion();
        $this->subject->type = TypeQuestion::SYSTEM_QUESTIONS;
    }

    public function testHasSystemQuestionLabel(): void
    {
        $this->assertEquals(
            'Who would you like to send system enquiries to?',
            $this->question->getQuestion($this->subject)->label,
        );
    }

    public function testHasSystemQuestionEmailLabel(): void
    {
        $this->assertEquals(
            'Use an email address',
            $this->question->getQuestion($this->subject)->options['email']['label'],
        );
    }

    public function testHasSystemQuestionEmailInputLabel(): void
    {
        $this->assertEquals(
            'Which email address would you like to use?',
            $this->question->getQuestion($this->subject)->options['email']['inputs'][0]['label'],
        );
    }

    public function testHasSystemQuestionEmailKey(): void
    {
        $this->assertEquals(
            'email',
            $this->question->getQuestion($this->subject)->options['email']['inputs'][0]['name'],
        );
    }

    public function testHasSystemsQuestionEmailHint(): void
    {
        $this->assertEquals(
            'Enter an email address including @networkrail.co.uk',
            $this->question->getQuestion($this->subject)->options['email']['inputs'][0]['hint'],
        );
    }

    public function testHasSystemQuestionKey(): void
    {
        $this->assertEquals(
            'role',
            $this->question->getQuestion($this->subject)->name,
        );
    }

    public function testHasSystemQuestionOptions(): void
    {
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

        $this->assertEquals(
            $roles,
            $this->question->getQuestion($this->subject)->options,
        );
    }

    public function testHasSystemQuestionHint(): void
    {
        $this->assertEquals(
            'Select a system role or provide an email address',
            $this->question->getQuestion($this->subject)->hint,
        );
    }

    public function testHasSystemQuestionValue(): void
    {
        $this->assertEquals(
            $this->subject,
            $this->question->getQuestion($this->subject)->value,
        );
    }

    public function testHasGuidesLabel(): void
    {
        $this->subject->type = TypeQuestion::GUIDES_AND_RESOURCES;

        $this->assertEquals(
            'What is the link to the guide or resource?',
            $this->question->getQuestion($this->subject)->label,
        );
    }

    public function testHasTechLabel(): void
    {
        $this->subject->type = TypeQuestion::TECHNICAL_ISSUES;

        $this->assertEquals(
            'What is the link to the enquiry form?',
            $this->question->getQuestion($this->subject)->label,
        );
    }

    public function testHasGuidesKey(): void
    {
        $this->subject->type = TypeQuestion::GUIDES_AND_RESOURCES;

        $this->assertEquals(
            'url',
            $this->question->getQuestion($this->subject)->name,
        );
    }

    public function testHasTechKey(): void
    {
        $this->subject->type = TypeQuestion::TECHNICAL_ISSUES;

        $this->assertEquals(
            'url',
            $this->question->getQuestion($this->subject)->name,
        );
    }

    public function testHasGuidesHint(): void
    {
        $this->subject->type = TypeQuestion::GUIDES_AND_RESOURCES;

        $this->assertEquals(
            'Make sure the link is accessible to anyone in Network Rail.',
            $this->question->getQuestion($this->subject)->hint,
        );
    }

    public function testHasGuidesValue(): void
    {
        $this->subject->type = TypeQuestion::GUIDES_AND_RESOURCES;

        $this->assertEquals(
            $this->subject,
            $this->question->getQuestion($this->subject)->value,
        );
    }

    public function testHasTechValue(): void
    {
        $this->subject->type = TypeQuestion::TECHNICAL_ISSUES;

        $this->assertEquals(
            $this->subject,
            $this->question->getQuestion($this->subject)->value,
        );
    }
}
