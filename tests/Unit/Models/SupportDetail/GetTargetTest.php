<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class GetTargetTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
    }

    public function testTargetWhenEmailAddress(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;
        $this->supportDetail->target = 'potato@mail.com';

        $this->assertEquals(
            "mailto:{$this->supportDetail->target}?subject={$this->supportDetail::getEnquirySubject()}",
            $this->supportDetail->getTarget(),
        );

    }

    public function testTargetWhenRole(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;
        $this->supportDetail->target = 'support.owners';

        $this->assertEquals(
            route('support-page.owners', [$this->supportDetail->target]),
            $this->supportDetail->getTarget(),
        );
    }

    public function testWhenNotEmailAddressOrRole(): void
    {
        $this->supportDetail->type = TypeQuestion::GUIDES_AND_RESOURCES;
        $this->supportDetail->target = 'www.google.com';

        $this->assertEquals(
            $this->supportDetail->target,
            $this->supportDetail->getTarget(),
        );
    }
}
