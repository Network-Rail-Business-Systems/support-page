<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Forms\SupportDetailForm;

use Illuminate\Auth\Access\AuthorizationException;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use TestCase;

class CheckAccessTest extends TestCase
{
    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm();
    }

    public function testCanAccessForm(): void
    {
        try {
            $this->form->checkAccess();
            $this->assertTrue(true);
        } catch (AuthorizationException $exception) {
            $this->fail('Unable to access the form');
        }
    }
}
