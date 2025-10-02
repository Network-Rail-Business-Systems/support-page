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

    public function testEmail(): void
    {
        $this->request = new TargetRequest([
            'email' => 'a@b.com',
            'mode' => 'email',
        ]);

        $this->question->applySave($this->request);

        $this->assertEquals('a@b.com', $this->subject->target);
    }

    public function testRole(): void
    {
        $this->request = new TargetRequest([
            'mode' => 'role',
            'role' => 'Admin',
        ]);

        $this->question->applySave($this->request);

        $this->assertEquals('Admin', $this->subject->target);
    }
}
