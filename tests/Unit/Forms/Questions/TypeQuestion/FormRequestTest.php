<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TypeQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TypeRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class FormRequestTest extends TestCase
{
    protected TypeQuestion $question;

    protected SupportDetailForm $form;

    protected SupportDetail $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new SupportDetail();
        $this->form = new SupportDetailForm($this->subject);
        $this->question = $this->form->tasks()
            ->task('details')
            ->question('type');
    }

    public function test(): void
    {
        $this->assertEquals(
            TypeRequest::class,
            $this->question->formRequest(),
        );
    }
}
