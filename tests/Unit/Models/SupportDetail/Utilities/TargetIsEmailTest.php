<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\Utilities;

use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class TargetIsEmailTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
    }

    public function testTrueWhenEmailAddress(): void
    {
        $this->supportDetail->target = 'potato@mail.com';

        $this->assertTrue(
            $this->supportDetail->targetIsEmail(),
        );

    }

    public function testFalseOtherwise(): void
    {
        $this->supportDetail->target = 'support.owners';

        $this->assertFalse(
            $this->supportDetail->targetIsEmail(),
        );
    }
}
