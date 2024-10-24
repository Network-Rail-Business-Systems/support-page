<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailForm;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class SubmitFormTest extends TestCase
{
    protected SupportDetailForm $form;

    protected SupportDetail $subject;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm();
        $this->subject = SupportDetail::factory()->create();
    }

    public function testFlashedErrorMessage(): void
    {
        $this->subject->target = null;

        $this->makeRequest();

        $this->assertFlashed(
            "{$this->subject->targetLabel} cannot be blank.",
            'danger',
        );
    }

    public function testFlashedSuccessMessage(): void
    {
        $this->makeRequest();

        $this->assertFlashed(
            "Support detail #{$this->subject->id} created",
            'success',
        );
    }

    public function testFlashedEditSuccessMessage(): void
    {
        $this->makeRequest(Form::EDIT);

        $this->assertFlashed(
            "Support detail #{$this->subject->id} updated",
            'success',
        );
    }

    public function testRedirectsOnFailure(): void
    {
        $this->subject->target = null;

        $this->makeRequest();

        $this->assertEquals(
            config('app.url'),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testSavedSubject(): void
    {
        $this->makeRequest();

        $this->assertDatabaseHas('support_details', $this->subject->getAttributes());
    }

    protected function makeRequest(string $mode = Form::NEW): void
    {
        Session::put(SupportDetailForm::key(), $this->subject);

        try {
            $this->form->submit($mode);
        } catch (HttpResponseException $exception) {
            $this->redirect = $exception->getResponse();
        }
    }
}
