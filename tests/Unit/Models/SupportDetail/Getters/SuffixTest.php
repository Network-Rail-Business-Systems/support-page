<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\Getters;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class SuffixTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
    }

    public function testWhenSystem(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;

        $this->assertEquals(
            '(draft a new e-mail)',
            $this->supportDetail->suffix,
        );
    }

    public function testOtherwise(): void
    {
        $this->supportDetail->type = TypeQuestion::TECHNICAL_ISSUES;

        $this->assertEquals(
            '(opens in a new tab)',
            $this->supportDetail->suffix,
        );
    }
}
