<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\TargetQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TargetRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class ApplySaveTest extends TestCase
{
    protected TargetQuestion $question;

    protected SupportDetail $subject;

    protected SupportDetailForm $form;

    protected TargetRequest $request;

    protected TypeQuestion $type;

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

        $this->assertEquals('admin', $this->subject->target);
    }

    protected function runStore(bool $isRole = false): void
    {
        $this->request = new TargetRequest([
            'url' => 'www.chasethedayaway.com',
            'email' => 'danger@zone.co.uk',
            'role' => $isRole === true ? 'admin' : 'email',
        ]);

        $this->question->applySave($this->request);
    }
}
