<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\LabelQuestion;

use NetworkRailBusinessSystems\SupportPage\Tests\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Tests\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

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
