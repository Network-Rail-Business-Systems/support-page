<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailForm;

use Illuminate\Support\Facades\Session;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class MakeNewSubjectTest extends TestCase
{
    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm();

        $this->form->create();
    }

    public function testReturnsNewSubject(): void
    {
        $this->assertInstanceOf(
            SupportDetail::class,
            Session::get(SupportDetailForm::key())
        );
    }
}
