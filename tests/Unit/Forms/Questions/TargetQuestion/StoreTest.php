<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\Questions\TargetQuestion;

use App\Console\Commands\UpdatePermissions;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TargetRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use TestCase;

class StoreTest extends TestCase
{
    protected TargetQuestion $question;

    protected SupportDetail $subject;

    protected TargetRequest $request;

    protected TypeQuestion $type;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new TargetQuestion();
        $this->subject = new SupportDetail();
        $this->type = new TypeQuestion();
        $this->subject->type = TypeQuestion::SYSTEM_QUESTIONS;
    }

    public function testSubjectHasTargetUrl(): void
    {
        $this->subject->type = TypeQuestion::GUIDES_AND_RESOURCES;
        $this->runStore();

        $this->assertEquals('www.chasethedayaway.com', $this->subject->target);
    }

    public function testSubjectHasTargetEmail(): void
    {
        $this->runStore();

        $this->assertEquals('danger@zone.co.uk', $this->subject->target);
    }

    public function testSubjectHasTargetRole(): void
    {
        $this->runStore(true);

        $this->assertEquals(UpdatePermissions::ADMIN, $this->subject->target);
    }

    protected function runStore(bool $isRole = false): void
    {
        $this->request = new TargetRequest([
            'url' => 'www.chasethedayaway.com',
            'email' => 'danger@zone.co.uk',
            'role' => $isRole === true ? UpdatePermissions::ADMIN : 'email',
        ]);

        $this->question->store($this->request, $this->subject, '');
    }
}
