<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\LabelQuestion;

use NetworkRailBusinessSystems\SupportPage\Tests\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class KeyTest extends TestCase
{
    public function testReturnsKey(): void
    {
        $this->assertEquals('label', LabelQuestion::key());
    }
}
