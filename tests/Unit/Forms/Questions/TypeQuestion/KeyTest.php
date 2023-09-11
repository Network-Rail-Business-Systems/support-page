<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\Questions\TypeQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use PHPUnit\Framework\TestCase;

class KeyTest extends TestCase
{
    public function testReturnsKey(): void
    {
        $this->assertEquals('type', TypeQuestion::key());
    }
}
