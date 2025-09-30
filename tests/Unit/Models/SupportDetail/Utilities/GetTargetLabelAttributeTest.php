<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\Utilities;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class GetTargetLabelAttributeTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
    }

    public function testTargetLabelAttributeWhenEmailAddress(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;
        $this->supportDetail->target = 'stephen.oke@networkrail.co.uk';

        $this->assertEquals(
            'E-mail',
            $this->supportDetail->getTargetLabelAttribute(),
        );
    }

    public function testTargetLabelAttributeWhenRole(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;
        $this->supportDetail->target = '1';

        $this->assertEquals(
            'Role',
            $this->supportDetail->getTargetLabelAttribute(),
        );
    }

    public function testTargetLabelAttributeWhenNotEmailAddressOrRole(): void
    {
        $this->supportDetail->type = TypeQuestion::TECHNICAL_ISSUES;
        $this->supportDetail->target = 'www.bing.com';

        $this->assertEquals(
            'URL',
            $this->supportDetail->getTargetLabelAttribute(),
        );
    }
}
