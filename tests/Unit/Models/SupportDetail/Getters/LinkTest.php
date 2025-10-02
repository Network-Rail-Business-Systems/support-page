<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\Getters;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class LinkTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
    }

    public function testWhenEmail(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;
        $this->supportDetail->target = 'a@b.com';

        $this->assertEquals(
            'mailto:a@b.com?subject=' . SupportDetail::getEnquirySubject(),
            $this->supportDetail->link,
        );
    }

    public function testWhenRole(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;
        $this->supportDetail->target = 'banana';

        $this->assertEquals(
            route('support-page.owners', 'banana'),
            $this->supportDetail->link,
        );
    }

    public function testOtherwise(): void
    {
        $this->supportDetail->type = TypeQuestion::TECHNICAL_ISSUES;
        $this->supportDetail->target = 'goose';

        $this->assertEquals(
            'goose',
            $this->supportDetail->link,
        );
    }
}
