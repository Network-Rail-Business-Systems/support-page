<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\UrlQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\UrlQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class FieldsTest extends TestCase
{
    protected UrlQuestion $question;

    protected SupportDetail $supportDetail;

    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = new SupportDetail();
        $this->form = new SupportDetailForm($this->supportDetail);
        $this->question = $this->form
            ->tasks()
            ->task('details')
            ->question('url');
    }

    public function testWhenGuide(): void
    {
        $this->supportDetail->type = TypeQuestion::GUIDES_AND_RESOURCES;
        $fields = $this->question->fields();

        $this->assertEquals(
            'target',
            $fields[0]->name,
        );

        $this->assertEquals(
            'What is the link to the guide or resource?',
            $fields[0]->label,
        );

        $this->assertEquals(
            'Make sure the link is accessible to anyone in Network Rail',
            $fields[0]->hint,
        );

        $this->assertEquals(
            20,
            $fields[0]->width,
        );
    }

    public function testWhenTechnical(): void
    {
        $this->supportDetail->type = TypeQuestion::TECHNICAL_ISSUES;
        $fields = $this->question->fields();

        $this->assertEquals(
            'What is the link to the enquiry form?',
            $fields[0]->label,
        );
    }
}
