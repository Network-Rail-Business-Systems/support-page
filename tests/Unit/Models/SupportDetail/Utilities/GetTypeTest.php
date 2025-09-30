<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\Utilities;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class GetTypeTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
    }

    public function testDraftEmailWhenSystemQuestion(): void
    {
        $this->supportDetail->type = TypeQuestion::SYSTEM_QUESTIONS;

        $this->assertEquals(
            '(draft a new e-mail)',
            $this->supportDetail->getType(),
        );
    }

    public function testNewTabWhenOther(): void
    {
        $this->assertEquals(
            '(opens in a new tab)',
            $this->supportDetail->getType(),
        );
    }
}
