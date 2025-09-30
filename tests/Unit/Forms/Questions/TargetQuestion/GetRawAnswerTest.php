<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TargetQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class GetRawAnswerTest extends TestCase
{
    protected TargetQuestion $question;

    protected SupportDetail $subject;

    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new SupportDetail();
        $this->subject->target = 'Potato';
        $this->subject->type = TypeQuestion::SYSTEM_QUESTIONS;

        $this->form = new SupportDetailForm($this->subject);

        $this->question = $this->form->tasks()
            ->task('details')
            ->question('target');
    }

    public function testReturnsEmail(): void
    {
        $this->subject->target = 'a@b.com';

        $this->assertEquals(
            'email',
            $this->question->getRawAnswer('role'),
        );
    }

    public function testReturnsTarget(): void
    {
        $this->assertEquals(
            $this->subject->target,
            $this->question->getRawAnswer('role'),
        );
    }

    public function testDefault(): void
    {
        $this->assertEquals(
            TypeQuestion::SYSTEM_QUESTIONS,
            $this->question->getRawAnswer('type'),
        );
    }
}
