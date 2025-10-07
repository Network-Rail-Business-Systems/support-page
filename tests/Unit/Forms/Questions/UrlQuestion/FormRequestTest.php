<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\Questions\UrlQuestion;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\UrlQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\UrlRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class FormRequestTest extends TestCase
{
    protected UrlQuestion $question;

    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm(
            new SupportDetail(),
        );

        $this->question = $this->form
            ->tasks()
            ->task('details')
            ->question('url');
    }

    public function test(): void
    {
        $this->assertEquals(
            UrlRequest::class,
            $this->question->formRequest(),
        );
    }
}
