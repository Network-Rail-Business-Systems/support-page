<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail;

use NetworkRailBusinessSystems\SupportPage\Tests\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Tests\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class FormClassTest extends TestCase
{
    public function testFormClass(): void
    {
        $this->assertEquals(SupportDetailForm::class, SupportDetail::formClass());
    }
}
