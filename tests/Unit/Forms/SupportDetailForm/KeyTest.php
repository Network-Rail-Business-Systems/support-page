<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\SupportDetailForm;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use TestCase;

class KeyTest extends TestCase
{
    public function testReturnsKey(): void
    {
        $this->assertEquals(
            'support-detail',
            SupportDetailForm::key(),
        );
    }
}
