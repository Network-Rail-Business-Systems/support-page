<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailForm;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class ModelClassTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            SupportDetail::class,
            SupportDetailForm::modelClass(),
        );
    }
}
