<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TypeQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class FieldsTest extends TestCase
{
    protected SupportDetail $subject;

    protected SupportDetailForm $form;

    protected TypeQuestion $question;

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
        $fields = $this->question->fields();

        $this->assertEquals(
            TypeQuestion::key(),
            $fields[0]->name,
        );

        $this->assertEquals(
            'Which type of Support Detail is this?',
            $fields[0]->label,
        );

        $this->assertEquals(
            TypeQuestion::OPTIONS,
            $fields[0]->options,
        );
    }
}
