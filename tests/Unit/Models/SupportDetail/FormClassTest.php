<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Models\SupportDetail;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use TestCase;

class FormClassTest extends TestCase
{
    public function testFormClass(): void
    {
        $this->assertEquals(SupportDetailForm::class, SupportDetail::formClass());
    }
}
