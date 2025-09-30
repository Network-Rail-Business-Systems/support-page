<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailTask;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Tasks\SupportDetailTask;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class QuestionsTest extends TestCase
{
    protected SupportDetailForm $form;

    protected SupportDetailTask $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm(
            new SupportDetail(),
        );

        $this->task = $this->form->tasks()->task('details');
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                TypeQuestion::class,
                LabelQuestion::class,
                TargetQuestion::class,
            ],
            $this->task->questions(),
        );
    }
}
