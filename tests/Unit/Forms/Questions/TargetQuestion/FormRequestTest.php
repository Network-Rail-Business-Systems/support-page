<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TargetQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TargetRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class FormRequestTest extends TestCase
{
    protected TargetQuestion $question;

    protected SupportDetail $subject;

    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new SupportDetail();
        $this->subject->type = TypeQuestion::SYSTEM_QUESTIONS;

        $this->form = new SupportDetailForm($this->subject);

        $this->question = $this->form->tasks()
            ->task('details')
            ->question('target');
    }

    public function test(): void
    {
        $this->assertEquals(
            TargetRequest::class,
            $this->question->formRequest(),
        );
    }
}
