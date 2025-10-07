<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailTasks;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailTasks;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Tasks\SupportDetailTask;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class TasksTest extends TestCase
{
    protected SupportDetailTasks $tasks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tasks = new SupportDetailTasks(
            new SupportDetailForm(
                new SupportDetail(),
            ),
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                SupportDetailTask::class,
            ],
            $this->tasks->tasks(),
        );
    }
}
