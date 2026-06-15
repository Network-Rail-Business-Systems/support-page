<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\SupportPage;

use Illuminate\Http\RedirectResponse;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\SupportPageController;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class DeleteTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected SupportPageController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = SupportDetail::factory()->create();

        $this->controller = new SupportPageController();
        $this->redirect = $this->controller->delete($this->supportDetail);
    }

    public function test(): void
    {
        $this->assertDatabaseMissing(
            'support_details',
            $this->supportDetail->getAttributes(),
        );

        $this->assertFlashed(
            "Support detail #{$this->supportDetail->id} was successfully deleted.",
            'success',
        );

        $this->assertEquals(
            route('support-page.index'),
            $this->redirect->getTargetUrl(),
        );
    }
}
