<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\LabelQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\LabelRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class StoreTest extends TestCase
{
    protected LabelQuestion $question;

    protected SupportDetail $subject;

    protected LabelRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new LabelQuestion();
        $this->subject = new SupportDetail();
    }

    public function testSubjectHasLabel(): void
    {
        $this->runStore();

        $this->assertEquals('Broad City', $this->subject->label);
    }

    protected function runStore(): void
    {
        $this->request = new LabelRequest([
            'label' => 'Broad City',
        ]);

        $this->question->store($this->request, $this->subject, '');
    }
}
