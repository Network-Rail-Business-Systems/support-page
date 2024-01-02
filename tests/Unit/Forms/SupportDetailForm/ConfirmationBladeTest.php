<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailForm;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

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
            'support-page::support.confirmation',
            $this->form->confirmationBlade(),
        );
    }
}
