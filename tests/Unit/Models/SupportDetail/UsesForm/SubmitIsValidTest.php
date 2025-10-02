<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\UsesForm;

use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class SubmitIsValidTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
    }

    public function testTrueWhenOk(): void
    {
        $this->supportDetail->target = 'Potato';

        $this->assertTrue(
            $this->supportDetail->submitIsValid(),
        );
    }

    public function testStringWhenNoTarget(): void
    {
        $this->assertEquals(
            'You must provide a target for this support detail',
            $this->supportDetail->submitIsValid(),
        );
    }
}
