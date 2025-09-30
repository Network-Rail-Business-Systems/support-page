<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\UsesForm;

use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class SaveAndSubmitTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = SupportDetail::factory()->make();
    }

    public function testFlashesWhenNew(): void
    {
        $this->supportDetail->saveAndSubmit();

        $this->assertFlashed(
            "Support detail #{$this->supportDetail->id} created",
            'success',
        );
    }

    public function testFlashesWhenEdit(): void
    {
        $this->supportDetail->save();
        $this->supportDetail = SupportDetail::find(1);

        $this->supportDetail->saveAndSubmit();

        $this->assertFlashed(
            "Support detail #{$this->supportDetail->id} updated",
            'success',
        );
    }
}
