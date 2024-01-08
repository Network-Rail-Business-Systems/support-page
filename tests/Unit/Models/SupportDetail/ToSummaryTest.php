<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;
use Spatie\Permission\Models\Role;

class ToSummaryTest extends TestCase
{
    protected Role $role;

    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->role = $this->makeRole('Admin');

        $this->supportDetail = new SupportDetail();
    }

    public function testToSummaryWhenRole(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;
        $this->supportDetail->target = '1';

        $this->assertEquals(
            Role::find($this->supportDetail->target)->name,
            $this->supportDetail->toSummary()['Role']['value']
        );
    }

    public function testToSummaryWhenNotRole(): void
    {
        $this->supportDetail->type = TypeQuestion::GUIDES_AND_RESOURCES;
        $this->supportDetail->target = 'www.google.com';
        $summary = $this->supportDetail->toSummary();

        $this->assertArrayHasKey('Type', $summary);
        $this->assertArrayHasKey('Label', $summary);

        $this->assertEquals(
            $this->supportDetail->target,
            $this->supportDetail->toSummary()['URL']['value']
        );
    }
}
