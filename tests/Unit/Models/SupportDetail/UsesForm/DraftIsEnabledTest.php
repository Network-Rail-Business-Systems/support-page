<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\UsesForm;

use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class DraftIsEnabledTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
    }

    public function test(): void
    {
        $this->assertFalse(
            $this->supportDetail->draftIsEnabled(),
        );
    }
}
