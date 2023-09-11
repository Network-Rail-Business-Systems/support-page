<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\Questions\TypeQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TypeRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use PHPUnit\Framework\TestCase;

class StoreTest extends TestCase
{
    protected TypeQuestion $question;

    protected SupportDetail $subject;

    protected TypeRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new TypeQuestion();
        $this->subject = new SupportDetail();
    }

    public function testSubjectHasType(): void
    {
        $this->runStore();

        $this->assertEquals(TypeQuestion::GUIDES_AND_RESOURCES, $this->subject->type);
    }

    protected function runStore(): void
    {
        $this->request = new TypeRequest([
            'type' => TypeQuestion::GUIDES_AND_RESOURCES,
        ]);

        $this->question->store($this->request, $this->subject, '');
    }
}
