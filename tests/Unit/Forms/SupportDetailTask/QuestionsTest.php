<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailTask;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\UrlQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Tasks\SupportDetailTask;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class QuestionsTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected SupportDetailForm $form;

    protected SupportDetailTask $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
        $this->form = new SupportDetailForm($this->supportDetail);

        $this->task = $this->form->tasks()->task('details');
    }

    public function testWhenSystem(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;

        $this->assertEquals(
            [
                LabelQuestion::class,
                TypeQuestion::class,
                TargetQuestion::class,
            ],
            $this->task->questions(),
        );
    }

    public function testOtherwise(): void
    {
        $this->supportDetail->type = TypeQuestion::TECHNICAL_ISSUES;

        $this->assertEquals(
            [
                LabelQuestion::class,
                TypeQuestion::class,
                UrlQuestion::class,
            ],
            $this->task->questions(),
        );
    }
}
