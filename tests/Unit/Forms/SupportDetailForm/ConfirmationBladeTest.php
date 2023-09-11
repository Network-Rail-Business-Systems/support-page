<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\SupportDetailForm;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use TestCase;

class ConfirmationBladeTest extends TestCase
{
    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm();
    }

    public function testReturnsConfirmationBlade(): void
    {
        $this->assertEquals(
            'support.confirmation',
            $this->form->confirmationBlade(),
        );
    }
}
