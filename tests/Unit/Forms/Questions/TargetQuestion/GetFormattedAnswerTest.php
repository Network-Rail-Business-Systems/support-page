<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TargetQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class GetFormattedAnswerTest extends TestCase
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

    public function testWhenSet(): void
    {
        $this->supportDetail->target = 'a@b.com';

        $this->assertEquals(
            $this->supportDetail->target,
            $this->question->getFormattedAnswer('mode'),
        );
    }

    public function testWhenNull(): void
    {
        $this->supportDetail->target = null;

        $this->assertEquals(
            $this->question->blankAnswerLabel('mode'),
            $this->question->getFormattedAnswer('mode'),
        );
    }
}
