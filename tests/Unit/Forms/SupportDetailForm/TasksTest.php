<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailForm;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailTasks;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class TasksTest extends TestCase
{
    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm(
            new SupportDetail(),
        );
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            SupportDetailTasks::class,
            $this->form->tasks(),
        );
    }
}
