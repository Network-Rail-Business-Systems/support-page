<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\SupportDetailForm;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use PHPUnit\Framework\TestCase;

class ExitBladeTest extends TestCase
{
    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm();
    }

    public function testReturnsExitRoute(): void
    {
        $this->assertEquals(
            route('support-details.create'),
            $this->form->exitRoute(),
        );
    }
}
