<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\Questions\LabelQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use PHPUnit\Framework\TestCase;

class GetQuestionTest extends TestCase
{
    protected SupportDetail $subject;

    protected LabelQuestion $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new LabelQuestion();
        $this->subject = new SupportDetail();
    }

    public function testHasLabel(): void
    {
        $this->assertEquals(
            'What is the label for this Support Detail?',
            $this->question->getQuestion($this->subject)->label,
        );
    }

    public function testHasKey(): void
    {
        $this->assertEquals(
            LabelQuestion::key(),
            $this->question->getQuestion($this->subject)->name,
        );
    }
}
