<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TargetQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class IsNotRequiredTest extends TestCase
{
    protected TargetQuestion $question;

    protected SupportDetail $supportDetail;

    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;

        $this->form = new SupportDetailForm($this->supportDetail);
        $this->question = $this->form
            ->tasks()
            ->task('details')
            ->question('target');
    }

    public function testFalseWhenSystem(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;

        $this->assertFalse(
            $this->question->isNotRequired(),
        );
    }

    public function testTrueOtherwise(): void
    {
        $this->supportDetail->type = TypeQuestion::TECHNICAL_ISSUES;

        $this->assertTrue(
            $this->question->isNotRequired(),
        );
    }
}
