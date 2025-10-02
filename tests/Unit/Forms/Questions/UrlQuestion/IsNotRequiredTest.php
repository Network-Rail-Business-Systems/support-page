<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\UrlQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\UrlQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class IsNotRequiredTest extends TestCase
{
    protected UrlQuestion $question;

    protected SupportDetail $supportDetail;

    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
        $this->form = new SupportDetailForm($this->supportDetail);
        $this->question = $this->form
            ->tasks()
            ->task('details')
            ->question('url');
    }

    public function testTrueWhenSystem(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;

        $this->assertTrue(
            $this->question->isNotRequired(),
        );
    }

    public function testFalseOtherwise(): void
    {
        $this->supportDetail->type = TypeQuestion::TECHNICAL_ISSUES;

        $this->assertFalse(
            $this->question->isNotRequired(),
        );
    }
}
