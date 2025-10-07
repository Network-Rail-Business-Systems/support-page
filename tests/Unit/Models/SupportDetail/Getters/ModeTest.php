<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\Getters;

use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class ModeTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
    }

    public function testWhenNull(): void
    {
        $this->supportDetail->target = null;

        $this->assertEquals(
            '',
            $this->supportDetail->mode,
        );
    }

    public function testWhenEmail(): void
    {
        $this->supportDetail->target = 'a@b.com';

        $this->assertEquals(
            'email',
            $this->supportDetail->mode,
        );
    }

    public function testOtherwise(): void
    {
        $this->supportDetail->target = 'banana';

        $this->assertEquals(
            'role',
            $this->supportDetail->mode,
        );
    }
}
