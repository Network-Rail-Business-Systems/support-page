<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailTask;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Tasks\SupportDetailTask;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class KeyTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'details',
            SupportDetailTask::key(),
        );
    }
}
