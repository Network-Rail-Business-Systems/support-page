<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TypeQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TypeRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class ApplySaveTest extends TestCase
{
    protected TypeQuestion $question;

    protected SupportDetailForm $form;

    protected SupportDetail $subject;

    protected TypeRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new SupportDetail();
        $this->subject->target = 'Blah';

        $this->request = new TypeRequest([
            'type' => 'goose',
        ]);

        $this->form = new SupportDetailForm($this->subject);
        $this->question = $this->form->tasks()
            ->task('details')
            ->question('type');
    }

    public function testWhenTypeSame(): void
    {
        $this->subject->type = 'goose';
        $this->question->applySave($this->request);

        $this->assertEquals(
            'goose',
            $this->subject->type,
        );

        $this->assertEquals(
            'Blah',
            $this->subject->target,
        );
    }

    public function testWhenTypeDifferent(): void
    {
        $this->subject->type = 'wow';
        $this->question->applySave($this->request);

        $this->assertEquals(
            'goose',
            $this->subject->type,
        );

        $this->assertNull(
            $this->subject->target,
        );
    }
}
