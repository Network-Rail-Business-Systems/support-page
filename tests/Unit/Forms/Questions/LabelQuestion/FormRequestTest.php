<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\LabelQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\LabelRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class FormRequestTest extends TestCase
{
    protected LabelQuestion $question;

    protected LabelRequest $request;

    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm(
            new SupportDetail(),
        );

        $this->question = $this->form
            ->tasks()
            ->task('details')
            ->question('label');
    }

    public function test(): void
    {
        $this->assertEquals(
            LabelRequest::class,
            $this->question->formRequest(),
        );
    }
}
