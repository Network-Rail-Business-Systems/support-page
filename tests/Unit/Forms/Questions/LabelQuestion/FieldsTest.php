<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\LabelQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\LabelRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class FieldsTest extends TestCase
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
        $fields = $this->question->fields();

        $this->assertEquals(
            LabelQuestion::key(),
            $fields[0]->name,
        );

        $this->assertEquals(
            'What is the label for this Support Detail?',
            $fields[0]->label,
        );
    }
}
