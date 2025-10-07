<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\UrlQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\UrlQuestion;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class KeyTest extends TestCase
{
    public function testReturnsKey(): void
    {
        $this->assertEquals('url', UrlQuestion::key());
    }
}
