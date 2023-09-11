<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TypeQuestion;

use NetworkRailBusinessSystems\SupportPage\Tests\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Tests\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class GetQuestionTest extends TestCase
{
    protected SupportDetail $subject;

    protected TypeQuestion $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new TypeQuestion();
        $this->subject = new SupportDetail();
    }

    public function testHasLabel(): void
    {
        $this->assertEquals(
            'Which type of Support Detail is this?',
            $this->question->getQuestion($this->subject)->label,
        );
    }

    public function testHasKey(): void
    {
        $this->assertEquals(
            TypeQuestion::key(),
            $this->question->getQuestion($this->subject)->name,
        );
    }

    public function testHasOptions(): void
    {
        $this->assertEquals(
            TypeQuestion::OPTIONS,
            $this->question->getQuestion($this->subject)->options,
        );
    }

    public function testHasValue(): void
    {
        $this->assertEquals(
            $this->subject,
            $this->question->getQuestion($this->subject)->value,
        );
    }
}
