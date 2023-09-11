<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\Questions\TargetQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use PHPUnit\Framework\TestCase;

class KeyTest extends TestCase
{
    public function testReturnsKey(): void
    {
        $this->assertEquals('target', TargetQuestion::key());
    }
}
