<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailForm;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class QuestionsTest extends TestCase
{
    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm();
    }

    public function testReturnsQuestions(): void
    {
        $this->assertEquals(
            [
                TypeQuestion::class,
                LabelQuestion::class,
                TargetQuestion::class,
            ],
            $this->form->questions(),
        );
    }
}
