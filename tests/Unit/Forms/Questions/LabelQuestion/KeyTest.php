<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\Questions\LabelQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use TestCase;
use Tests\;

class KeyTest extends TestCase
{
    public function testReturnsKey(): void
    {
        $this->assertEquals('label', LabelQuestion::key());
    }
}
